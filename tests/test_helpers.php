<?php

function getTestDatabase()
{
    $config = parse_ini_file(__DIR__ . '/config/app.ini');

    $dsn = "mysqli://" . $config['db.user']
           . ":" . $config['db.pass']
           . "@" . $config['db.host']
           . ":" . $config['db.port']
           . "/" . $config['db.name'];

    $sparrow = new Sparrow($dsn);
    return $sparrow;
}

function executeQueries($sql)
{
    $statements = explode(";", $sql);
    $db = getTestDatabase();

    foreach ($statements as $statement) {
        $db->sql($statement)->execute();
    }
}

function setupTestDatabase()
{
    $sql = file_get_contents(TEST_DIR . '/data/setup.sql');
    executeQueries($sql);
}