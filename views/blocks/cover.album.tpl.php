
			<label class="album">Photos</label>

<?php
foreach ($data[''] as $photoCover) {
    ?>

	<img width="" <?php $this->e('class="photo-' . $photoCover['file_id'] . '"');?> src="<?php $this->e($l->gen('media') . '/' . $photoCover['name'] . '_tn.' . $photoCover['extension']);?>" <?php if (isset($cover_id) && $cover_id == $photoCover['file_id']) {
        $this->e("class=\"selectedAlbum\"");
}?>>
<?php
}?>
