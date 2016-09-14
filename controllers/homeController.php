<?php
class homeController extends controller {

	public function __construct() {
		parent::__construct();
		$alunos = new Alunos();

		if(!$alunos->isLogged()) {
			header("Location: ".BASE."login");
		}
	}
	
	public function index() {
		$dados = array(
                    //envia as informações do aluno
			'info' => array(),
			'cursos' => array()
		);

		$alunos = new Alunos();
                //aluno logado
		$alunos->setAluno($_SESSION['lgaluno']);
                //
		$dados['info'] = $alunos;
                //recebe os cursos que tão associados pelo o id do alunno
		$cursos = new Cursos();
		$dados['cursos'] = $cursos->getCursosDoAluno($alunos->getId());
		
		$this->loadTemplate('home', $dados);
	}

}