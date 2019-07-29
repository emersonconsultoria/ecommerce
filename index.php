<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;

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

$app->run();

 ?>