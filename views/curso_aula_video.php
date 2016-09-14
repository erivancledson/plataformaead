<div class="cursoinfo">
	<img src="<?php echo BASE; ?>assets/images/cursos/<?php echo $curso->getImagem(); ?>" border="0" height="60" />

	<h3><?php echo $curso->getNome(); ?></h3>
	<?php echo $curso->getDescricao(); ?><br/>
	<?php echo $aulas_assistidas.' / '.$total_aulas.' ('.(($aulas_assistidas/$total_aulas)*100).'%)'; ?>	
</div>
<div class="curso_left">
	<?php foreach($modulos as $modulo): ?>
		<div class="modulo"><?php echo utf8_encode($modulo['nome']); ?></div>
		<?php foreach($modulo['aulas'] as $aula): ?>
		<a href="<?php echo BASE; ?>cursos/aula/<?php echo $aula['id']; ?>">
			<div class="aula">
				<?php echo $aula['nome']; ?>
				<?php if($aula['assistido'] === true): ?>
				<img style="float:right;margin-right:10px;margin-top:5px" src="<?php echo BASE; ?>assets/images/v.png" border="0" height="20" />
				<?php endif; ?>
			</div>
		</a>
		<?php endforeach; ?>
	<?php endforeach; ?>
</div>
<div class="curso_right">
    <!-- video e o nome do video-->
	<h1>Vídeo - <?php echo $aula_info['nome']; ?></h1>
         <!-- url do video-->
	<iframe id="video" style="width:100%" frameborder="0" src="//player.vimeo.com/video/<?php echo $aula_info['url']; ?>"></iframe><br/>
	 <!-- descricao do video-->
            <?php echo $aula_info['descricao']; ?><br/>
            <!--marca a aula como assistida -->
	<?php if($aula_info['assistido'] == '1'): ?>
		Esta aula já foi assistida!
	<?php else: ?>
                 <!--js que marca a aula como assistida -->
                 <!--data-id marca o id como assistido -->
		<button onclick="marcarAssistido(this)" data-id="<?php echo $aula_info['id_aula']; ?>">Marcar como assistido</button>
	<?php endif; ?>
	<hr/>
	<h3>Dúvidas? Envie sua pergunta!</h3>
	<form method="POST" class="form_duvida">
		<textarea name="duvida"></textarea><br/><br/>

		<input type="submit" value="Enviar Dúvida" />
	</form>
</div>