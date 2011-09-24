<?php

define("TEST_DIR", realpath(__DIR__));

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(__DIR__ . '/../lib'),
    realpath(__DIR__ . '/../lib/vendors/sparrow'),
    realpath(__DIR__ . '/../stats'),
    get_include_path(),
)));

require_once(realpath(__DIR__ . '/../lib/vendors/gwc.autoloader.php'));
require_once(__DIR__ . '/test_helpers.php');

setupTestDatabase();