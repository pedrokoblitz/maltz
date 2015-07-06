<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CONTEUDO</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="<?php $this->e($l->gen('assets'));?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php $this->e($l->gen('assets'));?>/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php $this->e($l->gen('assets'));?>/css/folha.css" rel="stylesheet">
<link href="<?php $this->e($l->gen('gwf'));?>Source+Sans+Pro:900" rel="stylesheet" type="text/css">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body id="body">


<div class="container">

<div class="row">
<div class="span6">
    <form action="<?php $this->e('/api/login');?>" method="POST" class="form-search">
	<legend>Entrar</legend>
	<input type="text" class="input-small" placeholder="username" name="username">
	<input type="password" class="input-small" placeholder="password" name="password">
    <label for="remember">
    <input type="checkbox" name="remember"> lembre-se de miiiiim!</label>
	<button type="submit" class="btn">Entrar</button>
      </form>
</div>
</div>

</div>


</body>
</html>
