<section id="contents">
	<div class="page-header">
		<h1>Contents</h1>
		<p class="lead"></p>
		<a class="btn btn-primary" href="<?php $this->e('/api/content/new');?>">new</a>
	  </div>

	<?php if (isset($data['data.list']) && is_array($data['data.list']) && !empty($data['data.list'])) : foreach ($data['data.list'] as $item) :
?>

		<div id="content-<?php $this->e($item['id']);?>" class="span12 content-<?php $this->e($item['id']);?> content item">
			<div class="row">
				<div class="span4">
				<?php if (isset($item['content.cover'])) : ?>
					<img src="<?php $this->e($l->gen('media') . '/' . $item['content.cover']['name'] . '_tn.' . $item['content.cover']['extension']);?>">
				<?php endif; ?>
				</div>

				<div class="span4">
					<h3 class="title pt-br"><?php $this->e($item['title']);?></h3>
					<h3 class="title_en en-us"><?php $this->e($item['title_en']);?></h3>

				</div>

				<div class="span4">
					<?php $this->partial('blocks/list.actions.content.tpl.php', array('data' => $data, 'item' => $item));?>
				</div>

			<div class="clear">&nbsp;</div>
			</div>
		<div class="clear">&nbsp;</div>
		</div>
	<?php
endforeach; endif; ?>
	<?php if(isset($data['pagination.pages'])) {$this->backEndPg($data['pagination.pages'], 'contents', 1); };?>

</section>
