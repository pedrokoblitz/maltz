<div class="acoes">
						<p class="data criado"><?php echo $t->data($item['criado'],'juntar')?></p>

		<?php if ($item['ativo'] == 1) : ?>
			<div id="desativar-<?php echo $item[$info['identificador']]?>" class="desativar btn btn-success">ativo</div>
		<?php endif;?>

		<?php if ($item['ativo'] == 0): ?>
			<div id="ativar-<?php echo $item[$info['identificador']]?>" class="ativar btn btn-warning">inativo</div>
		<?php endif;?>

	<a href="<?php echo $l->gen('editar');?>/<?php echo $item[$info['identificador']]?>" id="editar-<?php echo $item[$info['identificador']]?>" class="editar btn btn-primary">editar</a>

	</div>



