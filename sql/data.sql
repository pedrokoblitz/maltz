
INSERT INTO `users` VALUES 
(1);

INSERT INTO `roles` VALUES 
(1, 'admin'),
(2, 'editor'),
(3, 'author'),
(4, 'subscriber'),
(5, 'developer'),
(6, 'client'),
(7, 'customer'),
(8, 'seller');

INSERT INTO `users_roles` VALUES 
(1,1);

INSERT INTO `types` VALUES 
(1,'content','page'),
(2,'content','book'),
(3,'content','post'),
(4,'content','project'),
(5,'collection','album'),
(6,'collection','folder'),
(7,'resource','embed'),
(8,'resource','link'),
(9,'resource','file'),
(10,'term','section'),
(11,'term','tag');

INSERT INTO `contents` VALUES 
(1,0,1,1,'2015-07-13 23:27:04','2015-07-13 23:27:04','2015-07-13 23:27:04'),
(2,0,1,1,'2015-07-13 23:27:50','2015-07-13 23:27:50','2015-07-13 23:27:50'),
(3,0,1,1,'2015-07-13 23:28:10','2015-07-13 23:28:10','2015-07-13 23:28:10'),
(4,0,4,1,'2015-07-13 23:29:14','2015-07-13 23:29:14','2015-07-13 23:29:14'),
(5,0,4,1,'2015-07-13 23:29:30','2015-07-13 23:29:30','2015-07-13 23:29:30'),
(6,0,2,1,'2015-07-13 23:29:55','2015-07-13 23:29:55','2015-07-13 23:29:55'),
(7,0,2,1,'2015-07-13 23:30:04','2015-07-13 23:30:04','2015-07-13 23:30:04'),
(8,0,3,1,'2015-07-13 23:30:20','2015-07-13 23:30:20','2015-07-13 23:30:20');

INSERT INTO `collections` VALUES 
(1,NULL,0,5,1,'2015-07-13 23:43:29','2015-07-13 23:43:29'),
(2,NULL,0,5,1,'2015-07-13 23:43:38','2015-07-13 23:43:38');

INSERT INTO `resources` VALUES 
(1);

INSERT INTO `translations` VALUES 
(1,1,'pt-br','content',1,'teste','teste','testando','testando 123 ','testando 123 ','testando 123 '),
(2,1,'pt-br','content',2,'teste-2','teste','testando','testando 123 ','testando 123 ','testando 123 '),
(3,1,'pt-br','content',3,'teste-3','teste','testando','testando 123 ','testando 123 ','testando 123 '),
(4,1,'pt-br','content',4,'teste-4','teste','testando','testando 123 ','testando 123 ','testando 123 '),
(5,1,'pt-br','content',5,'teste-5','teste','testando','testando 123 ','testando 123 ','testando 123 '),
(6,1,'pt-br','content',6,'teste-6','teste','testando','testando 123 ','testando 123 ','testando 123 '),
(7,1,'pt-br','content',7,'teste-7','teste','testando','testando 123 ','testando 123 ','testando 123 '),
(8,1,'pt-br','content',8,'teste-8','teste','testando','testando 123 ','testando 123 ','testando 123 '),
(9,1,'pt-br','content',9,'teste-9','teste','testando','testando 123 ','testando 123 ','testando 123 '),
(10,1,'pt-br','content',10,'teste-10','teste','testando','testando 123 ','testando 123 ','testando 123 '),
(11,1,'pt-br','collection',1,'teste-11','teste','testando','testando 123 ','testando 123 ','testando 123 '),
(12,1,'pt-br','collection',2,'teste-12','teste','testando','testando 123 ','testando 123 ','testando 123 ');

