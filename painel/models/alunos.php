<?php
class Alunos extends model {

	public function getAlunos() {
            //array de respostas
		$array = array();
                //pega tudo de aluno e quantidade de alunos
		$sql = "SELECT 
			*,
			(select count(*) from aluno_curso where aluno_curso.id_aluno = alunos.id) as qtcursos 
		FROM alunos";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
           //pega o aluno para ser editado
	public function getAluno($id) {
		$array = array();

		$sql = "SELECT * FROM alunos WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function deleteAluno($id) {
		$sql = "DELETE FROM aluno_curso WHERE id_aluno = '$id'";
		$this->db->query($sql);

		$sql = "DELETE FROM alunos WHERE id = '$id'";
	}

	public function addAluno($nome, $email, $senha) {
		$this->db->query("INSERT INTO alunos SET nome = '$nome', email = '$email', senha = '$senha'");
	}

	public function updateAluno($id, $nome, $email, $senha, $cursos) {
		$this->db->query("UPDATE alunos SET nome = '$nome', email = '$email', senha = '$senha' WHERE id = '$id'");

		$this->db->query("DELETE FROM aluno_curso WHERE id_aluno = '$id'");

		foreach($cursos as $curso) {
			$this->db->query("INSERT INTO aluno_curso SET id_aluno = '$id', id_curso = '$curso'");
		}
	}

}
?>