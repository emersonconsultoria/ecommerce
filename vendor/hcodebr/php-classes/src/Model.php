<?php 

namespace Hcode;

class Model
{
	private $values = [];

	public function __call($name, $args)
	{
		//Detectar se é GET ou SET pelas 3 primeiras letras, basta padronizar.
		$method = substr($name, 0, 3);
		// Pega o nome do campo
		$fieldName = substr($name, 3, strlen($name));
		//var_dump($method, $fieldName);
		//exit;


		switch ($method) {
			case 'get':
				return $this -> values[$fieldName]; 
				break;
			case 'set':
				$this -> values[$fieldName] = $args[0];
				break;
			default:
				# code...
				break;
		}
	}
	public function setData($data = array())
	{
		foreach ($data as $key => $value) {
			//coloca entre chaves para ficar dinâmico e poder concatenar, depois continua ex: $this->tpl->assign($key, $val);
			//Essa string, depois será executada como se fosse um método comum.
			$this -> {"set" . $key}($value);
		}
	}

	public function getValues()
	{
		return $this -> values;
	}
}







 ?>