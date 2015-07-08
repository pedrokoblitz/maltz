<div class="works center part clearfix">
  <header class="title">
	<p class="fleft pt-br">Projetos</p>
	<p class="fleft en-us">Projects</p>
  </header>
  <aside class="column4 mright">
	<p class="mbottom pt-br"><?php echo $lateral['corpo'];?></p>
	<p class="mbottom en-us"><?php echo $lateral['corpo_en'];?></p>
	
	<a class="all en-us more">all</a><br class="en-us">
	<a class="all pt-br more">todos</a><br class="pt-br">
	<?php
     $tipos = option('tipos');
     foreach ($tipos as $tipo) {
			echo '<a class="'.$tipo[0].'Cat pt-br more">'.$tipo[1][0].'</a><br class="pt-br">';
			echo '<a class="'.$tipo[0].'Cat en-us more">'.$tipo[1][1].'</a><br class="en-us">';
	 }
    ?>

  </aside>
  
  <section class="columnthird content clearfix">

	<?php foreach($conteudo as $dado) : ?>	

	<figure class="work  <?php echo $dado['tipo'];?>">
      <a href="<?php echo $l->gen('index.php/projeto/'.$dado['projetoId']);?>" >
	    <img src="<?php echo $l->gen('/public/media/'.$dado['capaProjeto']['nome'].'_p.'.$dado['capaProjeto']['extensao']);?>" alt="" >
	    <span class="zoom"></span>
	  </a>

      <figcaption> 
		<a href="<?php echo $l->gen('index.php/projeto/'.$dado['projetoId']);?>#seta-ant" class="arrow pt-br">
			<?php echo $dado['titulo'];?>
		</a>
		<p class="pt-br">
			<?php echo $dado['descricao'];?>
		</p>
		<p class="pt-br">
			<?php echo $dado['corpo'];?>
		</p>
		<a href="<?php echo $l->gen('index.php/projeto/'.$dado['projetoId']);?>#seta-ant" class="arrow en-us">
			<?php echo $dado['titulo_en'];?>
		</a>
		<p class="en-us">
			<?php echo $dado['descricao_en'];?>
		</p>
		<p class="en-us">
			<?php echo $dado['corpo_en'];?>
		</p>
      </figcaption>
    </figure>

	<?php endforeach; ?>

  </section>

</div>
