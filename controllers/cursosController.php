<?php
class cursosController extends controller {

	public function __construct() {
		parent::__construct();
		$alunos = new Alunos();

		if(!$alunos->isLogged()) {
			header("Location: ".BASE."login");
		}
	}
	
	public function index() {
		header("Location: "+BASE);
	}

	public function entrar($id) {
		$dados = array(
			'info' => array(),
			'curso' => array(),
			'modulos' => array()
		);
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['lgaluno']);
		$dados['info'] = $alunos;
                  //verifica se o aluno é inscrito no curso, se não for não deixa ele entrar
		if($alunos->isInscrito($id)) {
			$curso = new Cursos();
			$curso->setCurso($id);
			$dados['curso'] = $curso;
                         //modulos do curso
			$modulos = new Modulos();
			$dados['modulos'] = $modulos->getModulos($id);
                         //total de aulas assitidas pelo o aluno
			$dados['aulas_assistidas'] = $alunos->getNumAulasAssistidas($id);
			$dados['total_aulas'] = $curso->getTotalAulas();
                          
			$this->loadTemplate('curso_entrar', $dados);
		} else {
			header("Location: "+BASE);
		}
	}

	public function aula($id_aula) {
		$dados = array(
			'info' => array(),
			'curso' => array(),
			'modulos' => array(),
			'aula_info' => array()
		);
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['lgaluno']);
		$dados['info'] = $alunos;
                
		$aula = new Aulas();
		$id = $aula->getCursoDeAula($id_aula);

		if($alunos->isInscrito($id)) {
			$curso = new Cursos();
			$curso->setCurso($id);
			$dados['curso'] = $curso;

			$modulos = new Modulos();
			$dados['modulos'] = $modulos->getModulos($id);

			$dados['aulas_assistidas'] = $alunos->getNumAulasAssistidas($id);
			$dados['total_aulas'] = $curso->getTotalAulas();
                        //retorna todas as informações da aula 
			$dados['aula_info'] = $aula->getAula($id_aula);
                            // se for video a aula
			if($dados['aula_info']['tipo'] == 'video') {
				$view = 'curso_aula_video';
			} else {
                            //se for questionario
				$view = 'curso_aula_poll';
				if(!isset($_SESSION['poll'.$id_aula])) {
					$_SESSION['poll'.$id_aula] = 1;
				}
			}
                            //form duvida do aluno que existe em casa aula
			if(isset($_POST['duvida']) && !empty($_POST['duvida'])) {
				$duvida = addslashes($_POST['duvida']);
				$aula->setDuvida($duvida, $alunos->getId());
			}
                          //opcao selecionado do questionario
			if(isset($_POST['opcao']) && !empty($_POST['opcao'])) {
				$opcao = addslashes($_POST['opcao']);
                                
				if($opcao == $dados['aula_info']['resposta']) {
					$dados['resposta'] = true;
					$aula->marcarAssistido($id_aula);
				} else {
                                    //se errou a resposta
					$dados['resposta'] = false;
				}

				$_SESSION['poll'.$id_aula]++;
			}

			$this->loadTemplate($view, $dados);
		} else {
			header("Location: "+BASE);
		}

	}

}