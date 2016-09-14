<h1>Editar Curso</h1>

<form method="POST" enctype="multipart/form-data">

	Nome do curso:<br/>
	<input type="text" name="nome" value="<?php echo $curso['nome']; ?>" /><br/><br/>

	Descrição:<br/>
	<textarea name="descricao"><?php echo $curso['descricao']; ?></textarea><br/><br/>

	Imagem:<br/>
	<input type="file" name="imagem" /><br/>
	<img src="<?php echo BASE; ?>../assets/images/cursos/<?php echo $curso['imagem']; ?>" border="0" height="80" /><br/><br/>
	
	<input type="submit" value="Salvar" />

</form>

<hr/>

<h2>Aulas</h2>

<fieldset>
	<legend>Adicionar Módulo Novo</legend>
	<form method="POST">
		Nome do módulo:<br/>
		<input type="text" name="modulo" /> <input type="submit" value="Adicionar Módulo" />
	</form>
</fieldset><br/>

<fieldset>
	<legend>Adicionar Aula Nova</legend>
	<form method="POST">
		Titulo da aula:<br/>
		<input type="text" name="aula" /><br/><br/>

		Módulo da aula:<br/>
		<select name="moduloaula">
			<?php foreach($modulos as $modulo): ?>
			<option value="<?php echo $modulo['id']; ?>"><?php echo utf8_encode($modulo['nome']); ?></option>
			<?php endforeach; ?>
		</select><br/><br/>

		Tipo da aula:<br/>
		<select name="tipo">
			<option value="video">Vídeo</option>
			<option value="poll">Questionário</option>
		</select><br/><br/>

		<input type="submit" value="Adicionar Aula" />
	</form>
</fieldset><br/>

<?php foreach($modulos as $modulo): ?>

	<h4><?php echo utf8_encode($modulo['nome']); ?> - <a href="<?php echo BASE; ?>home/edit_modulo/<?php echo $modulo['id']; ?>">[editar]</a> - <a href="<?php echo BASE; ?>home/del_modulo/<?php echo $modulo['id']; ?>">[excluir]</a></h4>

	<?php foreach($modulo['aulas'] as $aula): ?>
	<h5><?php echo $aula['nome']; ?> - <a href="<?php echo BASE; ?>home/edit_aula/<?php echo $aula['id']; ?>">[editar]</a> - <a href="<?php echo BASE; ?>home/del_aula/<?php echo $aula['id']; ?>">[excluir]</a></h5>
	<?php endforeach; ?>


<?php endforeach; ?>






