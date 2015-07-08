<!-- -->
<section id="usuario">

	<!-- -->
	<div class="page-header">
		<div class="row">
			<div class="span5 offset2"><h1>Usuário</h1></div>
			<div class="span5"><p class="lead"></p></div>
		</div>
	</div>
	<!-- -->
	<form action="<?php echo $l->gen('salvar'); ?>" method="POST" class="form-horizontal">

		<div class="span6">

		<div class="control-group">
			<label class="control-label" for="username">nome de usuário</label>
			<div class="controls">
				<input id="usuarioUsername" class="username text" type="text" name="username" value="<?php if (isset($conteudo['usuarioId'])) echo $conteudo['username']; ?>" placeholder="nome de usuário">
			</div>
		</div>


		<div class="control-group">
			<label class="control-label" for="nome">nome</label>
			<div class="controls">
				<input id="usuarioNome" class="nome text" type="text" name="nome" value="<?php if (isset($conteudo['nome'])) echo $conteudo['nome']; ?>" placeholder="nome">
			</div>
		</div>


		<div class="control-group">
			<label class="control-label" for="email">email</label>
			<div class="controls">
				<input id="usuarioEmail" class="email text" type="text" name="email" value="<?php if (isset($conteudo['email'])) echo $conteudo['email']; ?>" placeholder="email">
			</div>
		</div>


		<div class="control-group">
			<label class="control-label" for="senha">senha</label>
			<div class="controls">
				<input id="usuarioSenha" class="senha password" type="password" name="senha" value="" placeholder="senha">
			</div>
		</div>


		<div class="control-group">
			<label class="control-label" for="tipo">tipo</label>
			<div class="controls">
				<select id="usuarioTipo" class="select tipo" name="tipo">
					<option value="0"<?php if ($conteudo['tipo'] == '0') echo ' selected'; ?>>leitor</option>
					<option value="1"<?php if ($conteudo['tipo'] == '1') echo ' selected'; ?>>autor</option>
					<option value="2"<?php if ($conteudo['tipo'] == '2') echo ' selected'; ?>>editor</option>
					<option value="3"<?php if ($conteudo['tipo'] == '3') echo ' selected'; ?>>administrador</option>
				</select>
			</div>
		</div>

		</div>

		<div class="span6">
<?php echo partial('blocos/form.acoes.tpl.php');?>


		</div>


		<div class="clearfix">&nbsp;</div>

		<div class="span12">

		</div>

	</form>
</section>

<?php echo partial('blocos/apagar.modal.tpl.php');?>

