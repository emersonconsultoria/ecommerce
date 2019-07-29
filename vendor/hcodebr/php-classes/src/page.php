<?php 

namespace Hcode;

use Rain\Tpl; //usando o namespace do Rain

class Page{

	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
	];

	public function __construct($opts = array(), $tpl_dir = "/views/")
	{
		//Merge mescla 2 arrays, sendo que o último sempre sobrescreve os anteriores, carrega o default, porém se o param foi passado no 2º, sobrescreve.
		$this -> options = array_merge($this->defaults, $opts);
		//Após, guarda em options os valores que prevalecem.

		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false
		);

		Tpl::configure( $config );

		// create the Tpl object
		$this -> tpl = new Tpl;

		if ($this->options['data']) $this->setData($this->options['data']);

		if ($this->options['header'] === true) $this->tpl->draw("header", false);
	}

	public function __destruct()
	{

		if ($this->options['footer'] === true) $this->tpl->draw("footer", false);

	}

	private function setData($data = array())
	{

		foreach($data as $key => $val)
		{

			$this->tpl->assign($key, $val);

		}

	}

	public function setTpl($tplname, $data = array(), $returnHTML = false)
	{

		$this->setData($data);

		return $this->tpl->draw($tplname, $returnHTML);

	}

}

 ?>