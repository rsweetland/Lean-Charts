<?

// db and initial setup
define('DB_NAME', 'sonar'); 		//	database name
define('DB_HOST', 'localhost');
define('DB_USER', 'user');
define('DB_PASS', 'pass');
define('DB_PORT', '8889');
define('BASE_URL', 'http://example.com/lean-charts/'); //with trailing slash
define('APP_ROOT', dirname(realpath(__FILE__)) . '/');

set_include_path (APP_ROOT . 'lib/' );

define('SYSTEM_EMAIL', 'email@email.com');
define('SYSTEM_EMAIL_NAME', 'Stats');

ini_set("display_errors","on");