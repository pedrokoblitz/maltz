

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?php $this->e('/');?>"></a>
            <div class="nav-collapse">
                <ul class="nav">

                    <li><a href="<?php $this->e($data['data.menu']['admin_home']);?>">Panel</a></li>


			<li class="dropdown">
			  <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
			    Conteúdo
			    <b class="caret"></b>
			  </a>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				    <li><a href="<?php $this->e($data['data.menu']['admin_page_index']);?>">Páginas</a></li>
				    <li><a href="<?php $this->e($data['data.menu']['admin_content_index']);?>">Contents</a></li>
				    <li><a href="<?php $this->e($data['data.menu']['admin_book_index']);?>">Books</a></li>
				    <li><a href="<?php $this->e($data['data.menu']['admin_block_index']);?>">Blocks</a></li>
			  </ul>
			</li>



			<li class="dropdown">
			  <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
			    Mídia
			    <b class="caret"></b>
			  </a>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				    <li><a href="<?php $this->e($data['data.menu']['admin_album_index']);?>">Albums</a></li>
				    <li><a href="<?php $this->e($data['data.menu']['admin_file_index']);?>">Files</a></li>
				    <li><a href="<?php $this->e($data['data.menu']['admin_upload']);?>">Upload</a></li>
			  </ul>
			</li>


			<li class="dropdown">
			  <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
			    Config
			    <b class="caret"></b>
			  </a>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li><a href="<?php $this->e($data['data.menu']['admin_user_index']);?>">Usuários</a></li>
                    <li><a href="<?php $this->e($data['data.menu']['admin_log_index']);?>">Logs</a></li>
                    <li><a href="<?php $this->e($data['data.menu']['admin_config_index']);?>">Opções</a></li>

			  </ul>
			</li>

                    <li><a href="<?php $this->e($data['data.menu']['site_home']);?>" target="_blank">Capa</a></li>
                </ul>
	<div id="traduzir" class="btn btn-small btn-primary">traduzir</div>
	<ul id="ajaxMsgs" class="nav pull-right"><li><a href="#"><?php if (isset($messagem)) { $this->e($msensagem); }?></a></li></ul>
            </div>
        </div>
    </div>
</div>

