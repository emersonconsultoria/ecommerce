<?php 

namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;
/**
 * 
 */
class User extends Model
{
	const SESSION = "User";

	public static function login($login, $password)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
			":LOGIN"=>$login
		));
		if (count($results)===0)
		{
			//Coloca a \ 
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}
		$data = $results[0];
		if( password_verify($password, $data["despassword"]) === true)
		{
			$user = new User();
			//$user ->setiduser($data["iduser"]); // assim chama 1 por 1
			$user ->setData($data);

			$_SESSION[User::SESSION] = $user -> getValues();

			 //var_dump($user);
			 //exit;
			return $user;

		} else {
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}

	}

	public static function logout()
	{

		$_SESSION[User::SESSION] = NULL;

	}

	public static function verifyLogin($inadmin=true)
	{
		if 
		(
			!isset($_SESSION[User::SESSION]) //se ela não for definida
			||
			!$_SESSION[User::SESSION] //se não forvazia ou perdeu valor
			||
			!(int)$_SESSION[User::SESSION]["iduser"] > 0 //se iduser não é válido
			||
			(bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin
		)
		{
			header ("Location: /admin/login");  //redireciona para a tela de login.
			exit;
		}
	}
}








 ?>