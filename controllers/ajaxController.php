<?php
class ajaxController extends controller {

	public function __construct() {
		parent::__construct();
		$alunos = new Alunos();

		if(!$alunos->isLogged()) {
			header("Location: ".BASE."login");
		}
	}
           //marca a aula se foi assistida
	public function marcar_assistido($id) {
		$aulas = new Aulas();
		$aulas->marcarAssistido($id);
	}

}