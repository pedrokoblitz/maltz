
<!-- -->
<section id="config">


<div class="page-header">
<div class="row">
<div class="span5 offset2"><h1>config</h1></div>
<div class="span5"><p class="lead"></p></div>
</div>
</div>
<!-- -->
<form action="<?php echo $l->gen('salvar'); ?>" method="POST" class="form-horizontal">


<div class="span6">

<div class="control-group">
<label class="control-label" for="chave">chave</label>
<div class="controls">
<input id="configChave" class="chave" type="text" name="chave" value="<?php if (isset($conteudo['chave'])) echo $conteudo['chave']; ?>" placeholder="chave"<?php if (isset($conteudo['chave'])) echo ' disabled'; ?>>
</div>
</div>



<div class="control-group">
<label class="control-label" for="valor">valor</label>
<div class="controls">
<input id="configValor" class="valor" type="text" name="valor" value="<?php if (isset($conteudo['valor'])) echo $conteudo['valor']; ?>" placeholder="valor">
</div>
</div>



</div>
<div class="span6">

<?php echo partial('blocos/form.acoes.tpl.php');?>

</div>
</div>
</form>
</section>
<?php echo partial('blocos/apagar.modal.tpl.php');?>

