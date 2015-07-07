<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?php echo option('site_titulo');?> - <?php echo option('site_subtitulo');?></title>

		<!-- Uncomment if you don't use the .htaccess -->
		<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
	
		<meta name="description" content="fotografo">
		<meta name="keywords" content="fotografia, etc, e tal">
		<meta name="author" content="Pedro Koblitz">
		<meta name="viewport" content="width=device-width">
	
		<link rel="stylesheet" href="<?php echo $l->gen('assets'); ?>/css/bootstrap.css">
		<link href="<?php echo $l->gen('assets');?>/css/bootstrap-responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo $l->gen('assets'); ?>/css/site.css">

		<link href="<?php echo $l->gen('gwf'); ?>Ubuntu+Mono:400,700,400italic,700italic" rel='stylesheet' type='text/css'>
		<link href="<?php echo $l->gen('gwf'); ?>Gafata:400" rel='stylesheet' type='text/css'>
	
		<!-- link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" -->
		<!-- link rel="shortcut icon" type="image/png" href="../../favicon.png" -->
	
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</head>

	<body>


		

				

<header class="center clearfix" id="navtop"> 

	<a href="<?php echo $l->gen('index.php/'); ?>" class="fleft"><img src="<?php echo $l->gen('assets');?>/logo.png" style="margin:50px 0;"></a>
	<?php if (isset($_SESSION['mensagem'])) {?>
		<p class="fleft"><?php echo $_SESSION['mensagem']; ?></p>
	<?php }?>

	<div id="teste">eng/port</div>

  <nav class="fright">
			<ul>
				<li><a href="<?php echo $l->gen('index.php/projetos/1'); ?>" class="pt-br">Projetos</a></li>
				<li><a href="<?php echo $l->gen('index.php/projetos/1'); ?>" class="en-us">Works</a></li>
			</ul>
			<ul>
				<li><a href="<?php echo $l->gen('index.php/zines/1'); ?>" class="pt-br">Livros</a></li>
				<li><a href="<?php echo $l->gen('index.php/zines/1'); ?>" class="en-us">Books</a></li>
			</ul>
			<ul>
				<li><a href="<?php echo $l->gen('index.php/blog'); ?>">Blog</a></li>
				<!--li><a href="<?php echo $l->gen('index.php/contato'); ?>" class="pt-br">Contato</a></li>
				<li><a href="<?php echo $l->gen('index.php/contato'); ?>" class="en-us">Contact</a></li-->
			</ul>
			<ul>
				<li><a href="<?php echo $l->gen('index.php/contato'); ?>" class="pt-br">Bio/Contato</a></li>
				<li><a href="<?php echo $l->gen('index.php/contato'); ?>" class="en-us">Bio/Contact</a></li>
			</ul>
</nav>
</header>

		<!---->
		<?php echo $content; // CHAMA OS TEMPLATES INTERNOS ?>

<footer class="center part clearfix">
  <ul class="social column3 mright">
			<!-- li><a href="#">RSS</a></li -->
			<li><a href="<?php echo option('facebook_url'); ?>" target="_blank">Facebook</a></li>
			<li><a href="<?php echo option('flickr_url'); ?>" target="_blank">Flickr</a></li>
			<li><a href="<?php echo option('tumblr_url'); ?>" target="_blank">Tumblr</a></li>
  </ul>
  <div class="up column3 mright"> <a href="#navtop" class="ir">Top</a> </div>
  <nav class="column3">
    <ul>
				<li><a href="<?php echo $l->gen('index.php/projetos/1'); ?>" class="pt-br">Projetos</a></li>
				<li><a href="<?php echo $l->gen('index.php/projetos/1'); ?>" class="en-us">Works</a></li>
				<li><a href="<?php echo $l->gen('index.php/zines/1'); ?>" class="pt-br">Livros</a></li>
				<li><a href="<?php echo $l->gen('index.php/zines/1'); ?>" class="en-us">Books</a></li>
				<li><a href="<?php echo $l->gen('index.php/blog'); ?>">Blog</a></li>
				<li><a href="<?php echo $l->gen('index.php/contato'); ?>" class="pt-br">Bio/Contato</a></li>
				<li><a href="<?php echo $l->gen('index.php/contato'); ?>" class="en-us">Bio/Contact</a></li>
    </ul>
  </nav>
