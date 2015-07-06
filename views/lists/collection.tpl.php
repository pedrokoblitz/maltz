<section id="albums">

	<div class="page-header">
		<h1>Albums</h1>
		<p class="lead"></p>
		<a class="btn btn-primary" href="<?php $this->e('/api/album/new');?>">new</a>
	</div>

	<?php if (isset($data['data.list']) && is_array($data['data.list']) && !empty($data['data.list'])) : foreach ($data['data.list'] as $item) :
?>

		<div id="album-<?php $this->e($item['album_id']);?>" class="span12 album-<?php $this->e($item['album_id']);?> album item">
			<div class="row">

				<div class="span8">
					<h3 class="title pt-br"><?php $this->e($item['title']);?></h3>
					<h3 class="title_en en-us"><?php $this->e($item['title_en']);?></h3>

				</div>


				<div class="span4">
					<?php $this->partial('blocks/list.actions.tpl.php', array('item' => $item));?>
				</div>

				<div class="span12">
					<?php if(isset($item['photos'])) : foreach ($item['photos'] as $photo) :
?>
						<img src="<?php $this->e($l->gen('media', $photo['name'] . '_tn.' . $photo['extension']));?>">
					<?php
endforeach; endif;?>
				</div>

			<div class="clear">&nbsp;</div>
			</div>
		<div class="clear">&nbsp;</div>
		</div>

	<?php
endforeach; endif;?>
	<?php if(isset($data['pagination.pages'])) {$this->backEndPg($data['pagination.pages'], 'albums'); };?>

</section>
