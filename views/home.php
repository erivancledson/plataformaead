
<!--lista de cursos que o aluno ta cadastrado -->
<h1>Seus Cursos</h1>
<?php foreach($cursos as $curso): ?>
<!--link dos cursos -->
<a href="<?php echo BASE; ?>cursos/entrar/<?php echo $curso['id_curso']; ?>">
<div class="cursoitem">
    <!--imagem do curso -->
	<img src="<?php echo BASE; ?>assets/images/cursos/<?php echo $curso['imagem']; ?>" border="0" width="260" height="150" /><br/><br/>
<!--nome do curso -->
	<strong><?php echo $curso['nome']; ?></strong><br/><br/>
<!--descricao do curso -->
	<?php echo $curso['descricao']; ?>
</div>
</a>
<?php endforeach; ?>