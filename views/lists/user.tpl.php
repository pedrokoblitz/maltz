	<section id="users">
          <div class="page-header">
            <h1>Usuários</h1>
		<p class="lead"></p>
		<a class="btn btn-primary" href="<?php $this->e($l->gen('new'));?>">new</a>
          </div>

		<?php if (isset($data['data.list']) && is_array($data['data.list']) && !empty($data['data.list'])) : foreach ($data['data.list'] as $item) :
?>

			<div id="user-<?php $this->e($item['user_id']);?>" class="span3 user-<?php $this->e($item['user_id']);?> user item">
						<h3 class="name"><?php $this->e($item['name']);?></h3>
						<strong><addr class="email"><?php $this->e($item['email']);?></addr></strong>
						<!--p class="type"><?php $this->e($item['type']);?></p-->
						<?php $this->partial('blocks/list.actions.tpl.php', array('item' => $item));?>
					</div>


		<?php
endforeach; endif;?>
	<?php
    if (isset($data['pagination.pages'])) {$this->backEndPg($data['pagination.pages'], 'users');}
?>

	</section>


