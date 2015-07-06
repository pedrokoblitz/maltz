
<div class="contact center part clearfix">
  <header class="title">
	<p class="fleft en-us">Contact</p>
	<p class="fleft pt-br">Contact</p>
  </header>
  <aside class="column4 mright">

	<div class="pt-br"><?php if (isset($sidebar)) {$this->e($data['sidebar']['body']);}?></div>
	<div class="en-us"><?php if (isset($sidebar)) {$this->e($data['sidebar']['body_en']);}?></div>

  </aside>
  <section class="columnthird content">
	<form id="contact_form" class="contact_form" action="<?php $this->e($l->gen('/contact/send'));?>" method="post" name="contact_form">

		<ul class="contact_ie9">
		<li>
			<label for="name" class="pt-br">Name</label>
			<label for="name" class="en-us">Name</label>
			<input type="text" name="name" id="name" required class="required" >
		</li>
		<li>
			<label for="email">Email:</label>
			<input type="email" name="email" id="email" required class="required email">
		</li>
		<li>
			<label for="message" class="pt-br">Mensagem:</label>
			<label for="message" class="en-us">Message:</label>
			<textarea name="message" id="message" cols="40" rows="6" required  class="required" ></textarea>
		</li>
		<li>
			<button type="submit" id="submit" class="button fright pt-br">Enviar</button>
			<button type="submit" id="submit" class="button fright en-us">Send</button>
		</li>
		</ul>

	</form>

  </section>
</div>





