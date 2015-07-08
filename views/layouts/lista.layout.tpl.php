<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CONTEUDO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo $l->gen('assets');?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $l->gen('assets');?>/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo $l->gen('assets');?>/css/folha.css" rel="stylesheet">

    <link href="<?php echo $l->gen('gwf');?>Source+Sans+Pro:900" rel="stylesheet" type="text/css">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
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

    <!-- Docs nav
    ================================================== -->
    <div class="row">



	<!--CHAMA OS TEMPLATES INTERNOS-->
		<?php echo $content; ?>



  </div>
    </div>




    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $l->gen('assets');?>/js/jquery.js"></script>
    <script src="<?php echo $l->gen('assets');?>/js/jquerymx.js"></script>
    <script src="<?php echo $l->gen('assets');?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $l->gen('assets');?>/jsCtrl/Ctrl.js"></script>
    <script src="<?php echo $l->gen('listaController');?>"></script>
	<script>

	$("#<?php echo $info['nome']; ?>").<?php echo $info['nome']; ?>_lista({
		elMsg : "#ajaxMsgs li:first a",
		componente : "<?php echo $info['nome']; ?>",
		apelido : "<?php echo $info['apelido']; ?>",
		ativarUrl : "<?php echo $l->gen('ativar'); ?>",
		apagarUrl : "<?php echo $l->gen('apagar'); ?>",
		desativarUrl : "<?php echo $l->gen('desativar'); ?>",
	});
			
			
	</script>

  </body>
</html>
