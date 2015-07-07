<?php

/**
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Meu CMS ainda não tem nome
 *
 * @version    0.1 alpha
 */


/*
 * frontend
 * 
 * 
 */

// home page
echo 'teste';

dispatch('/', array('Site','capa'));

// cada pagina
dispatch('/pagina/:id', array('Site','mostrarPagina'));

// todas as projetos
dispatch('/projetos/:pg', array('Site','listarProjetos'));

// cada projeto
dispatch('/projeto/:id', array('Site','mostrarProjeto'));

// todas as projetos
dispatch('/zines/:pg', array('Site','listarZines'));

// cada projeto
dispatch('/zine/:id', array('Site','mostrarZine'));

// blog
dispatch('/blog', array('Site','blog'));

// contato
dispatch('/contato', array('Site','contatoForm'));

// enviar contato
dispatch_post('/contato/enviar', array('Site','enviarContato'));




/*
 *  Autenticação & permissão
 * 
 * 
 */

// autenticacao

// form de login
dispatch('/entrar', array('Sys','entrar'));

// fazer login
dispatch_post('/login', array('Sys','login'));

// sair
dispatch('/logout', array('Sys','logout'));

//modificarPermissao
dispatch('api/permissao/:id',array('Sys','modificarPermissao'));



/* 
 * Ações de upload e criação de galeria
 * 
 * 
 */

// BACKEND

// upload
dispatch_post('api/upload', array('Midia','upload'));

// criar galeria apos upload
dispatch('admin/galerias/fotos/criar', array('Midia','criarGaleriaFotos'));

/*
 * listas e formulários da 
 * área de administração
 * 
 * 
 */

// admin

// home do admin
dispatch('admin/', array('Sys','painel'));

// listar listar registros
dispatch('admin/upload', array('Midia','upload_form'));

// listar listar registros
dispatch('admin/galerias/listar/:pg/:chave/:ordem', array('Midia','listarGaleria'));

// mostrar registro
dispatch('admin/galerias/mostrar/:id', array('Midia','mostrarGaleria'));

// cria novo registro
dispatch('admin/galerias/novo', array('Midia','novaGaleria'));

// editar registro
dispatch('admin/galerias/editar/:id', array('Midia','editarGaleria'));

// apagar registro
dispatch('api/arquivos/apagar/:id', array('Midia','apagarArquivo'));


// listar listar registros
dispatch('admin/projetos/listar/:pg/:chave/:ordem', array('Conteudo','listarProjeto'));

// mostrar registro
dispatch('admin/projetos/mostrar/:id', array('Conteudo','mostrarProjeto'));

// cria novo registro
dispatch('admin/projetos/novo', array('Conteudo','novoProjeto'));

// editar registro
dispatch('admin/projetos/editar/:id', array('Conteudo','editarProjeto'));


// listar listar registros
dispatch('admin/paginas/listar/:pg/:chave/:ordem', array('Conteudo','listarPagina'));

// mostrar registro
dispatch('admin/paginas/mostrar/:id', array('Conteudo','mostrarPagina'));

// cria novo registro
dispatch('admin/paginas/novo', array('Conteudo','novaPagina'));

// editar registro
dispatch('admin/paginas/editar/:id', array('Conteudo','editarPagina'));


// listar listar registros
dispatch('admin/zines/listar/:pg/:chave/:ordem', array('Conteudo','listarZine'));

// mostrar registro
dispatch('admin/zines/mostrar/:id', array('Conteudo','mostrarZine'));

// cria novo registro
dispatch('admin/zines/novo', array('Conteudo','novoZine'));

// editar registro
dispatch('admin/zines/editar/:id', array('Conteudo','editarZine'));



/* 
 * Ações que não geram html como resposta
 * 
 * 
 */

// listar JSON
dispatch('/api/galeria/listar/:pg/:pp/:chave/:ordem', array('Api','listarGaleriaJson'));

// mostrar JSON
dispatch('/api/galeria/mostrar/:id', array('Api','mostrarGaleriaJson'));

// listar JSON
dispatch('/api/projeto/listar/:pg/:pp/:chave/:ordem', array('Api','listarProjetoJson'));

