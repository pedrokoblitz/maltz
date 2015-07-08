<?php

/**
 * carregar utils e bibliotecas de terceiros
 * 
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

require dirname(__FILE__).'/swift/swift_required.php';

require dirname(__FILE__).'/simplepie/autoloader.php';
require dirname(__FILE__).'/simplepie/idn/idna_convert.class.php';

require dirname(__FILE__).'/utils/carteiro.php';
require dirname(__FILE__).'/utils/curl.php';
require dirname(__FILE__).'/utils/log.php';
require dirname(__FILE__).'/utils/purificador.php';
require dirname(__FILE__).'/utils/paginacao.php';
require dirname(__FILE__).'/utils/porteiro.php';
require dirname(__FILE__).'/utils/simpleimage.php';
require dirname(__FILE__).'/utils/template.php';
require dirname(__FILE__).'/utils/upload.php';
require dirname(__FILE__).'/utils/url.php';

?>
