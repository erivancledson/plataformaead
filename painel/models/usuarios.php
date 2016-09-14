<?php
class Usuarios extends model {

	private $info;

	public function isLogged() {
		if(isset($_SESSION['lgadmin']) && !empty($_SESSION['lgadmin'])) {
			return true;
		} else {
			return false;
		}
	}

	public function fazerLogin($email, $senha) {

		$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();

			$_SESSION['lgadmin'] = $row['id'];

			return true;
		}

		return false;

	}

}
?>