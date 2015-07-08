
<div class="acoes">
	<a href="<?php echo $l->gen('listar'); ?>" class="btn">todos</a>
	<a href="<?php echo $l->gen('novo'); ?>" class="btn">novo</a>

	<div id="salvar" class="btn btn-primary">salvar</div>

	<?php if ($conteudo['ativo'] == 1) : ?>
	<div id="desativar-<?php echo $conteudo[$info['identificador']];?>" class="desativar btn btn-success">ativo</div>
	<?php endif;?>
	<?php if ($conteudo['ativo'] == 0): ?>
	<div id="ativar-<?php echo $conteudo[$info['identificador']];?>" class="ativar btn btn-warning">inativo</div>
	<?php endif;?>

	<a href="#apagarModal" role="button" data-toggle="modal" class="btn btn-danger">apagar</a>
	<a id="seletorCapaLink"  data-toggle="modal" role="button" data-target="#seletorCapa" class="btn">capa</a>

</div>


