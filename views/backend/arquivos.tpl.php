

<!-- -->
<section id="arquivo">

<!-- -->
<div class="page-header">
<div class="row">
<div class="span5 offset2"><h1>Arquivo</h1></div>
<div class="span5"><p class="lead"></p></div>
</div>
</div>
<!-- -->
<form action="<?php echo $l->gen('salvar'); ?>" method="POST" class="form-horizontal">



<div class="span6">

<div class="control-group pt-br">
<label class="control-label" for="titulo">título</label>
<div class="controls">
<input id="fotoTitulo" class="titulo" type="text" name="titulo" value="<?php if (isset($conteudo['titulo'])) echo $conteudo['titulo']; ?>" placeholder="título">
</div>
</div>


</div>
<div class="span6">

					<?php echo partial('blocos/form.acoes.tpl.php');?>

</div>
</div>

</div>
</form>
</section>

<?php echo partial('blocos/apagar.modal.tpl.php');?>

