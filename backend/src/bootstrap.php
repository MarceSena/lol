<?

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ERROR);
//ini_set('memory_limit', '-1');

define('HOST', 'mysql');
define('BANCO', 'lol');
define('USER', 'root');
define('SENHA', 'secret');

define('DS', DIRECTORY_SEPARATOR);
define('DIR_APP', __DIR__ . '/app');
define('DIR_PROJETO', 'public');

if (file_exists(filename: '../autoload.php')) {
    include 'autoload.php';
} else {
    echo 'erro ao incluir bootstrap';
}
