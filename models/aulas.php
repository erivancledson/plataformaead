<?php
class Aulas extends model {

	public function marcarAssistido($id) {
		$aluno = $_SESSION['lgaluno'];
                //salva a data e id da aula e id aluno na tabela historico
		$sql = "INSERT INTO historico SET data_viewed = NOW(), id_aluno = '$aluno', id_aula = '$id'";
		$this->db->query($sql);
	}
         //pega as aulas do modulo
	public function getAulasDoModulo($id) {
            //array de resposta
		$array = array();
                //sessão do usuario
		$aluno = $_SESSION['lgaluno'];
               //pega as aulas pelo o id do modulo pela ordem das aulas
		$sql = "SELECT * FROM aulas WHERE id_modulo = '$id' ORDER BY ordem";
		$sql = $this->db->query($sql);
              //se teve algum resultado ele pega as aulas e retorna
		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
                       
			foreach($array as $aulachave => $aula) {
                            //marca as aulas assistidas
				$array[$aulachave]['assistido'] = $this->isAssistido($aula['id'], $aluno);
				// se aula for do tipo video pega os videos pelo o id das aulas e coloca o nome dovideo
				if($aula['tipo'] == 'video') {
					$sql = "SELECT nome FROM videos WHERE id_aula = '".($aula['id'])."'";
					$sql = $this->db->query($sql)->fetch();
					$array[$aulachave]['nome'] = $sql['nome'];
				}
                                //coloca os questionarios
				elseif($aula['tipo'] == 'poll') {
					$array[$aulachave]['nome'] = "Questionário";
				}
			}
		}

		return $array;
	}

	public function getCursoDeAula($id_aula) {
                 //retorna o id do curso da aula
		$sql = "SELECT id_curso FROM aulas WHERE id = '$id_aula'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
			return $row['id_curso'];
		} else {
			return 0;
		}

	}

	public function getAula($id_aula) {
		$array = array();

		$id_aluno = $_SESSION['lgaluno'];

		$sql = "
		SELECT 
			tipo,
			(select count(*) from historico where historico.id_aula = aulas.id and historico.id_aluno = '$id_aluno') as assistido
		FROM 
			aulas 
		WHERE 
			id = '$id_aula'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
                          // se o tipo da aula for = video
			if($row['tipo'] == 'video') {
                                 //pega o video pelo o id da aula
				$sql = "SELECT * FROM videos WHERE id_aula = '$id_aula'";
				$sql = $this->db->query($sql);
				$array = $sql->fetch();
				$array['tipo'] = 'video';

			}
                         // se o tipo da aula for = questionario
			elseif($row['tipo'] == 'poll') {

				$sql = "SELECT * FROM questionarios WHERE id_aula = '$id_aula'";
				$sql = $this->db->query($sql);
				$array = $sql->fetch();
				$array['tipo'] = 'poll';

			}

			$array['assistido'] = $row['assistido'];

		}

		return $array;
	}
       //saldando a duvida com o id do aluno
	public function setDuvida($duvida, $aluno) {

		$sql = "INSERT INTO duvidas SET data_duvida = NOW(), duvida = '$duvida', id_aluno = '$aluno'";
		$this->db->query($sql);

	}
         
	private function isAssistido($id_aula, $id_aluno) {

		$sql = "SELECT id FROM historico WHERE id_aluno = '$id_aluno' AND id_aula = '$id_aula'";
		$sql = $this->db->query($sql);
                  //se aula foi assistida retorne true se não false
		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}

	}

}












