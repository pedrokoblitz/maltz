<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<!-- Force latest IE rendering engine or ChromeFrame if installed -->
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
		<meta charset="utf-8">
		<title>Upload</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
		<!-- Bootstrap CSS Toolkit styles -->
		<link rel="stylesheet" href="<?php echo $l->gen('assets'); ?>/css/bootstrap.css">
		<!-- Bootstrap styles for responsive website layout, supporting different screen sizes -->
		<link rel="stylesheet" href="<?php echo $l->gen('assets'); ?>/css/bootstrap-responsive.css">
		<!-- Bootstrap CSS fixes for IE6 -->
		<!--[if lt IE 7]><link rel="stylesheet" href="<?php echo $l->gen('assets'); ?>/bootstrap-ie6.min.css"><![endif]-->
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<link rel="stylesheet" href="<?php echo $l->gen('assets');?>/css/folha.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo $l->gen('assets');?>/css/jquery.plupload.queue.css" type="text/css" media="screen" />

		<script src="<?php echo $l->gen('assets');?>/js/jquery.js"></script>
		<script src="<?php echo $l->gen('assets');?>/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>
		<script type="text/javascript" src="<?php echo $l->gen('assets');?>/jsUpload/plupload.js"></script>
		<script type="text/javascript" src="<?php echo $l->gen('assets');?>/jsUpload/plupload.gears.js"></script>
		<script type="text/javascript" src="<?php echo $l->gen('assets');?>/jsUpload/plupload.silverlight.js"></script>
		<script type="text/javascript" src="<?php echo $l->gen('assets');?>/jsUpload/plupload.flash.js"></script>
		<script type="text/javascript" src="<?php echo $l->gen('assets');?>/jsUpload/plupload.browserplus.js"></script>
		<script type="text/javascript" src="<?php echo $l->gen('assets');?>/jsUpload/plupload.html4.js"></script>
		<script type="text/javascript" src="<?php echo $l->gen('assets');?>/jsUpload/plupload.html5.js"></script>
		<script type="text/javascript" src="<?php echo $l->gen('assets');?>/jsUpload/jquery.plupload.queue/jquery.plupload.queue.js"></script>

		<!-- <script type="text/javascript"  src="http://getfirebug.com/releases/lite/1.2/firebug-lite-compressed.js"></script> -->
	</head>
	<body>

	<?php echo partial('blocos/menu.tpl.php'); ?>

		<div class="container">
		<br>
		<br>
		<br>
		<br>

		<div class="row">
			<div class="span6">

				<form method="post" action="dump.php">
					<div id="html5_uploader" style="width: 450px; height: 330px;">You browser doesn't support native upload. Try Firefox 3 or Safari 4.</div>
				</form>

			</div>

			<div class="span6">
				<br>
				<a href="<?php echo $l->gen('criarGaleria'); ?>" class="btn btn-primary">Criar nova galeria com essas imagens</a>
				<br>
				<br>
				<a href="<?php echo $l->gen('listarFotos'); ?>" class="btn btn-primary">Ver fotos</a>
			</div>

		</div>

	</div>

		<script type="text/javascript">
		$(function() {
			$("#html5_uploader").pluploadQueue({
				runtimes : 'html5',
				url : '/index.php/api/upload',
				max_file_size : '10mb',
				chunk_size : '10mb',
				unique_names : true,
			});
		});
		</script>

	</body> 
</html>
