

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?php echo $l->gen('/');?>"></a>
            <div class="nav-collapse">
                <ul class="nav">

                    <li><a href="<?php echo $l->gen('index.php/admin/');?>">Painel</a></li>


			<li class="dropdown">
			  <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
			    Conteúdo
			    <b class="caret"></b>
			  </a>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				    <li><a href="<?php echo $l->gen('index.php/admin/paginas/listar/1');?>">Páginas</a></li>
				    <li><a href="<?php echo $l->gen('index.php/admin/projetos/listar/1');?>">Projetos</a></li>
				    <li><a href="<?php echo $l->gen('index.php/admin/zines/listar/1');?>">Zines</a></li>
				    <li><a href="<?php echo $l->gen('index.php/admin/blocos/listar/1');?>">Blocos</a></li>
			  </ul>
			</li>



			<li class="dropdown">
			  <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
			    Mídia
			    <b class="caret"></b>
			  </a>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				    <li><a href="<?php echo $l->gen('index.php/admin/galerias/listar/1');?>">Galerias</a></li>
				    <li><a href="<?php echo $l->gen('index.php/admin/arquivos/listar/1');?>">Arquivos</a></li>
				    <li><a href="<?php echo $l->gen('index.php/admin/upload');?>">Upload</a></li>
			  </ul>
			</li>


			<li class="dropdown">
			  <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
			    Config
			    <b class="caret"></b>
			  </a>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li><a href="<?php echo $l->gen('index.php/admin/usuarios/listar/1');?>">Usuários</a></li>
                    <li><a href="<?php echo $l->gen('index.php/admin/log/listar/1');?>">Logs</a></li>
                    <li><a href="<?php echo $l->gen('index.php/admin/config/listar/1');?>">Opções</a></li>

			  </ul>
			</li>

                    <li><a href="<?php echo $l->gen('/');?>" target="_blank">Capa</a></li>
                </ul>
	<div id="traduzir" class="btn btn-small btn-primary">traduzir</div>
	<ul id="ajaxMsgs" class="nav pull-right"><li><a href="#"><?php if (isset($mensagem)) {echo $mensagem;}?></a></li></ul>
            </div>
        </div>
    </div>
</div>

