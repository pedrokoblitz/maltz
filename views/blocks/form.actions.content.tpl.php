
<div class="actions">
	<a href="<?php $this->e($data['data.record']['actions']['index']);?>" class="btn">todos</a>
	<a href="<?php $this->e($data['data.record']['actions']['new']);?>" class="btn">new</a>

	<div id="save" class="btn btn-primary">save</div>

	<?php if ($data['activity'] == 1) :
?>
	<div id="deactivate-<?php $this->e($data[$data['info.identifier']]);?>" class="deactivate btn btn-success">activity</div>
	<?php
endif;?>
	<?php if ($data['activity'] == 0) :
?>
	<div id="activate-<?php $this->e($data[$data['info.identifier']]);?>" class="activate btn btn-warning">inactivity</div>
	<?php
endif;?>

	<a href="#deleteModal" role="button" data-toggle="modal" class="btn btn-danger">delete</a>
	<a id="seletorCoverLink"  data-toggle="modal" role="button" data-target="#seletorCover" class="btn">capa</a>

</div>


