<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>CONTEUDO</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- css -->
		<link href="<?php echo $l->gen('assets');?>/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo $l->gen('assets');?>/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="<?php echo $l->gen('assets');?>/css/folha.css" rel="stylesheet">
		<link href="<?php echo $l->gen('assets');?>/css/wysiwyg-color.css" rel="stylesheet">
		<link href="<?php echo $l->gen('assets');?>/css/bootstrap-wysihtml5.css" rel="stylesheet">
		<link href="<?php echo $l->gen('assets');?>/css/datepicker.css" rel="stylesheet">

		<link href="<?php echo $l->gen('gwf');?>Source+Sans+Pro:900" rel="stylesheet" type="text/css">

		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</head>

	<?php

	if (isset($conteudo[$info['identificador']])) {
		$b = '<body id="body-'.$info['apelido'].'-'.$conteudo[$info['identificador']].'">';
	} else {
		$b = '<body id="body">';
	}
	echo $b;
	?>


	<?php echo partial('blocos/menu.tpl.php');?>

	<div class="container">
		<div class="row">
			<!-- conteudo
			================================================== -->
			<?php echo $content; ?>
		</div>
	</div>

	<!-- javascript
	================================================== -->
		<script src="<?php echo $l->gen('assets');?>/js/wysihtml5-0.3.0.js"></script>
		<script src="<?php echo $l->gen('assets');?>/js/jquery.js"></script>
		<script src="<?php echo $l->gen('assets');?>/js/jquerymx.js"></script>
		<script src="<?php echo $l->gen('assets');?>/js/bootstrap.min.js"></script>
		<script src="<?php echo $l->gen('assets');?>/js/bootstrap-wysihtml5.js"></script>
		<script src="<?php echo $l->gen('assets');?>/js/bootstrap-datepicker.js"></script>

		<script src="<?php echo $l->gen('assets');?>/jsCtrl/Ctrl.js"></script>

		<script src="<?php echo $l->gen('formController');?>"></script>

		<script>
			$("#<?php echo $info['apelido']; ?>").<?php echo $info['nome']; ?>_form({
				elMsg : "#ajaxMsgs li:first a",
				componente : "<?php echo $info['nome']; ?>",
				apelido : "<?php echo $info['apelido']; ?>",
				componenteId : "<?php echo $conteudo[$info['identificador']];?>",
				seletorCapaUrl : "<?php echo $l->gen('seletorCapa'); ?>",
				selecCapaUrl : "<?php echo $l->gen('selecCapa'); ?>",
				apagaCapaUrl : "<?php echo $l->gen('apagaCapa'); ?>",
				selecGalUrl : "<?php echo $l->gen('selecGal'); ?>",
				ativarUrl : "<?php echo $l->gen('ativar'); ?>",
				desativarUrl : "<?php echo $l->gen('desativar'); ?>",
				salvarUrl : "<?php echo $l->gen('salvar'); ?>/<?php echo $conteudo[$info['identificador']]?>",
				
			});
		</script>

	</body>
</html>
