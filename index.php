<?php 
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	/*$sql = new Hcode\DB\Sql();
	$results = $sql -> select("SELECT * FROM tb_users");
	echo json_encode($results); */

	//new Page() automaticamente chama o __construct (header) e __destruct(no fim)
	$page = new Page();

	$page -> setTpl("index");
	//__destruct acontecerá aqui e chamará o footer
});


$app->get('/admin', function() {
	//Verifica se a sessão está ativa
	User::verifyLogin();

	//new Page() automaticamente chama o __construct (header) e __destruct(no fim)
	$page = new PageAdmin();
	$page -> setTpl("index");
	//__destruct acontecerá aqui e chamará o footer
});
//Login
$app->get('/admin/login', function() {
	//new Page() automaticamente chama o __construct (header) e __destruct(no fim)
	$page = new PageAdmin([
		"header"=> false,
		"footer"=> false
	]);
	$page -> setTpl("login");
	//__destruct acontecerá aqui e chamará o footer
});

$app->post('/admin/login', function() {
	//método estático que receberá login e password
	User::login($_POST["login"], $_POST["password"]);
	//se passar, redireciona para a homepage de admin = index
	header("Location: /admin");
	//Pára a execução aqui.
	exit;
});

$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /admin/login");
	exit;

});
$app->run();

 ?>