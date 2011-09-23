<?php

define("TEST_DIR", realpath(__DIR__));

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(__DIR__ . '/../lib'),
    realpath(__DIR__ . '/../lib/vendors/sparrow'),
    realpath(__DIR__ . '/../stats'),
    get_include_path(),
)));

require_once(realpath(__DIR__ . '/../lib/vendors/gwc.autoloader.php'));

/*$config = parse_ini_file(__DIR__ . '/config.ini');
$dsn = "mysqli://" . $config['db.user'] . ":" . $config['db.pass'] . "@" . $config['db.host'] . ":" . $config['db.port'] . "/" . $config['db.name'];

$sql = file_get_contents(__DIR__ . '/../schema/data.sql');
$statements = explode(";", $sql);

$sparrow = new Sparrow($dsn);

foreach ($statements as $statement) {
    $sparrow->sql($statement)->execute();
}*/