<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">

		<title>Rony Maltz</title>

		<meta name="description" content="fotografo">
		<meta name="keywords" content="fotografia, etc, e tal">
		<meta name="author" content="Pedro Koblitz">
		<meta name="viewport" content="width=device-width">

		<link rel="stylesheet" href="<?php echo $l->gen('/public'); ?>/css/style.css">
	
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

	<body>

	<header class="center clearfix" id="navtop">

		<a href="<?php echo $l->gen('index.php'); ?>" class="logo fleft"><img src="<?php echo $l->gen('/public'); ?>/img/logo.png" alt="Rony Maltz"></a>

		<nav class="fright">
			<ul>
				<li><a href="<?php echo $l->gen('index.php'); ?>" class="pt-br">Início</a></li>
				<li><a href="<?php echo $l->gen('index.php'); ?>" class="en-us">Home</a></li>
				<li><a href="<?php echo $l->gen('index.php'); ?>" class="pt-br">Sobre</a></li>
				<li><a href="<?php echo $l->gen('index.php'); ?>" class="en-us">About</a></li>
			</ul>
			<ul>
				<li><a href="<?php echo $l->gen('index.php'); ?>" class="pt-br">Trabalho</a></li>
				<li><a href="<?php echo $l->gen('index.php'); ?>" class="en-us">Works</a></li>
				<li><a href="<?php echo $l->gen('index.php'); ?>" class="pt-br">Livros</a></li>
				<li><a href="<?php echo $l->gen('index.php'); ?>" class="en-us">Books</a></li>
			</ul>
			<ul>
				<li><a href="<?php echo $l->gen('index.php'); ?>">Blog</a></li>
				<li><a href="<?php echo $l->gen('index.php'); ?>" class="pt-br">Contato</a></li>
				<li><a href="<?php echo $l->gen('index.php'); ?>" class="en-us">Contact</a></li>
			</ul>
		</nav>

		</header>


	

		<footer class="center part clearfix">
				<ul class="social column3 mright">
					<!-- li><a href="#">RSS</a></li -->
					<li><a href="<?php echo $l->gen('index.php'); ?>">Facebook</a></li>
					<li><a href="<?php echo $l->gen('index.php'); ?>">Flickr</a></li>
				</ul>
	
			<div class="up column3 mright">
				<a href="#navtop" class="ir pt-br">Topo</a>
				<a href="#navtop" class="ir en-us">Go up</a>
			</div>
	
			<nav class="column3">
				&nbsp;
				<!--ul>
					<li><a href="<?php echo $l->gen('index.php'); ?>">Home</a></li>
					<li><a href="<?php echo $l->gen('index.php'); ?>">About</a></li>
					<li><a href="<?php echo $l->gen('index.php'); ?>">Works</a></li>
					<li><a href="<?php echo $l->gen('index.php'); ?>">Books</a></li>
					<li><a href="<?php echo $l->gen('index.php'); ?>">Blog</a></li>
					<li><a href="<?php echo $l->gen('index.php'); ?>">Contact</a></li>
				</ul-->
			</nav>
		</footer>



		<script src="<?php echo $l->gen('/public'); ?>/js/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-1.5.1.min.js"><\/script>')</script>
		<script src="<?php echo $l->gen('assets'); ?>/js/slides.min.jquery.js"></script>
		<script src="<?php echo $l->gen('/public'); ?>/js/scripts.js"></script>

		<!-- Prompt IE 6 users to install Chrome Frame. -->
		<!--[if lt IE 7 ]>
		  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->

		<!--[if (gte IE 6)&(lte IE 8)]>
		<script src="js/selectivizr.js"></script>
		<![endif]-->



	</body>
</html>
