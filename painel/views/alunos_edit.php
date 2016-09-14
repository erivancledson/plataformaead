<h1>Editar Aluno</h1>

<form method="POST">

	Nome do aluno:<br/>
	<input type="text" name="nome" value="<?php echo $aluno['nome']; ?>" /><br/><br/>

	E-mail do aluno:<br/>
	<input type="email" name="email" value="<?php echo $aluno['email']; ?>" /><br/><br/>

	Senha do aluno:<br/>
	<input type="password" name="senha" value="<?php echo $aluno['senha']; ?>" /><br/><br/>

	Cursos inscritos: (Segure CTRL para selecionar outros cursos)<br/>
	<select name="cursos[]" multiple style="height:150px">
            
            <!--exibe os cursos que o aluno pode se cadastrar -->
		<?php foreach($cursos as $curso): ?>
		<option value="<?php echo $curso['id']; ?>" <?php
                //cursos que o aluno está inscrito
		if(in_array($curso['id'], $inscrito)) {
			echo 'selected="selected"';
		}
		?>><?php echo $curso['nome']; ?></option>
		<?php endforeach; ?>
	</select><br/><br/>

	<input type="submit" value="Salvar" />

</form>