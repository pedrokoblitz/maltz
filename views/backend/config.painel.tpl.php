<section id="painel">

	<br>
	<br>
	<br>



	<div class="span5">
<h2> conteúdo </h2>
		<div class="tabbable tabs-left">

				<ul class="nav nav-tabs" id="painelTabs">
					<li class="active"><a href="#painel">painel</a></li>
					<li><a href="#capa">capa</a></li>
					<li><a href="#email">email</a></li>
					<li><a href="#social">social</a></li>
					<li><a href="#outros">outros</a></li>
				</ul>

			<div class="tab-content">

				<div class="tab-pane active" id="painel">
					<ul class="itens">


						<li>
							<a class="" rel="tooltip" title="apagar" href="<?php echo $l->gen('apagarConfig').'/'.$item['configId']; ?>">
								<i class="icon-trash"></i>
							</a>
							<a class="" rel="tooltip" title="editar" href="<?php echo $l->gen('editarConfig').'/'.$item['configId']; ?>">
								<i class="icon-edit"></i>
							</a>
							<?php echo $item['titulo'];?>
						</li>


					</ul>
				</div>


				<div class="tab-pane" id="capa">
					<ul class="itens">


						<li>
							<a class="" rel="tooltip" title="apagar" href="<?php echo $l->gen('apagarConfig').'/'.$item['configId']; ?>">
								<i class="icon-trash"></i>
							</a>
							<a class="" rel="tooltip" title="editar" href="<?php echo $l->gen('editarConfig').'/'.$item['configId']; ?>">
								<i class="icon-edit"></i>
							</a>
							<?php echo $item['titulo'];?>
						</li>


					</ul>
				</div>

				<div class="tab-pane" id="email">
					<ul class="itens">


						<li>
							<a class="" rel="tooltip" title="apagar" href="<?php echo $l->gen('apagarConfig').'/'.$item['configId']; ?>">
								<i class="icon-trash"></i>
							</a>
							<a class="" rel="tooltip" title="editar" href="<?php echo $l->gen('editarConfig').'/'.$item['configId']; ?>">
								<i class="icon-edit"></i>
							</a>
							<?php echo $item['titulo'];?>
						</li>


					</ul>
				</div>

				<div class="tab-pane active" id="social">
					<ul class="itens">


						<li>
							<a class="" rel="tooltip" title="apagar" href="<?php echo $l->gen('apagarConfig').'/'.$item['configId']; ?>">
								<i class="icon-trash"></i>
							</a>
							<a class="" rel="tooltip" title="editar" href="<?php echo $l->gen('editarConfig').'/'.$item['configId']; ?>">
								<i class="icon-edit"></i>
							</a>
							<?php echo $item['titulo'];?>
						</li>


					</ul>
				</div>


				<div class="tab-pane active" id="outros">
					<ul class="itens">


						<li>
							<a class="" rel="tooltip" title="apagar" href="<?php echo $l->gen('apagarConfig').'/'.$item['configId']; ?>">
								<i class="icon-trash"></i>
							</a>
							<a class="" rel="tooltip" title="editar" href="<?php echo $l->gen('editarConfig').'/'.$item['configId']; ?>">
								<i class="icon-edit"></i>
							</a>
							<?php echo $item['titulo'];?>
						</li>


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
          <td><?php echo $log['objetoId'];?></td>
          <td><?php echo $t->data($log['criado'],'juntar');?></td>
		  </tr>
		<?php endforeach;?>
	  </tbody>
  </table>
	</div>
</section>
