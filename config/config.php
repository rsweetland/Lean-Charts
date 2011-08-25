<?

// db and initial setup
define('DB_NAME', 'sonar'); 		//	database name
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_PORT', '8889');
define('BASE_URL', 'http://localhost:8888/sonar/'); //with trailing slash
define('APP_ROOT', dirname(realpath(__FILE__)) . '/');

set_include_path (APP_ROOT . 'lib/' );

define('SYSTEM_EMAIL', 'esweetland@gmail.com');
define('SYSTEM_EMAIL_NAME', 'Stats');

ini_set("display_errors","on");


// PHP 5.3 requires that this be set
date_default_timezone_set('GMT');

