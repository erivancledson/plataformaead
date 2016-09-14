<h1>Editar Aula - Questionário</h1>
<!-- editar aula questionario do painel adm-->
<form method="POST">

	Pergunta:<br/>
	<input type="text" name="pergunta" value="<?php echo $aula['pergunta']; ?>" /><br/><br/>

	Opção 1:<br/>
	<input type="text" name="opcao1" value="<?php echo $aula['opcao1']; ?>" /><br/><br/>

	Opção 2:<br/>
	<input type="text" name="opcao2" value="<?php echo $aula['opcao2']; ?>" /><br/><br/>

	Opção 3:<br/>
	<input type="text" name="opcao3" value="<?php echo $aula['opcao3']; ?>" /><br/><br/>

	Opção 4:<br/>
	<input type="text" name="opcao4" value="<?php echo $aula['opcao4']; ?>" /><br/><br/>

	Resposta:<br/>
	<select name="resposta">
		<option value="1" <?php echo ($aula['resposta']=='1')?'selected="selected"':''; ?>>Opção 1</option>
		<option value="2" <?php echo ($aula['resposta']=='2')?'selected="selected"':''; ?>>Opção 2</option>
		<option value="3" <?php echo ($aula['resposta']=='3')?'selected="selected"':''; ?>>Opção 3</option>
		<option value="4" <?php echo ($aula['resposta']=='4')?'selected="selected"':''; ?>>Opção 4</option>
	</select><br/><br/>

	<input type="submit" value="Salvar" />

</form>