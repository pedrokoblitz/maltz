<section id="bloco">

	<!-- -->
  <div class="page-header">
		<div class="row">
			<div class="span5 offset2"><h1>Bloco</h1></div>
			<div class="span5"><p class="lead"></p></div>
		</div>
  </div>

	<!-- -->
	<form action="<?php echo $l->gen('salvar'); ?>" method="POST" class="form-horizontal">

	  <div class="span6">

			<div class="control-group pt-br">
				<label class="control-label" for="titulo">título</label>
				<div class="controls">
					<input id="blocoTitulo" class="titulo text" type="text" name="titulo" value="<?php if (isset($conteudo['titulo'])) echo $conteudo['titulo']; ?>" placeholder="título" disabled>
				</div>
			</div>

			<div class="control-group en-us">
				<label class="control-label" for="titulo_en">title</label>
				<div class="controls">
					<input id="blocoTituloEn" class="titulo text" type="text" name="titulo_en" value="<?php if (isset($conteudo['titulo_en'])) echo $conteudo['titulo_en']; ?>" placeholder="title" disabled>
				</div>
			</div>



  </div>

  <div class="span6">

			<!--div class="control-group">
				<label class="control-label" for="area">área</label>
				<div class="controls">
					<select id="blocoArea" class="area select" name="area">

						<option value="blog"<?php if ($conteudo['area'] == 'blog') echo ' selected'; ?>>lateral blog</option>

						<option value="projeto"<?php if ($conteudo['area'] == 'projeto') echo ' selected'; ?>>lateral projeto</option>

						<option value="contato"<?php if ($conteudo['area'] == 'contato') echo ' selected'; ?>>lateral contato</option>
					</select>
				</div>
			</div-->



<div class="acoes">
	<a href="<?php echo $l->gen('listar'); ?>" class="btn">todos</a>
	<a href="<?php echo $l->gen('novo'); ?>" class="btn">novo</a>

	<div id="salvar" class="btn btn-primary">salvar</div>

	<?php if ($conteudo['ativo'] == 1) : ?>
	<div id="desativar-<?php echo $conteudo[$info['identificador']];?>" class="desativar btn btn-success">ativo</div>
	<?php endif;?>
	<?php if ($conteudo['ativo'] == 0): ?>
	<div id="ativar-<?php echo $conteudo[$info['identificador']];?>" class="ativar btn btn-warning">inativo</div>
	<?php endif;?>
</div>




	</div>

		<div class="span12">
<br><br>
			<div class="pt-br">
				<textarea id="blocoCorpo" class="corpo textarea inputCorpo" name="corpo"><?php if (isset($conteudo['corpo'])) echo $conteudo['corpo']; ?></textarea>
			</div>

			<div class="en-us">
				<textarea id="blocoCorpoEn" class="textarea corpo inputCorpo" name="corpo_en"><?php if (isset($conteudo['corpo_en'])) echo $conteudo['corpo_en']; ?></textarea>
			</div>

		</div>
	</form>
</section>


