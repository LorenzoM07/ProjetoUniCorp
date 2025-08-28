-- Projeto UniCorp V5
--
-- Database: projetounicorpv5aula
--
-- Observacao: alterar nome do Banco de Dados
-- ------------------------------------------------------

-- Criar Banco de Dados --
CREATE DATABASE projetounicorpv5aula;
--
USE projetounicorpv5aula;
--
-- Criar a Estrutura da Tabela `certificados`
--
DROP TABLE IF EXISTS `certificados`;
--
CREATE TABLE `certificados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `data_emissao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
--
-- Inserir Dados na Tabela `certificados`
--
LOCK TABLES `certificados` WRITE;
--
INSERT INTO `certificados` VALUES (1,2,1,'2025-05-08 00:07:03'),(2,2,1,'2025-05-08 00:23:00'),(3,2,1,'2025-05-08 00:24:56'),(4,2,1,'2025-05-08 00:39:13'),(5,2,1,'2025-05-08 00:48:12'),(6,2,1,'2025-05-08 00:58:45'),(7,2,1,'2025-05-08 00:59:12'),(8,2,1,'2025-05-08 00:59:34'),(9,2,1,'2025-05-08 00:59:51'),(10,2,1,'2025-05-08 01:16:32'),(11,2,1,'2025-05-08 01:16:41'),(12,2,1,'2025-05-08 01:21:48'),(13,2,1,'2025-05-08 23:08:30'),(14,2,1,'2025-05-10 23:15:34'),(15,2,1,'2025-05-10 23:20:06');
--
UNLOCK TABLES;




--
-- Criar a estrutura da Tabela `cursos`
--
DROP TABLE IF EXISTS `cursos`;
--
CREATE TABLE `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `status` varchar(20) DEFAULT 'ativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
--
-- Inserir Dados na Tabela `cursos`
--
LOCK TABLES `cursos` WRITE;
--
INSERT INTO `cursos` VALUES (1,'Curso de Introdução à Programação','Aprenda os conceitos básicos de programação.','ativo'),(3,'Python','Linguagem Python','ativo'),(11,'Postman','Curso de Postman','ativo'),(12,'PHP2','Curso PHP2','ativo'),(13,'Python22','Linguagem de Programação Python','ativo'),(14,'Curso de Introdução à Programação','Aprenda os conceitos básicos de programação.','ativo'),(15,'Programação Android Studio','Programação para Dispositivos Móveis','ativo'),(16,'MySQL Workbench','Ferramenta de Gerenciamento de Banco de Dados MySQL.','ativo'),(17,'Programacao Back-End','Aprendizagem focado na programacao Back_end.','ativo'),(18,'Curso de Mecanica','Aprendendo Mecanica Basica','ativo'),(19,'Curso Montagem Hardware','Montagem Hardware','ativo'),(20,'Curso Culinaria','Culinaria para Leigos','ativo');
--
UNLOCK TABLES;




--
-- Criar a Estrutura da Tabela `topicos`
--
DROP TABLE IF EXISTS `topicos`;
--
CREATE TABLE `topicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `ordem` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `curso_id` (`curso_id`),
  CONSTRAINT `topicos_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
--
-- Inserir Dados na Tabela `topicos`
--
LOCK TABLES `topicos` WRITE;
--
INSERT INTO `topicos` VALUES (1,1,'O que é Programação?',1),(2,1,'Variáveis e Tipos de Dados',2),(3,1,'Estruturas de Controle',3),(4,15,'Fundamentos Android Studio',0),(5,16,'Fundamentos',0),(6,16,'Aprofundando Conhecimentos',1),(7,17,'Fundamentos.',0),(8,17,'Intermediario',1),(9,17,'Avancado',2),(10,18,'Fundamentos',0),(11,18,'Intermediario',1),(12,18,'Avancado',2),(13,19,'Fundamentos',0),(14,19,'Intermediario',1),(15,19,'Avancado',2),(16,19,'Extra1',3),(17,20,'Fundamentos',0),(18,20,'Intermediario',1),(19,20,'Avancado',2),(20,20,'Extra1',3),(21,20,'Extra2',4);
--
UNLOCK TABLES;



--
-- Criar a estrutura da Tabela `conteudos`
--
DROP TABLE IF EXISTS `conteudos`;
--
CREATE TABLE `conteudos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topico_id` int(11) NOT NULL,
  `tipo` enum('texto','video') NOT NULL,
  `conteudo` text NOT NULL,
  `ordem` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `topico_id` (`topico_id`),
  CONSTRAINT `conteudos_ibfk_1` FOREIGN KEY (`topico_id`) REFERENCES `topicos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
