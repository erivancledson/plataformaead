<html>
	<head>
		<meta charset="UTF-8" />
		<title>EAD</title>
		<link rel="stylesheet" href="<?php echo BASE; ?>assets/css/template.css" />
		<script type="text/javascript" src="<?php echo BASE; ?>assets/js/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE; ?>assets/js/script.js"></script>
	</head>
	<body>
		<div class="topo">
			<a href="<?php echo BASE; ?>login/logout">
				<div>Sair</div>
			</a>
                    <!--nome do usuario  -->
			<div class="topousuario"><?php echo $viewData['info']->getNome(); ?></div>
		</div>
		<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	</body>
</html>