<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CONTEUDO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php $this->e($l->gen('gwf'));?>Source+Sans+Pro:900" rel="stylesheet" type="text/css">
    <link href="<?php $this->e($l->gen('assets'));?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php $this->e($l->gen('assets'));?>/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php $this->e($l->gen('assets'));?>/css/fuelux.min.css" rel="stylesheet">
    <link href="<?php $this->e($l->gen('assets'));?>/css/folha.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php $this->e($styles);?>

  </head>
  <?php
    if (isset($data['data.record'])) {
        $b = '<body id="body-' . $data['info.slug'] . '-' . $data['data.record'][$data['info.identifier']] . '">';
    } else {
        $b = '<body id="body">';
    }
    echo $b;
  ?>


	<?php $this->partial('blocks/menu.tpl.php');?>


  <div class="container">

    <div class="row">

	<!--CHAMA OS TEMPLATES INTERNOS-->
		<?php $this->e($content);?>

  </div>
    </div>

        <?php $this->e($scripts);?>

    <script src="<?php $this->e($l->gen('assets'));?>/js/jquery.js"></script>
    <script src="<?php $this->e($l->gen('assets'));?>/js/bootstrap.min.js"></script>
    <script src="<?php $this->e($l->gen('assets'));?>/js/fuelux.min.js"></script>
  </body>
</html>
