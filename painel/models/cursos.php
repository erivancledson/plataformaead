<?php
class Cursos extends model {

	public function getCursos() {
		$array = array();
                  //qnt de alunos cadastrados no curso especifico
		$sql = "SELECT 
			*,
			(select count(*) from aluno_curso where aluno_curso.id_curso = cursos.id) as qtalunos 
		FROM cursos";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getCurso($id) {
		$array = array();

		$sql = "SELECT * FROM cursos WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}
          //cursos que os alunos estão inscritos
	public function getCursosInscritos($id_aluno) {
		$array = array();

		$sql = "SELECT id_curso FROM aluno_curso WHERE id_aluno = '$id_aluno'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$rows = $sql->fetchAll();

			foreach($rows as $row) {
				$array[] = $row['id_curso'];
			}
		}

		return $array;
	}

}
?>