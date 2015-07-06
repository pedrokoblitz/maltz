<section id="panel">

	<br>
	<br>
	<br>


	<div class="span5">
<h2> conteúdo </h2>
		<div class="tabbable tabs-left">

				<ul class="nav nav-tabs" id="panelTabs">
					<li class="active"><a href="#contents">contents</a></li>
					<li><a href="#pages">pages</a></li>
					<li><a href="#albums">albums</a></li>
					<li><a href="#books">books</a></li>
				</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="contents">
					<a class="btn btn-small" href="<?php $this->e('');?>"><i class="icon-align-justify"></i> list</a>
					<a class="btn btn-small" href="<?php $this->e('');?>"><i class="icon-pencil"></i> new</a>
					<ul class="itens">
					<?php if (isset($data['data.contents'])) : foreach ($data['data.contents'] as $item) :
?>
						<li>
							<a class="" rel="tooltip" title="edit" href="<?php $this->e($l->gen('editContent') . '/' . $item['id']);?>">
								<i class="icon-edit"></i>
							</a>
							<?php $this->e($item['title']);?>
						</li>
					<?php
endforeach; endif;?>
					</ul>
				</div>

				<div class="tab-pane" id="pages">
					<a class="btn btn-small" href="<?php $this->e('');?>"><i class="icon-align-justify"></i> list</a>
					<a class="btn btn-small" href="<?php $this->e('');?>">new</a>
					<ul class="itens">
					<?php if (isset($data['data.pages'])) : foreach ($data['data.pages'] as $item) :
?>
						<li>
							<a rel="tooltip" title="edit" href="<?php $this->e($l->gen('editPage') . '/' . $item['id']);?>">
								<i class="icon-edit"></i>
							</a>
							<?php $this->e($item['title']);?>
						</li>
					</ul>
				<?php
endforeach; endif;?>
				</div>
				<div class="tab-pane" id="albums">

					<a class="btn btn-small" href="<?php $this->e('');?>"><i class="icon-align-justify"></i> list</a>
					<a class="btn btn-small" href="<?php $this->e('');?>"><i class="icon-pencil"></i> new</a>
					<ul class="itens">
					<?php if (isset($data['data.albums'])) : foreach ($data['data.albums'] as $item) :
?>
						<li>
							<a rel="tooltip" title="edit" href="<?php $this->e($l->gen('editAlbum') . '/' . $item['id']);?>">
								<i class="icon-edit"></i>
							</a>
						<?php $this->e($item['title']);?>
						</li>
					<?php
endforeach; endif;?>
					</ul>
				</div>


				<div class="tab-pane" id="books">
					<a class="btn btn-small" href="<?php $this->e('');?>"><i class="icon-align-justify"></i> list</a>
					<a class="btn btn-small" href="<?php $this->e('');?>"><i class="icon-pencil"></i> new</a>
					<ul class="itens">
					<?php if (isset($data['data.books'])) : foreach ($data['data.books'] as $item) :
?>
						<li>
							<a class="" rel="tooltip" title="edit" href="<?php $this->e('');?>">
								<i class="icon-edit"></i>
							</a>
							<?php $this->e($item['title']);?>
						</li>
					<?php
endforeach; endif;?>
					</ul>
				</div>

			</div>

		</div>

	</div>

	<div class="span7">
	<h2> atividade </h2>
	<table class="table table-striped table-condensed">
	  <thead>
      <tr>
				  <th>usuário</th>
          <th>action</th>
          <th>model</th>
          <th>objeto</th>
          <th>data</th>
		  </tr>
	  </thead>
		<?php if (isset($data['data.log'])) : foreach ($data['data.log'] as $log) :
?>
	  </body>
      <tr>
				  <td><?php $this->e($log['user']);?></td>
          <td><?php $this->e($log['action']);?></td>
          <td><?php $this->e($log['model']);?></td>
          <td><a href="<?php $this->e($l->gen('index.php/admin/') . '/' . $log['model'] . '/edit/' . $log['object_id']);?>"><?php $this->e($log['object_id']);?></a></td>
          <td><?php //$this->e($this->date($log['created'], 'juntar'));?></td>
		  </tr>
		<?php
endforeach; endif;?>
	  </tbody>
  </table>
	</div>
</section>
