<?php
class Alunos extends model {

	private $info;
             //verifica se esta logado
	public function isLogged() {
		if(isset($_SESSION['lgaluno']) && !empty($_SESSION['lgaluno'])) {
			return true;
		} else {
			return false;
		}
	}

	public function fazerLogin($email, $senha) {

		$sql = "SELECT * FROM alunos WHERE email = '$email' AND senha = '$senha'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();

			$_SESSION['lgaluno'] = $row['id'];

			return true;
		}

		return false;

	}

	public function isInscrito($id_curso) {
		$sql = "SELECT * FROM aluno_curso WHERE id_aluno = '".($this->info['id'])."' AND id_curso = '$id_curso'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function setAluno($id) {
                //seta as informações do aluno quando estiver logado
		$sql = "SELECT * FROM alunos WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$this->info = $sql->fetch();
		}

	}
              //pega o nome do aluno
	public function getNome() {
		return $this->info['nome'];
	}
       
	public function getId() {
		return $this->info['id'];
	}
          //pega as aulas que foram assistidas de um curso especifico
	public function getNumAulasAssistidas($id_curso) {
		$sql = "
		SELECT id
		FROM historico
		WHERE
			id_aluno = '".($this->getId())."'
			AND id_aula IN (select aulas.id from aulas where aulas.id_curso = '$id_curso')
		";
		$sql = $this->db->query($sql);

		return $sql->rowCount();
	}

















}
?>