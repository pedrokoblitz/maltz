<!-- -->
<section id="galeria">



	<!-- -->
	<div class="page-header">
		<div class="row">
			<div class="span5 offset2"><h1>Galeria</h1></div>
			<div class="span5"><p class="lead"></p></div>
		</div>
	</div>

	<!-- -->
	<form id="form" action="<?php echo $l->gen('salvar'); ?>" method="POST" class="form-horizontal">

		<div class="span6">

			<div class="control-group pt-br">

				<label class="control-label" for="titulo">título</label>

				<div class="controls">

					<input id="galeriaTitulo" class="titulo text" type="text" name="titulo" value="<?php if (isset($conteudo['titulo'])) echo $conteudo['titulo']; ?>" placeholder="título">

				</div>

			</div>

		</div>

		<div class="span6">

			<div class="acoes">
			<?php echo partial('blocos/form.acoes.tpl.php');?>


			</div>

		</div>
		</form>
		<form id="salvarOrdemForm" action="<?php echo $l->gen('salvarOrdem'); ?>" method="POST" class="form-horizontal">
		<div class="span12">
				<?php if (isset($fotosGaleria)) : ?>
				<div class="row">
					<?php foreach ($fotosGaleria as $foto) : ?>
						<div class="span3 item">
							<img src="<?php echo $l->gen('/public/media/'.$foto['nome'].'_tn.'.$foto['extensao']);?>">
							<br>
							<br>
							<select class="input-mini" name="ordem[]">
								<?php
									for ($i = 0; $i < count($fotosGaleria); $i++)
									{
										?>

										<option value="<?php echo $i;?>"<?php if ($i == $foto['ordem']) { echo ' selected';} ?>><?php echo $i;?></option>

										<?php
									}
									
								?>
							</select>
							<input type="hidden" name="galeriaId[]" value="<?php echo params('id');?>">
							<input type="hidden" name="fotoId[]" value="<?php echo $foto['arquivoId']?>">
						</div>
					<?php endforeach; ?>
					</div>
					<br>
					<a href="#" id="salvarOrdem" class="btn">Salvar ordem</a>
				<?php endif; ?>
		</div>
		</form>

		<div class="clear">&nbsp;</div>
</section>

<?php echo partial('blocos/apagar.modal.tpl.php');?>

