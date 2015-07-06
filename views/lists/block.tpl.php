	<section id="blocks">

          <div class="page-header">
            <h1>Blocks</h1>
		<p class="lead"></p>
          </div>

		<?php if (isset($data['data.list'])) : foreach ($data['data.list'] as $item) :
?>

				<div id="block-<?php $this->e($item['block_id']);?>" class="span3 block-<?php $this->e($item['block_id']);?> block item">
						<h3 class="title pt-br"><?php $this->e($item['title']);?></h3>
						<h3 class="title_en en-us"><?php $this->e($item['title_en']);?></h3>

					<div class="actions">

		<?php if ($item['activity'] == 1) :
?>
			<div id="deactivate-<?php $this->e($item[$info['identifier']])?>" class="deactivate btn btn-success">activity</div>
		<?php
endif;?>

		<?php if ($item['activity'] == 0) :
?>
			<div id="activate-<?php $this->e($item[$info['identifier']])?>" class="activate btn btn-warning">inactivity</div>
		<?php
endif;?>

	<a href="<?php $this->e($l->gen('edit'));?>/<?php $this->e($item[$info['identifier']])?>" id="edit-<?php $this->e($item[$info['identifier']])?>" class="edit btn btn-primary">edit</a>

	</div>



				<div class="clear">&nbsp;</div>
				</div>
		<?php
endforeach; endif;?>
	<?php
    if(isset($data['pagination.pages'])) {$this->backEndPg($data['pagination.pages'], 'blocks'); };
?>

	</section>


