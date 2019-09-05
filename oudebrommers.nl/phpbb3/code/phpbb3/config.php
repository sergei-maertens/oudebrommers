<?php

$dbms = 'mysqli';
$dbhost = getenv('PHPBB3_DB_HOST');
$dbport = getenv('PHPBB#_DB_PORT') || '';
$dbuser = getenv('PHPBB3_DB_USER');
$dbpasswd = getenv('PHPBB3_DB_PASSWORD');
$dbname = getenv('PHPBB3_DB_NAME');

$table_prefix = 'phpbb_';
$acm_type = 'file';
$load_extensions = '';

@define('PHPBB_INSTALLED', true);
// @define('DEBUG', true);
// @define('DEBUG_EXTRA', true);
?>
