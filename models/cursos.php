<?php
class Cursos extends model {

	private $info;
          //cursos que  o aluno está cadastrado
	public function getCursosDoAluno($id) {
		$array = array();

		$sql = "
			SELECT 
				aluno_curso.id_curso,
				cursos.nome,
				cursos.imagem,
				cursos.descricao
			FROM 
				aluno_curso
			LEFT JOIN cursos
				ON aluno_curso.id_curso = cursos.id
			WHERE
				aluno_curso.id_aluno = '$id'
		";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;

	}
        //seta o curso que foi selecionado
	public function setCurso($id) {
		$sql = "SELECT * FROM cursos WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$this->info = $sql->fetch();
		}
	}

	public function getNome() {
		return $this->info['nome'];
	}

	public function getImagem() {
		return $this->info['imagem'];
	}

	public function getDescricao() {
		return $this->info['descricao'];
	}

	public function getId() {
		return $this->info['id'];
	}

	public function getTotalAulas() {
		$sql = "SELECT id FROM aulas WHERE id_curso = '".($this->getId())."'";
		$sql = $this->db->query($sql);

		return $sql->rowCount();
	}

}
?>