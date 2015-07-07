<div class="main center">
 <section class="part clearfix">
    <header class="title clearfix">
    <div class="column4 mright">
		<h5 class="pt-br"><?php echo $conteudo['titulo'];?></h5>
		<h5 class="en-us"><?php echo $conteudo['titulo_en'];?></h5>
		<div class="pt-br"><?php echo $conteudo['corpo'];?></div>
		<div class="en-us"><?php echo $conteudo['corpo_en'];?></div>
		<br>
		<img src="<?php echo $l->gen('/public/media/'.$conteudo['capaProjeto']['nome'].'_p.'.$conteudo['capaProjeto']['extensao']);?>" alt="" >

		<?php
			$doc = $conteudo['documentoProjeto'][0]; 
			if (isset($doc['nome']) && !empty($doc[nome])) :
		?>		
		<a href="<?php echo $l->gen('media').'/'.$doc['nome'] . "." . $doc['extensao']; ?>">download</a>
		<?php
			endif;		
		?>
    </div>
    <div id="slides" class="slider columnthird content clearfix">
      <div class="slides_container">

		<?php foreach ($conteudo['galeriaProjeto'] as $g) :?>

        <div class="slide">
          <figure>
			<a href="<?php echo $l->gen('media').'/'.$g['nome'].'.'.$g['extensao'];?>" target="_blank">
				<img src="<?php echo $l->gen('media').'/'.$g['nome'].'_m.'.$g['extensao'];?>" alt="" >
			</a>
          </figure>
        </div>

		<?php endforeach;?>

      </div>
    </div>
  </section>
</div>
