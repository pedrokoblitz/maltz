-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: maltz
-- ------------------------------------------------------
-- Server version	5.5.31-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blocos`
--

DROP TABLE IF EXISTS `blocos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocos` (
  `blocoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `corpo` text COLLATE utf8_unicode_ci,
  `corpo_en` text COLLATE utf8_unicode_ci,
  `area` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`blocoId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocos`
--

LOCK TABLES `blocos` WRITE;
/*!40000 ALTER TABLE `blocos` DISABLE KEYS */;
INSERT INTO `blocos` VALUES (16,NULL,'Blog','Blog','bla bla bla bla','nsfknakÃ§fnalfnals<br>','blog',1,'2013-05-22 21:10:55'),(17,NULL,'Projetos','Works','bla bla bla bla','Bla bla bla bla','projeto',1,'2013-05-22 21:20:18'),(18,NULL,'Contato','Contacts','<span>telefone aqui...&nbsp;<br>00 77 66 55 33<br></span><br>','bla bla bla','contato',1,'2013-05-22 21:38:05'),(19,NULL,'Livros','Books','testando....','testing....','zine',1,'2013-05-22 21:49:44');
/*!40000 ALTER TABLE `blocos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `configId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chave` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`configId`),
  UNIQUE KEY `chave` (`chave`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'por_pagina','12',1,'2012-01-18 15:50:19'),(3,'midia_dir','/var/www/maltz/public/media/',1,'2012-01-18 15:50:19'),(9,'capa_blog_quant','3',1,'2012-12-24 16:41:47'),(10,'capa_projetos_quant','9',1,'2012-12-24 16:42:15'),(11,'painel_log_quant','15',1,'2012-12-24 18:02:05'),(12,'painel_lista_quant','5',1,'2012-12-24 18:02:56'),(13,'tumblr_rss_url','http://ronymaltz.tumblr.com/rss',1,'2013-05-09 15:29:54'),(14,'email_contato','r_maltz@yahoo.com',1,'2013-05-20 15:52:46'),(15,'facebook_url','http://facebook.com/rony.maltz',1,'2013-05-22 22:00:09'),(16,'flickr_url','http://flickr.com/photos/ronymaltz',1,'2013-05-22 22:00:49'),(17,'tumblr_url','http://ronymaltz.tumblr.com',1,'2013-05-22 22:01:25');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arquivos`
--

DROP TABLE IF EXISTS `arquivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arquivos` (
  `arquivoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extensao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`arquivoId`)
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arquivos`
--

LOCK TABLES `arquivos` WRITE;
/*!40000 ALTER TABLE `arquivos` DISABLE KEYS */;
/*!40000 ALTER TABLE `arquivos` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `fotos_galerias`
--

DROP TABLE IF EXISTS `fotos_galerias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotos_galerias` (
  `fotoId` int(10) unsigned NOT NULL,
  `galeriaId` int(10) unsigned NOT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `fotoId` (`fotoId`),
  KEY `galeriaId` (`galeriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotos_galerias`
--

LOCK TABLES `fotos_galerias` WRITE;
/*!40000 ALTER TABLE `fotos_galerias` DISABLE KEYS */;
/*!40000 ALTER TABLE `fotos_galerias` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `documentos_pastas`
--

DROP TABLE IF EXISTS `documentos_pastas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos_pastas` (
  `documentoId` int(10) unsigned NOT NULL,
  `pastaId` int(10) unsigned NOT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `documentoId` (`documentoId`),
  KEY `pastaId` (`pastaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos_pastas`
--

LOCK TABLES `documentos_pastas` WRITE;
/*!40000 ALTER TABLE `documentos_pastas` DISABLE KEYS */;
/*!40000 ALTER TABLE `documentos_pastas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galerias`
--

DROP TABLE IF EXISTS `galerias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galerias` (
  `galeriaId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`galeriaId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galerias`
--

LOCK TABLES `galerias` WRITE;
/*!40000 ALTER TABLE `galerias` DISABLE KEYS */;
/*!40000 ALTER TABLE `galerias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pastas`
--

DROP TABLE IF EXISTS `pastas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pastas` (
  `pastaId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pastaId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galerias`
--

LOCK TABLES `pastas` WRITE;
/*!40000 ALTER TABLE `pastas` DISABLE KEYS */;
/*!40000 ALTER TABLE `pastas` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `arquivos`
--

DROP TABLE IF EXISTS `arquivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arquivos` (
  `arquivoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extensao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`arquivoId`)
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arquivos`
--

LOCK TABLES `arquivos` WRITE;
/*!40000 ALTER TABLE `arquivos` DISABLE KEYS */;
/*!40000 ALTER TABLE `arquivos` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `arquivos_pastas`
--

DROP TABLE IF EXISTS `arquivos_pastas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arquivos_pastas` (
  `arquivoId` int(10) unsigned NOT NULL,
  `pastaId` int(10) unsigned NOT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `arquivoId` (`arquivoId`),
  KEY `pastaId` (`pastaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arquivos_pastas`
--

LOCK TABLES `arquivos_pastas` WRITE;
/*!40000 ALTER TABLE `arquivos_pastas` DISABLE KEYS */;
/*!40000 ALTER TABLE `arquivos_pastas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pastas`
--

DROP TABLE IF EXISTS `pastas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pastas` (
  `pastaId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pastaId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pastas`
--

LOCK TABLES `pastas` WRITE;
/*!40000 ALTER TABLE `pastas` DISABLE KEYS */;
/*!40000 ALTER TABLE `pastas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `logId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuarioId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `componente` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `objetoId` int(10) unsigned DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`logId`)
) ENGINE=InnoDB AUTO_INCREMENT=897 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paginas`
--

DROP TABLE IF EXISTS `paginas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paginas` (
  `paginaId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `corpo` text COLLATE utf8_unicode_ci,
  `corpo_en` text COLLATE utf8_unicode_ci,
  `capaId` int(10) unsigned DEFAULT NULL,
  `galeriaId` int(10) unsigned DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`paginaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paginas`
--

LOCK TABLES `paginas` WRITE;
/*!40000 ALTER TABLE `paginas` DISABLE KEYS */;
/*!40000 ALTER TABLE `paginas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projetos`
--

DROP TABLE IF EXISTS `projetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projetos` (
  `projetoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `corpo` text COLLATE utf8_unicode_ci,
  `corpo_en` text COLLATE utf8_unicode_ci,
  `capaId` int(10) unsigned DEFAULT NULL,
  `galeriaId` int(10) unsigned DEFAULT NULL,
  `docId` int(10) unsigned DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`projetoId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projetos`
--

LOCK TABLES `projetos` WRITE;
/*!40000 ALTER TABLE `projetos` DISABLE KEYS */;
/*!40000 ALTER TABLE `projetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuarioId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cnpj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complemento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` int(10) unsigned NOT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usuarioId`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (usuarioId,username,nome,email,senha,tipo,ativo,criado) VALUES (1,'admin','Pedro Koblitz','pedrokoblitz@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',3,1,'2012-01-18 15:50:19'),(2,'rony','Rony Maltz','r_maltz@yahoo.com','81dc9bdb52d04dc20036dbd8313ed055',3,1,'2012-01-12 13:50:19');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zines`
--

DROP TABLE IF EXISTS `zines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zines` (
  `zineId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `corpo` text COLLATE utf8_unicode_ci,
  `corpo_en` text COLLATE utf8_unicode_ci,
  `capaId` int(10) unsigned DEFAULT NULL,
  `galeriaId` int(10) unsigned DEFAULT NULL,
  `pdfUrl` int(10) unsigned DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`zineId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zines`
--

LOCK TABLES `zines` WRITE;
/*!40000 ALTER TABLE `zines` DISABLE KEYS */;
/*!40000 ALTER TABLE `zines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens`
--

DROP TABLE IF EXISTS `itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens` (
  `itemId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `produtoId` int(10) unsigned NOT NULL,
  `pedidoId` int(10) unsigned NOT NULL,
  `quantidade` int(10) unsigned NOT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`itemId`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens`
--

LOCK TABLES `itens` WRITE;
/*!40000 ALTER TABLE `itens` DISABLE KEYS */;
/*!40000 ALTER TABLE `itens` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `produtoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuarioId` int(10) unsigned NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unidade` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoria` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8_unicode_ci,
  `peso` float unsigned NOT NULL,
  `preco` float unsigned NOT NULL,
  `estoque` int(10) unsigned DEFAULT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `destaque` tinyint(1) unsigned DEFAULT NULL,
  `especial` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`produtoId`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `pedidoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuarioId` int(10) unsigned NOT NULL,
  `preco` float unsigned NOT NULL,
  `frete` float unsigned NOT NULL,
  `ativo` tinyint(1) unsigned DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pedidoId`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;





/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-05-23  8:44:32