</footer>


		<script src="<?php echo $l->gen('assets'); ?>/js/jquery.js"></script>
		<script src="<?php echo $l->gen('assets'); ?>/js/slides.min.jquery.js"></script>
		
		<!-- Prompt IE 6 users to install Chrome Frame. -->
		<!--[if lt IE 7 ]>
		  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		<script src="<?php echo $l->gen('assets'); ?>/js/bootstrap.min.js"></script>

		<!--[if (gte IE 6)&(lte IE 8)]>
		<script src="<?php echo $l->gen('assets'); ?>/js/selectivizr.js"></script>
		<![endif]-->

		<script>
			function createCookie(name,value,days) {
				if (days) {
					var date = new Date();
					date.setTime(date.getTime()+(days*24*60*60*1000));
					var expires = "; expires="+date.toGMTString();
				}
				else var expires = "";
				document.cookie = name+"="+value+expires+"; path=/";
			}

			function readCookie(name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for(var i=0;i < ca.length;i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1,c.length);
					if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
				}
				return null;
			}

			function eraseCookie(name) {
				createCookie(name,"",-1);
			}

			$(document).ready(function(){


// Slide  	
	if (jQuery().slides) {
	
	    $("#slides").slides({
	      preload: true,
	      preloadImage: '/assets/img/loading.gif',
	      generateNextPrev: true,
	      pagination: false,
	      generatePagination: false,
	      play: 6500,
	      slideSpeed:'slow'
	    });
    
    };


	// OPACITY
				$(".zoom").css({"opacity":0});
				$(".zoom").hover(
					function(){$(this).stop().animate({ "opacity": 0.9 }, 'slow');},
					function(){$(this).stop().animate({ "opacity": 0 }, 'fast');
				});

			// PORTFOLIO sorting	
				// NAV 
				$('.work_nav a').click(function(){
					$(this).addClass("buttonactive").siblings().removeClass("buttonactive");
					console.log('teste');
				});
				
				
				$("a.fotoCat").click(function() {
				  $(".work").not(".foto").stop().fadeTo("normal",0.1);
				  $(".foto").stop().fadeTo("normal",1);
				});

				
				
				$(".textoCat").click(function() {
				  $(".work").not(".texto").stop().fadeTo("normal",0.1);
				  $(".texto").stop().fadeTo("normal",1);
				});

				
				
				$(".videoCat").click(function() {
				  $(".work").not(".video").stop().fadeTo("normal",0.1);
				  $(".video").stop().fadeTo("normal",1);
				});

				
				
				$(".multimidiaCat").click(function() {
				  $(".work").not(".multimidia").stop().fadeTo("normal",0.1);
				  $(".multimidia").stop().fadeTo("normal",1);
				});

				
				
				$(".instalacaoCat").click(function() {
				  $(".work").not(".instalacao").stop().fadeTo("normal",0.1);
				  $(".instalacao").stop().fadeTo("normal",1);
				});

				
				
				$(".exposicaoCat").click(function() {
				  $(".work").not(".exposicao").stop().fadeTo("normal",0.1);
				  $(".exposicao").stop().fadeTo("normal",1);
				});

				
				
				$(".livroCat").click(function() {
				  $(".work").not(".livro").stop().fadeTo("normal",0.1);
				  $(".livro").stop().fadeTo("normal",1);
				});

				
				
				$(".reportagemCat").click(function() {
					console.log('teste');
				  $(".work").not(".reportagem").stop().fadeTo("normal",0.1);
				  $(".reportagem").stop().fadeTo("normal",1);
				});

				
				
				$(".publicacaoCat").click(function() {
				  $(".work").not(".publicacao").stop().fadeTo("normal",0.1);
				  $(".publicacao").stop().fadeTo("normal",1);
				});

				
				
				$(".semcategoriaCat").click(function() {
				  $(".work").not(".semcategoria").stop().fadeTo("normal",0.1);
				  $(".semcategoria").stop().fadeTo("normal",1);
				});

				$(".all").click(function() {
				  $(".work").stop().fadeTo("normal",1);
				});
				
				var lang = readCookie('lang');

				switch(lang)
				{
				case 'pt-br':
					var alvo = 'en-us';
					$('.en-us').hide();
					$('.pt-br').show();
				  break;
				default:
					lang = 'en-us';
					var alvo = 'pt-br';
					$('.pt-br').hide();
					$('.en-us').show();
				}

				$('#teste').click(function(){
					$('.'+lang).toggle();
					$('.'+alvo).toggle();
					createCookie('lang',alvo,1);
				});

			});
		</script>



	</body>
</html>
