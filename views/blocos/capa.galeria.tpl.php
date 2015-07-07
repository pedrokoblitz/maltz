
			<label class="galeria">Fotos</label>

<?php
	foreach	($conteudo as $fotoCapa) {
?>

	<img width="" <?php echo 'class="foto-'.$fotoCapa['arquivoId'].'"'; ?> src="<?php echo $l->gen('media').'/'.$fotoCapa['nome'].'_tn.'.$fotoCapa['extensao'];?>" <?php if (isset($capaId) && $capaId == $fotoCapa['arquivoId']) { echo "class=\"galeriaSelecionado\"";}?>>
<?php } ?>
