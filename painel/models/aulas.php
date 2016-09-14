<?php
class Aulas extends model {

	public function getAulasDoModulo($id) {
		$array = array();

		$sql = "SELECT * FROM aulas WHERE id_modulo = '$id' ORDER BY ordem";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();

			foreach($array as $aulachave => $aula) {
				if($aula['tipo'] == 'video') {
					$sql = "SELECT nome FROM videos WHERE id_aula = '".($aula['id'])."'";
					$sql = $this->db->query($sql)->fetch();
					$array[$aulachave]['nome'] = $sql['nome'];
				}
				elseif($aula['tipo'] == 'poll') {
					$array[$aulachave]['nome'] = "Questionário";
				}
			}
		}

		return $array;
	}

	public function deleteAula($id) {
		$sql = "SELECT id_curso FROM aulas WHERE id = '$id'";
		$sql = $this->db->query($sql);
		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$this->db->query("DELETE FROM aulas WHERE id = '$id'");
			$this->db->query("DELETE FROM questionarios WHERE id_aula = '$id'");
			$this->db->query("DELETE FROM videos WHERE id_aula = '$id'");
			$this->db->query("DELETE FROM historico WHERE id_aula = '$id'");

			return $sql['id_curso'];
		}
	}

	public function addAula($id_curso, $id_modulo, $nome, $tipo) {
            //pega somente 1 registro daquele ultimo registro especifico
		$sql = "SELECT ordem FROM aulas WHERE id_modulo = '$id_modulo' ORDER BY ordem DESC LIMIT 1";
		$sql = $this->db->query($sql);
		$ordem = 1;
		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
                        //vem como string e transforma em numero
			$ordem = intval($sql['ordem']);
			$ordem++;
		}

		$sql = "INSERT INTO aulas SET id_modulo = '$id_modulo', id_curso = '$id_curso', ordem = '$ordem', tipo = '$tipo'";
		$this->db->query($sql);
		$id_aula = $this->db->lastInsertId();
                 //se aula for igual a video insere em videos se não insere na tabela 
                //questionarios
		if($tipo == 'video') {
			$this->db->query("INSERT INTO videos SET id_aula = '$id_aula', nome = '$nome'");
		} else {
			$this->db->query("INSERT INTO questionarios SET id_aula = '$id_aula'");
		}
	}

	public function getAula($id_aula) {
		$array = array();

		$sql = "
		SELECT 
			tipo
		FROM 
			aulas 
		WHERE 
			id = '$id_aula'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();

			if($row['tipo'] == 'video') {

				$sql = "SELECT * FROM videos WHERE id_aula = '$id_aula'";
				$sql = $this->db->query($sql);
				$array = $sql->fetch();
				$array['tipo'] = 'video';

			}
			elseif($row['tipo'] == 'poll') {

				$sql = "SELECT * FROM questionarios WHERE id_aula = '$id_aula'";
				$sql = $this->db->query($sql);
				$array = $sql->fetch();
				$array['tipo'] = 'poll';

			}

		}

		return $array;
	}
          //atualiza a aula do painel que é video
	public function updateVideoAula($id, $nome, $descricao, $url) {
		$this->db->query("UPDATE videos SET nome = '$nome', descricao = '$descricao', url = '$url' WHERE id_aula = '$id'");

		return $this->getCursoDeAula($id);
	}
         //atualiza a aula do painel que é questionario
	public function updateQuestionarioAula($id, $pergunta, $opcao1, $opcao2, $opcao3, $opcao4, $resposta) {
		$this->db->query("UPDATE questionarios SET pergunta = '$pergunta', opcao1 = '$opcao1', opcao2 = '$opcao2', opcao3 = '$opcao3', opcao4 = '$opcao4', resposta = '$resposta' WHERE id_aula = '$id'");

		return $this->getCursoDeAula($id);
	}

	public function getCursoDeAula($id_aula) {

		$sql = "SELECT id_curso FROM aulas WHERE id = '$id_aula'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
			return $row['id_curso'];
		} else {
			return 0;
		}

	}

}