// mostrar JSON
dispatch('/api/zine/mostrar/:id', array('Api','mostrarZineJson'));

// listar JSON
dispatch('/api/zine/listar/:pg/:pp/:chave/:ordem', array('Api','listarZineJson'));

// mostrar JSON
dispatch('/api/zine/mostrar/:id', array('Api','mostrarZineJson'));

// listar JSON
dispatch('/api/pagina/listar/:pg/:pp/:chave/:ordem', array('Api','listarPaginaJson'));

// mostrar JSON
dispatch('/api/pagina/mostrar/:id', array('Api','mostrarPaginaJson'));

// listar JSON
dispatch('/api/post/listar/:pg/:pp/:chave/:ordem', array('Api','listarPostJson'));

// mostrar JSON
dispatch('/api/post/mostrar/:id', array('Api','mostrarPostJson'));



/* 
 * 
 * Ações genéricas para os ctrl's que não dependem de relacionamentos
 * entre múltiplas tabelas e não retornam html como resposta.
 * 
 * 
 */
 
// inserirFotoGaleria
dispatch('api/:modelo/inserircapa/:fid/:cid',array('Midia','assocFotoCapa'));

// apagarFotoComponente
dispatch('api/:modelo/apagarcapa/:cid',array('Midia','deleteFotoCapa'));

// ativar
dispatch('api/:modelo/ativar/:id', array('Api','ativar'));

// desativar
dispatch('api/:modelo/desativar/:id', array('Api','desativar'));

// apagar
dispatch('api/:modelo/apagar/:id', array('Api','apagar'));

// listar JSON
dispatch('/api/:modelo/listar/:pg/:pp/:chave/:ordem', array('Api','listarJson'));

// mostrar JSON
dispatch('/api/:modelo/mostrar/:id', array('Api','mostrarJson'));

// salvar registro
dispatch_post('api/:modelo/salvar/:id', array('Api','salvar'));

/* 
 * 
 * Ações de ctrl's que fazem relacionamentos
 * entre múltiplas tabelas e não geram html 
 * como resposta.
 * 
 * 
 */

// salvar registro
dispatch_post('api/galerias/salvar/:id', array('Midia','salvarGaleria'));

// salvar registro
dispatch_post('api/projetos/salvar/:id', array('Conteudo','salvarProjeto'));

// salvar registro
dispatch_post('api/paginas/salvar/:id', array('Conteudo','salvarPagina'));


/*
 * gerenciamento de galerias
 * ajax
 * 
 * 
 */

// atualizar doc de projeto
dispatch('api/docs/listar/:num',array('Midia','listarDocs'));

// atualizar doc de projeto
dispatch('api/projetos/doc/novo/:pid/:did',array('Midia','atualizarDoc'));

// atualizar galeria de paginas, projeto e zines
dispatch('api/:modelo/galeria/nova/:pid/:gid',array('Midia','atualizarGaleria'));

// atualizar capa de paginas, projeto e zines
dispatch('api/:modelo/capa/nova/:pid/:fid',array('Midia','atualizarCapa'));

// seletor de capa de paginas, projeto e zines
dispatch('api/capa/seletor/:id',array('Midia','seletorCapa'));

// 
dispatch('api/galerias/apagarfoto/:fid/:gid',array('Midia','deleteFotoGaleria'));

// 
dispatch('api/galerias/inserirfoto/:fid/:gid',array('Midia','assocFotoGaleria'));


// 
dispatch_post('api/galerias/ordem/salvar', array('Midia','salvarOrdemGaleria'));



/* 
 * 
 * Ações genéricas para os ctrl's que não dependem de relacionamentos
 * entre múltiplas tabelas e retornam html como resposta.
 * 
 * 
 */


// listar listar registros
dispatch('admin/:modelo/listar/:pg/:chave/:ordem', array('Api','listar'));

// mostrar registro
dispatch('admin/:modelo/mostrar/:id', array('Api','mostrar'));

// cria novo registro
dispatch('admin/:modelo/novo', array('Api','novo'));

// editar registro
dispatch('admin/:modelo/editar/:id', array('Api','editar'));

?>
