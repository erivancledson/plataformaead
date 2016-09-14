
<!--area do curso selecionado -->
<div class="cursoinfo">
	<img src="<?php echo BASE; ?>assets/images/cursos/<?php echo $curso->getImagem(); ?>" border="0" height="60" />

	<h3><?php echo $curso->getNome(); ?></h3>
	<?php echo $curso->getDescricao(); ?><br/>
	<?php echo $aulas_assistidas.' / '.$total_aulas.' ('.(($aulas_assistidas/$total_aulas)*100).'%)'; ?>
</div>
<div class="curso_left">
    <!--pegando os modulos -->
	<?php foreach($modulos as $modulo): ?>
		<div class="modulo"><?php echo utf8_encode($modulo['nome']); ?></div>
                 <!--pegando as aulas do modulo -->
		<?php foreach($modulo['aulas'] as $aula): ?>
		<a href="<?php echo BASE; ?>cursos/aula/<?php echo $aula['id']; ?>">
			<div class="aula">
				<?php echo $aula['nome']; ?>
                            <!--icone marcando se aula foi assistida -->
				<?php if($aula['assistido'] === true): ?>
				<img style="float:right;margin-right:10px;margin-top:5px" src="<?php echo BASE; ?>assets/images/v.png" border="0" height="20" />
				<?php endif; ?>
			</div>
		</a>
		<?php endforeach; ?>
	<?php endforeach; ?>
</div>
<div class="curso_right">

</div>