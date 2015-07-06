	<section id="log">
          <div class="page-header">
            <h1>Logs</h1>
		<p class="lead"></p>
          </div>


				<div class="row">

					<div class="span3">
						&nbsp;
					</div>

					<div class="span9">
<table class="table table-striped">
	  <thead>
      <tr>
				  <th>usuário</th>
          <th>action</th>
          <th>component</th>
          <th>objeto</th>
          <th>data</th>
		  </tr>
	  </thead>
			  <tbody>
    	<?php if (isset($data['data.list']) && is_array($data['data.list']) && !empty($data['data.list'])) : foreach ($data['data.list'] as $item) :
?>
	  <tr>

		  <td><i class="icon-user"></i> <?php $this->e($item['user']);?></td>
          <td><i class=""></i> <?php $this->e($item['component']);?></td>
          <td><i class=""></i> <?php $this->e($item['action']);?></td>
          <td><i class=""></i> <a href="<?php $this->e($l->gen('/admin') . '/' . $item['component'] . '/edit/' . $item['objeto_id']);?>"><?php $this->e($item['objeto_id']);?></a></td>
          <td><?php $this->e($item['created']);?> <i class="icon-time"></i></td>
		  </tr>

		<?php
endforeach; endif;?>
			  </tbody>
    		</table>

				<div class="clear">&nbsp;</div>
				</div>
			<div class="clear">&nbsp;</div>
			</div>
	<?php
    if(isset($data['pagination.pages'])) {$this->backEndPg($data['pagination.pages'], 'log'); };
?>

	</section>


