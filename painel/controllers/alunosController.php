<?php
class alunosController extends controller {

	public function __construct() {
		parent::__construct();
		$usuarios = new Usuarios();

		if(!$usuarios->isLogged()) {
			header("Location: ".BASE."login");
		}
	}

	public function index() {
		$dados = array(
			'alunos' => array()
		);
                //pegando os dados dos alunos
		$alunos = new Alunos();
		$dados['alunos'] = $alunos->getAlunos();
                
		$this->loadTemplate('alunos', $dados);
	}

	public function excluir($id) {
		$alunos = new Alunos();
		$alunos->deleteAluno($id);

		header("Location: ".BASE.'alunos');

	}

	public function adicionar() {
		$dados = array();

		if(isset($_POST['nome']) && !empty($_POST['nome'])) {

			$nome = addslashes($_POST['nome']);
			$email = addslashes($_POST['email']);
			$senha = md5($_POST['senha']);

			$alunos = new Alunos();

			$alunos->addAluno($nome, $email, $senha);

			header("Location: ".BASE.'alunos');

		}

		$this->loadTemplate("alunos_add", $dados);
	}

	public function editar($id) {
		$dados = array(
			'aluno' => array(),
			'modulos' => array()
		);

		$alunos = new Alunos();

		if(isset($_POST['nome']) && !empty($_POST['nome'])) {
			$nome = addslashes($_POST['nome']);
			$email = addslashes($_POST['email']);
			$senha = md5($_POST['senha']);
			$cursos = $_POST['cursos'];

			$alunos->updateAluno($id, $nome, $email, $senha, $cursos);
		}
                //para o editar aluno, tendo todos os cursos que aquele aluno
                //esta cadastrado
		$cursos = new Cursos();
		$dados['aluno'] = $alunos->getAluno($id);
		$dados['cursos'] = $cursos->getCursos();
                //lista dos cursos que o aluno esta inscrito
		$dados['inscrito'] = $cursos->getCursosInscritos($id);

		$this->loadTemplate('alunos_edit', $dados);
	}
}










