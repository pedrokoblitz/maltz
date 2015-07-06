<section id="files">
	<div class="page-header">
		<h1>Files</h1>
		<p class="lead"></p>
	</div>

	<?php if (isset($data['data.list']) && is_array($data['data.list']) && !empty($data['data.list'])) : foreach ($data['data.list'] as $item) :
?>

		<div id="file-<?php $this->e($item['file_id']);?>" class="span12 file-<?php $this->e($item['file_id']);?> file item">
			<div class="row">
				<div class="span1">
					<?php if ($item['extension'] != 'pdf') {
    ?>
					<img src="<?php $this->e($l->gen('media', $item['name'] . '_tn.' . $item['extension']));?>">
					<?php
} else {
    $this->e('&nbsp;');
}?>
				</div>

				<div class="span3">
					<h5 class="title pt-br"><?php $this->e($item['title']);?></h5>
				</div>

				<div class="span3 offset5">
					<?php $this->partial('blocks/list.actions.tpl.php', array('item' => $item));?>
				</div>

			<div class="clear">&nbsp;</div>
			</div>
		<div class="clear">&nbsp;</div>
		</div>
	<?php
endforeach; endif;?>
	<?php if(isset($data['pagination.pages'])) {$this->backEndPg($data['pagination.pages'], 'files'); };?>

</section>
