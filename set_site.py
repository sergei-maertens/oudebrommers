#!/usr/bin/env python
import argparse
import re

import MySQLdb


def parse_args():
    parser = argparse.ArgumentParser(description="Set the domain for a WP install")
    parser.add_argument("old_domain", help="The old domain name, to replace")
    parser.add_argument(
        "new_domain", help="The new domain name. Will replace old_domain."
    )

    parser.add_argument("--db-host", help="Database host name", default="localhost")
    parser.add_argument(
        "--db-name", help="Database name to connect to", default="mysql"
    )
    parser.add_argument(
        "--db-user", help="Databse user to connect with", default="root"
    )
    parser.add_argument("--db-password", help="Database user password", default="")

    return parser.parse_args()


def handle_php_serialize(serialized: str, old: str, new: str):
    """
    PHP serialize outputs 's:<length>:"<value>";' for encoded strings.
    """
    pattern = re.compile(r"s:(?P<length>[0-9]+):\"(?P<value>.+?)\"")

    matches = pattern.finditer(serialized)

    replacements = []
    for match in matches:
        if old not in match.group("value"):
            continue

        replacement = (
            match.start(),
            match.end(),
            match.group("value").replace(old, new),
        )

        replacements.append(replacement)

    return replacements


def main(
    old: str, new: str, db_host: str, db_name: str, db_user: str, db_password: str
):

    db = MySQLdb.connect(
        host=db_host, user=db_user, password=db_password, database=db_name
    )

    with db.cursor() as c:
        c.execute(
            "SELECT option_id, option_name, option_value FROM wp_options WHERE option_value LIKE %s;",
            (f"%{old}%",),
        )

        rows = c.fetchall()

    new_values = []

    for option_id, option_name, option_value in rows:
        replacements = handle_php_serialize(option_value, old, new)
        if replacements:
            bits = []
            for i, (start, end, replacement) in enumerate(replacements):
                # put the previous in-between part in place
                prev_last_index = replacements[i - 1][1] if i else 0
                bits += [
                    option_value[prev_last_index:start],
                    f's:{len(replacement)}:"{replacement}"',
                ]

            # tuck the tail back on
            last_end = replacements[-1][1]
            bits.append(option_value[last_end:])

            new_values.append((option_id, "".join(bits)))

        else:
            new_values.append((option_id, option_value.replace(old, new)))

    for option_id, new_value in new_values:
        with db.cursor() as c:
            c.execute(
                "UPDATE wp_options SET option_value = %s WHERE option_id = %s",
                (new_value, option_id),
            )

    db.commit()


if __name__ == "__main__":
    args = parse_args()
    main(
        args.old_domain,
        args.new_domain,
        db_host=args.db_host,
        db_name=args.db_name,
        db_user=args.db_user,
        db_password=args.db_password,
    )
