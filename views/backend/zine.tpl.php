<?php

	$data = date('d/m/Y');
?>
<!-- -->
<section id="zine">
	<!-- -->
  <div class="page-header">
		<div class="row">
			<div class="span5 offset2"><h1>Zine</h1></div>
			<div class="span5"><p class="lead"></p></div>
		</div>
  </div>

	<!-- -->
	<form action="<?php echo $l->gen('salvar'); ?>" method="POST" class="form-horizontal">

	  <div class="span6">

			<div class="control-group pt-br">
				<label class="control-label" for="titulo">título</label>
				<div class="controls">
					<input id="zineTitulo" class="titulo text" type="text" name="titulo" value="<?php if (isset($conteudo['titulo'])) echo $conteudo['titulo']; ?>" placeholder="título">
				</div>
			</div>

			<div class="control-group en-us">
				<label class="control-label" for="titulo_en">title</label>
				<div class="controls">
					<input id="zineTituloEn" class="titulo text" type="text" name="titulo_en" value="<?php if (isset($conteudo['titulo_en'])) echo $conteudo['titulo_en']; ?>" placeholder="title">
				</div>
			</div>

			<div class="control-group pt-br">
				<label class="control-label" for="descricao">descrição</label>
				<div class="controls">
					<input id="zineDescricao" class="descricao text" type="text" name="descricao" value="<?php if (isset($conteudo['descricao'])) echo $conteudo['descricao']; ?>" placeholder="descrição">
				</div>
			</div>

			<div class="control-group en-us">
				<label class="control-label" for="descricao_en">description</label>
				<div class="controls">
					<input id="zineDescricaoEn" class="descricao text" type="text" name="descricao_en" value="<?php if (isset($conteudo['descricao_en'])) echo $conteudo['descricao_en']; ?>" placeholder="description">
				</div>
			</div>

  </div>

  <div class="span6">

			<div class="control-group">
				<label class="control-label" for="data">data</label>
				<div class="controls">
					<input id="data" class="data text" type="text" name="data" value="<?php if (isset($conteudo['data'])) {echo $conteudo['data'];} else {echo $data;} ?>" placeholder="data">
				</div>
			</div>

		<?php echo partial('blocos/form.acoes.conteudo.tpl.php');?>


	</div>

	<div class="span12">

		<label class="galeria">Escolha uma galeria</label>
			<div id="myCarousel" class="carousel slide well">
				<!-- Carousel items -->
				<div class="carousel-inner">

<?php 
	if (isset($galerias)) {
		$max = count($galerias);
		for ($i = 0; $i < $max; $i++)
		{
			$r = $i % 6;
			$ativo = '';
			
			if ($galerias[$i]['galeriaId'] == $conteudo['galeriaId']) {$ativo = ' active';} 
			$itemA = '';
			$itemB = '';

			if ($i == 0) {
				$ativo = ' active';
			}

			if ($r == 0) {
				$itemA = '<div class="item'.$ativo.'">';
			} 
			if ($r == 5 || $i == $max) {
				$itemB = '</div>';
			}
			echo $itemA;

?>
					<div class="spanCarousel">
						<label class="galeria">
					    <img <?php echo 'id="galeria-'.$galerias[$i]['galeriaId'].'" '; if($galerias[$i]['galeriaId'] == $conteudo['galeriaId']) echo "class=\"galeriaSelecionado\""; ?>src="<?php 
echo $l->gen('/public/media/'. $galerias[$i]['fotos'][0]['nome'] .'_tn.'.$galerias[$i]['fotos'][0]['extensao']); 
?>
" />
				  </label>	
				</div>

<?php
			echo $itemB;
		}
	}

?>
				</div>
			  <!-- Carousel nav -->
			  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
			  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
			</div>

		</div>

		<div class="clearfix">&nbsp;</div>

		<div class="span12">

			<div class="pt-br">
				<textarea id="zineCorpo" class="corpo textarea inputCorpo" name="corpo"><?php if (isset($conteudo['corpo'])) echo $conteudo['corpo']; ?></textarea>
			</div>

			<div class="en-us">
				<textarea id="zineCorpoEn" class="textarea corpo inputCorpo" name="corpo_en"><?php if (isset($conteudo['corpo_en'])) echo $conteudo['corpo_en']; ?></textarea>
			</div>

		</div>
	</form>
</section>

  
<?php echo partial('blocos/apagar.modal.tpl.php');?>

<div id="seletorCapa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="mySeletorLabel">selecionar capa</h3>
  </div>
  <div class="modal-body">
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
  </div>

</div>


