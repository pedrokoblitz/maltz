
<div class=" center blog part clearfix">
  <header class="title">
    <p class="fleft">Blog</p>
  </header>
  <section class="columnthird content mright">
 
		<?php foreach ($conteudo as $dado) : 
		?>	
				<?php if (isset($dado['corpo'])) :?>

			<article class="post">
				<div class="entry">

					<p>
						<?php echo $dado['corpo'];?>
					</p>
					
					<?php if (isset($dado['tag'])) :?>
						<p><a href="http://ronymaltz.tumblr.com/tagged/<?php echo $dado['tag'];?>"><?php echo $dado['tag'];?></a><p>
					<?php endif;?>
					
					<?php if (isset($dado['link'])) :?>
						<a href="<?php echo $dado['link']?>" target="_blank" class="post-title">link</a>
					<?php endif;?>
					
				</div>
			</article>

				<?php endif; ?>
		<?php endforeach; ?>
   
  </section>
  <aside class="column4 sidebar">
    <div class="widget">
   		<div class="pt-br"><?php echo $lateral['corpo'];?></div>
		<div class="en-us"><?php echo $lateral['corpo_en'];?></div>
    </div>
  </aside>
</div>
