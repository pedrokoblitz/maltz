<div class="actions">
						<p class="data created"><?php $this->e($item['created'])?></p>

		<?php if ($item['activity'] == 1) :
?>
			<div id="deactivate-<?php $this->e($item['id'])?>" class="deactivate btn btn-success">activity</div>
		<?php
endif;?>

		<?php if ($item['activity'] == 0) :
?>
			<div id="activate-<?php $this->e($item['id'])?>" class="activate btn btn-warning">inactivity</div>
		<?php
endif;?>

	<a href="<?php $this->e('/admin/' . $data['info.slug'] . '/' . $item['id'] . '/edit');?>" id="edit-<?php $this->e($item['id'])?>" class="edit btn btn-primary">edit</a>

	</div>



