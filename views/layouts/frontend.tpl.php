<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->partial('head.html.tpl.php'); ?>
    <link href="/public/assets/css/sheet.css" rel="stylesheet">
  </head>
  
  <body>
    <?php echo $content; ?>
		  
    <?php $this->partial('html.footer'); ?>        
    <script src="/public/assets/js/init.js"></script>
  </body>
</html>