--
-- Inserir Dados na Tabela `conteudos`
--
LOCK TABLES `conteudos` WRITE;
--
INSERT INTO `conteudos` VALUES (1,1,'texto','Programar significa escrever instruções que serão executadas por um computador.',1),(2,1,'video','https://www.youtube.com/embed/Z1Yd7upQsXY',2),(3,2,'texto','Variáveis armazenam valores. Tipos comuns: inteiro, texto, booleano.',1),(4,2,'video','https://www.youtube.com/embed/_bYFu9mBnr4',2),(5,3,'texto','Comandos como if, else, while e for controlam o fluxo do programa.',1),(6,4,'texto','Mais informações sobre os fundamentos do Android Studio.',0),(7,4,'video','https://www.youtube.com/watch?v=9tKR2Q4w26o&list=PLPs3nlHFeKTowh2OA-WpV0yQz3FVtiZ_W',1),(8,5,'texto','O que e o MySQL Workbench?',0),(9,5,'video','https://www.youtube.com/watch?v=B3eqOasNn8A&list=PLfvOpw8k80WoSXjfGFci23SPob_PdvpHx',1),(10,6,'texto','Para que serve o MySQL Workbench?',0),(11,6,'video','https://www.youtube.com/watch?v=0Vbu1OGeclY',1),(12,7,'texto','Este e um topico de Fundamentos.',0),(13,8,'texto','Conteudo intermediario',0),(14,9,'texto','Conteudo Avancado.',0),(15,10,'texto','Fundamentos',0),(16,11,'texto','Intermediario',0),(17,12,'texto','Avancado',0),(18,13,'texto','Fundamentos',0),(19,14,'texto','Intermediario',0),(20,15,'texto','Avancado',0),(21,16,'texto','Extra1',0),(22,17,'texto','Fundamentos',0),(23,18,'texto','Intermediario',0),(24,19,'texto','Avancado',0),(25,20,'texto','Extra1',0),(26,21,'texto','Extra2',0);
--
UNLOCK TABLES;





--
-- Criar a Estrutura da Tabela `usuarios`
--
DROP TABLE IF EXISTS `usuarios`;
--
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `papel` enum('admin','usuario') NOT NULL DEFAULT 'usuario',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
--
-- Inserir Dados na Tabela `usuarios`
--
LOCK TABLES `usuarios` WRITE;
--
INSERT INTO `usuarios` VALUES (1,'Administrador','admin@unicorp.com','123456','admin','2025-04-05 21:21:46'),(2,'Maria Aluna','maria@unicorp.com','123456','usuario','2025-04-05 21:21:46'),(3,'João Estudante','joao@unicorp.com','123456','usuario','2025-04-05 21:21:46');
--
UNLOCK TABLES;





--
-- Criar a Estrutura da Tabela `matriculas`
--
DROP TABLE IF EXISTS `matriculas`;
--
CREATE TABLE `matriculas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `status` enum('matriculado','concluido','cancelado') DEFAULT 'matriculado',
  `data_matricula` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_id` (`usuario_id`,`curso_id`),
  KEY `curso_id` (`curso_id`),
  CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
--
-- Inserir Dados na Tabela `matriculas`
--
LOCK TABLES `matriculas` WRITE;
--
INSERT INTO `matriculas` VALUES (1,2,1,'concluido','2025-04-17 21:57:31'),(3,3,1,'cancelado','2025-04-17 21:57:31'),(5,2,12,'matriculado','2025-04-18 03:44:14'),(6,2,11,'matriculado','2025-04-19 15:23:12'),(7,2,3,'matriculado','2025-04-19 15:47:27'),(8,2,16,'concluido','2025-04-25 01:38:27'),(9,2,17,'concluido','2025-04-25 02:02:49'),(10,2,13,'matriculado','2025-04-26 02:38:49'),(11,2,18,'concluido','2025-04-26 02:40:52'),(12,2,19,'concluido','2025-04-26 13:26:21'),(13,2,20,'concluido','2025-04-26 13:43:20');
--
UNLOCK TABLES;



--
-- Criar a Estrutura da Tabela `progresso`
--
DROP TABLE IF EXISTS `progresso`;
--
CREATE TABLE `progresso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `topico_id` int(11) NOT NULL,
  `concluido` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `curso_id` (`curso_id`),
  KEY `topico_id` (`topico_id`),
  CONSTRAINT `progresso_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `progresso_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `progresso_ibfk_3` FOREIGN KEY (`topico_id`) REFERENCES `topicos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
--
-- Inserir Dados na Tabela `progresso`
--
LOCK TABLES `progresso` WRITE;
--
INSERT INTO `progresso` VALUES (1,2,1,1,1),(2,2,1,2,1),(3,2,1,3,1),(4,2,16,5,1),(5,2,16,6,1),(6,2,17,7,1),(7,2,17,8,1),(8,2,17,9,1),(9,2,18,10,1),(10,2,18,11,1),(11,2,18,12,1),(12,2,19,15,1),(13,2,19,16,1),(14,2,20,17,1),(15,2,20,18,1),(16,2,20,19,1),(17,2,20,20,1),(18,2,20,21,1);
--
UNLOCK TABLES;










