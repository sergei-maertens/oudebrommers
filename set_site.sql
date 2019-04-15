-- Sets the domain correctly for the sites

UPDATE wp_options SET
    option_value = REPLACE(option_value, 'http://old', 'https://new')
WHERE option_value LIKE '%old%';
