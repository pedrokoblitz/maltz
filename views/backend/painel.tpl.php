<section id="painel">

	<br>
	<br>
	<br>


	<div class="span5">
<h2> conteúdo </h2>
		<div class="tabbable tabs-left">

				<ul class="nav nav-tabs" id="painelTabs">
					<li class="active"><a href="#projetos">projetos</a></li>
					<li><a href="#paginas">paginas</a></li>
					<li><a href="#galerias">galerias</a></li>
					<li><a href="#zines">zines</a></li>
				</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="projetos">
					<a class="btn btn-small" href="<?php echo $l->gen('listarProjeto'); ?>"><i class="icon-align-justify"></i> listar</a>
					<a class="btn btn-small" href="<?php echo $l->gen('novoProjeto'); ?>"><i class="icon-pencil"></i> novo</a>
					<ul class="itens">
					<?php foreach ($conteudo['projetos']['conteudo'] as $item) : ?>
						<li>
							<a class="" rel="tooltip" title="editar" href="<?php echo $l->gen('editarProjeto').'/'.$item['projetoId']; ?>">
								<i class="icon-edit"></i>
							</a>
							<?php echo $item['titulo'];?>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>

				<div class="tab-pane" id="paginas">
					<a class="btn btn-small" href="<?php echo $l->gen('listarPagina'); ?>"><i class="icon-align-justify"></i> listar</a>
					<a class="btn btn-small" href="<?php echo $l->gen('novaPagina'); ?>">nova</a>
					<ul class="itens">
					<?php foreach ($conteudo['paginas']['conteudo'] as $item) : ?>
						<li>
							<a rel="tooltip" title="editar" href="<?php echo $l->gen('editarPagina').'/'.$item['paginaId']; ?>">
								<i class="icon-edit"></i>				
							</a>
							<?php echo $item['titulo'];?>
						</li>
					</ul>
				<?php endforeach; ?>
				</div>
				<div class="tab-pane" id="galerias">

					<a class="btn btn-small" href="<?php echo $l->gen('listarGaleria'); ?>"><i class="icon-align-justify"></i> listar</a>
					<a class="btn btn-small" href="<?php echo $l->gen('novaGaleria'); ?>"><i class="icon-pencil"></i> nova</a>
					<ul class="itens">
					<?php foreach ($conteudo['galerias']['conteudo'] as $item) : ?>
						<li>
							<a rel="tooltip" title="editar" href="<?php echo $l->gen('editarGaleria').'/'.$item['galeriaId']; ?>">
								<i class="icon-edit"></i>
							</a>
						<?php echo $item['titulo'];?>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>


				<div class="tab-pane" id="zines">
					<a class="btn btn-small" href="<?php echo $l->gen('listarZine'); ?>"><i class="icon-align-justify"></i> listar</a>
					<a class="btn btn-small" href="<?php echo $l->gen('novoZine'); ?>"><i class="icon-pencil"></i> novo</a>
					<ul class="itens">
					<?php foreach ($conteudo['zines']['conteudo'] as $item) : ?>
						<li>
							<a class="" rel="tooltip" title="editar" href="<?php echo $l->gen('editarZine').'/'.$item['zineId']; ?>">
								<i class="icon-edit"></i>
							</a>
							<?php echo $item['titulo'];?>
						</li>
					<?php endforeach; ?>
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
          <th>acao</th>
          <th>componente</th>    
          <th>objeto</th>    
          <th>data</th>
		  </tr>
	  </thead>
		<?php foreach ($conteudo['log']['conteudo'] as $log) :?>
	  </body>
      <tr>
				  <td><?php echo $log['usuario'];?></td>
          <td><?php echo $log['acao'];?></td>
          <td><?php echo $log['componente'];?></td>
          <td><a href="<?php echo $l->gen('index.php/admin/').'/'.$log['componente'].'/editar/'.$log['objetoId'];?>"><?php echo $log['objetoId'];?></a></td>
          <td><?php echo $t->data($log['criado'],'juntar');?></td>
		  </tr>
		<?php endforeach;?>
	  </tbody>
  </table>
	</div>
</section>
