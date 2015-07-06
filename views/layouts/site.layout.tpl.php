<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?php $this->e('site_title');?> - <?php $this->e('site_subtitle');?></title>

		<!-- Uncomment if you don't use the .htaccess -->
		<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->

		<meta name="description" content="photografo">
		<meta name="keywords" content="photografia, etc, e tal">
		<meta name="author" content="Pedro Koblitz">
		<meta name="viewport" content="width=device-width">

		<link rel="stylesheet" href="<?php $this->e($l->gen('assets'));?>/css/bootstrap.css">
		<link href="<?php $this->e($l->gen('assets'));?>/css/bootstrap-responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php $this->e($l->gen('assets'));?>/css/site.css">

		<link href="<?php $this->e('gwf');?>Ubuntu+Mono:400,700,400italic,700italic" rel='stylesheet' type='text/css'>
		<link href="<?php $this->e('gwf');?>Gafata:400" rel='stylesheet' type='text/css'>

		<!-- link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" -->
		<!-- link rel="shortcut icon" type="image/png" href="../../favicon.png" -->

		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</head>

	<body>

<header class="center clearfix" id="navtop">

	<h1><a href="<?php $this->e('/');?>" class="logo fleft"><?php $this->e('site_title(');?></a></h1>

		<p class="fleft"><?php $this->e('message');?></p>

	<div id="teste">eng/port</div>

  <nav class="fright">
			<ul>
				<li><a href="<?php $this->e('/contents/1');?>" class="pt-br">Contents</a></li>
				<li><a href="<?php $this->e('/contents/1');?>" class="en-us">Works</a></li>
			</ul>
			<ul>
				<li><a href="<?php $this->e('/books/1');?>" class="pt-br">Livros</a></li>
				<li><a href="<?php $this->e('/books/1');?>" class="en-us">Books</a></li>
			</ul>
			<ul>
				<li><a href="<?php $this->e('/blog');?>">Blog</a></li>
				<!--li><a href="<?php $this->e('/contact');?>" class="pt-br">Contact</a></li>
				<li><a href="<?php $this->e('/contact');?>" class="en-us">Contact</a></li-->
			</ul>
			<ul>
				<li><a href="<?php $this->e('/contact');?>" class="pt-br">Bio/Contact</a></li>
				<li><a href="<?php $this->e('/contact');?>" class="en-us">Bio/Contact</a></li>
			</ul>
</nav>
</header>

		<!---->
		<?php if (isset($content)) {$this->e($content);} // CHAMA OS TEMPLATES INTERNOS ?>

<footer class="center part clearfix">
  <ul class="social column3 mright">
			<!-- li><a href="#">RSS</a></li -->
			<li><a href="<?php $this->e('facebook_url');?>" target="_blank">Facebook</a></li>
			<li><a href="<?php $this->e('flickr_url');?>" target="_blank">Flickr</a></li>
			<li><a href="<?php $this->e('tumblr_url');?>" target="_blank">Tumblr</a></li>
  </ul>
  <div class="up column3 mright"> <a href="#navtop" class="ir">Top</a> </div>
  <nav class="column3">
    <ul>
				<li><a href="<?php $this->e('/contents/1');?>" class="pt-br">Contents</a></li>
				<li><a href="<?php $this->e('/contents/1');?>" class="en-us">Works</a></li>
				<li><a href="<?php $this->e('/books/1');?>" class="pt-br">Livros</a></li>
				<li><a href="<?php $this->e('/books/1');?>" class="en-us">Books</a></li>
				<li><a href="<?php $this->e('/blog');?>">Blog</a></li>
				<li><a href="<?php $this->e('/contact');?>" class="pt-br">Bio/Contact</a></li>
				<li><a href="<?php $this->e('/contact');?>" class="en-us">Bio/Contact</a></li>
    </ul>
  </nav>
</footer>


		<script src="<?php $this->e($l->gen('assets'));?>/js/jquery.js"></script>
		<script src="<?php $this->e($l->gen('assets'));?>/js/slides.min.jquery.js"></script>

		<!-- Prompt IE 6 users to install Chrome Frame. -->
		<!--[if lt IE 7 ]>
		  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		<script src="<?php $this->e($l->gen('assets'));?>/js/bootstrap.min.js"></script>

		<!--[if (gte IE 6)&(lte IE 8)]>
		<script src="<?php $this->e($l->gen('assets'));?>/js/selectivizr.js"></script>
		<![endif]-->

		<script>
			var createCookie = function (name,value,days) {
				if (days) {
					var date = new Date();
					date.setTime(date.getTime()+(days*24*60*60*1000));
					var expires = "; expires="+date.toGMTString();
				}
				else var expires = "";
				document.cookie = name+"="+value+expires+"; path=/";
			}

			var readCookie = function (name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for(var i=0;i < ca.length;i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1,c.length);
					if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
				}
				return null;
			}

			var eraseCookie = function (name) {
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
	      generatePagetion: false,
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
					console.log('teste(');
				});


				$("a.photoCat").click(function() {
				  $(".work").not(".photo").stop().fadeTo("normal",0.1);
				  $(".photo").stop().fadeTo("normal",1);
				});



				$(".textoCat").click(function() {
				  $(".work").not(".texto").stop().fadeTo("normal",0.1);
				  $(".texto").stop().fadeTo("normal",1);
				});



				$(".videoCat").click(function() {
				  $(".work").not(".video").stop().fadeTo("normal",0.1);
				  $(".video").stop().fadeTo("normal",1);
				});



				$(".multimediaCat").click(function() {
				  $(".work").not(".multimedia").stop().fadeTo("normal",0.1);
				  $(".multimedia").stop().fadeTo("normal",1);
				});



				$(".instalactionCat").click(function() {
				  $(".work").not(".instalaction").stop().fadeTo("normal",0.1);
				  $(".instalaction").stop().fadeTo("normal",1);
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
					console.log('teste(');
				  $(".work").not(".reportagem").stop().fadeTo("normal",0.1);
				  $(".reportagem").stop().fadeTo("normal",1);
				});



				$(".publicactionCat").click(function() {
				  $(".work").not(".publicaction").stop().fadeTo("normal",0.1);
				  $(".publicaction").stop().fadeTo("normal",1);
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

				$('#teste(').click(function(){
					$('.'+lang).toggle();
					$('.'+alvo).toggle();
					createCookie('lang',alvo,1);
				});

			});
		</script>
	</body>
</html>
