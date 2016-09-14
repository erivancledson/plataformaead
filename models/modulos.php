<?php
class Modulos extends model {
         //modulos recebe cursos como parametro
	public function getModulos($id_curso) {
		$array = array();
               //pega os modulos do curso
		$sql = "SELECT * FROM modulos WHERE id_curso = '$id_curso'";
		$sql = $this->db->query($sql);
                //se tiver algum modulo ele executa
		if($sql->rowCount() > 0) {

			$array = $sql->fetchAll();

			$aulas = new Aulas();
                       //pega as aulas do modulo
			foreach($array as $mChave => $mDados) {
				$array[$mChave]['aulas'] = $aulas->getAulasDoModulo($mDados['id']);
			}

		}

		return $array;
	}

}