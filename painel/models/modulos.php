<?php
class Modulos extends model {

	public function getModulos($id_curso) {
		$array = array();

		$sql = "SELECT * FROM modulos WHERE id_curso = '$id_curso'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {

			$array = $sql->fetchAll();
                        //pego as aulas daquele modulo
			$aulas = new Aulas();

			foreach($array as $mChave => $mDados) {
				$array[$mChave]['aulas'] = $aulas->getAulasDoModulo($mDados['id']);
			}

		}

		return $array;
	}

	public function getModulo($id) {
		$array = array();
                 //exibe todos os modulos 
		$sql = "SELECT * FROM modulos WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}
        //pega o nome do modulo e o id do curso
	public function addModulo($nome, $id_curso) {

		$this->db->query("INSERT INTO modulos SET nome = '$nome', id_curso = '$id_curso'");

	}

	public function deleteModulos($id) {
		$sql = "SELECT id_curso FROM modulos WHERE id = '$id'";
		$sql = $this->db->query($sql);
		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$this->db->query("DELETE FROM modulos WHERE id = '$id'");

			return $sql['id_curso'];
		}
	}

	public function updateModulo($nome, $id) {
		$sql = "SELECT id_curso FROM modulos WHERE id = '$id'";
		$sql = $this->db->query($sql);
		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$this->db->query("UPDATE modulos SET nome = '$nome' WHERE id = '$id'");

			return $sql['id_curso'];
		}
	}

}