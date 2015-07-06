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


<body>



	
<!--CONTAINER-->
<div class="container">

<br/>
<br/>
<br/>
<br/>
<div class="row">
<?php //var_dump($_SESSION['user']); ?>
		<!--CHAMA OS TEMPLATES INTERNOS-->
<div class="span4">
<?php 
	if (isset($mensagem)) {
		?>
		<div class="alert">
			<?php echo $mensagem; ?>
		</div>
<?php
	}
?>
&nbsp;
</div>
<div class="span8">
<?php echo $content; ?>
</div>
</div>
</div>
	</body>
</html>
