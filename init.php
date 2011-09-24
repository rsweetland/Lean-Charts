<?php

// Include the necessary paths
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(__DIR__ . '/lib'),
    realpath(__DIR__ . '/lib/vendors/sparrow'),
    realpath(__DIR__ . '/stats'),
    get_include_path(),
)));

// Initialize the autoloader
require_once(realpath(__DIR__ . '/lib/vendors/gwc.autoloader.php'));

// Initialize LeanCharts
LeanCharts::init(__DIR__ . '/config/app.ini');