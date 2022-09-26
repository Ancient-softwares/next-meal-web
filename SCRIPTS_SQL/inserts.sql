USE dbNextMeal;

INSERT INTO tbtipoprato(tipoPrato, created_at, updated_at)
VALUES
	('Brasileiro', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Chinesa', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Italiana', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Lanches', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Vegetariana', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Vegana', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Japonesa', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Mediterranea', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Mexicana', '2022-09-09 16:28:49', '2022-09-09 16:28:49');
    

INSERT INTO tbtiporestaurante(tipoRestaurante, created_at, updated_at)
VALUES
	('Bistrô', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Buffet', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Cafeteria', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Cantina', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Clássico', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Comfort Food', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Fast food', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Food truck', '2022-09-09 16:28:49', '2022-09-09 16:28:49'),
    ('Grill', '2022-09-09 16:28:49', '2022-09-09 16:28:49');


INSERT INTO tbrestaurante (nomeRestaurante,cpfRestaurante,telRestaurante,loginRestaurante,senhaRestaurante,fotoRestaurante,emailRestaurante,cepRestaurante,ruaRestaurante,numRestaurante,bairroRestaurante,cidadeRestaurante,estadoRestaurante,capMaximaRestaurante,idTipoRestaurante) 
VALUES
	 ('Spoleto','12312312312','1112312312','spoleto','$2y$10$hAO9CDA4j/84fHN7xMd71O9VQPEyH8ODCW0au21VjE10EG9Hgkx7a','5959b0e1b2f1b247193e447679f06e32.png','spoleto@email.com','04849333','Rua 9 de Setembro','10','Chácara Gaivotas','São Paulo','SP',60,4),
	 ('Ragazzo','12312312312','1112312312','spoleto','$2y$10$hAO9CDA4j/84fHN7xMd71O9VQPEyH8ODCW0au21VjE10EG9Hgkx7a','5959b0e1b2f1b247193e447679f06e32.png','spoleto@email.com','04849333','Rua 9 de Setembro','10','Chácara Gaivotas','São Paulo','SP',60,1),
	 ('Bar dos amigos','12312312312','1112312312','spoleto','$2y$10$hAO9CDA4j/84fHN7xMd71O9VQPEyH8ODCW0au21VjE10EG9Hgkx7a','5959b0e1b2f1b247193e447679f06e32.png','spoleto@email.com','04849333','Rua 9 de Setembro','10','Chácara Gaivotas','São Paulo','SP',60,2),
	 ('Mocotó','12312312312','1112312312','spoleto','$2y$10$hAO9CDA4j/84fHN7xMd71O9VQPEyH8ODCW0au21VjE10EG9Hgkx7a','5959b0e1b2f1b247193e447679f06e32.png','spoleto@email.com','04849333','Rua 9 de Setembro','10','Chácara Gaivotas','São Paulo','SP',60,3),
	 ('McDonalds','12312312312','1112312312','spoleto','$2y$10$hAO9CDA4j/84fHN7xMd71O9VQPEyH8ODCW0au21VjE10EG9Hgkx7a','5959b0e1b2f1b247193e447679f06e32.png','spoleto@email.com','04849333','Rua 9 de Setembro','10','Chácara Gaivotas','São Paulo','SP',60,1);

INSERT INTO tbavaliacao (notaAvaliacao, idRestaurante,descAvaliacao,dtAvaliação,created_at,updated_at) VALUES
	 (5, 8,'teste1','2022-09-18','2022-09-18 21:51:42.0','2022-09-18 21:51:42.0'),
	 (4, 9,'teste2','2022-09-18','2022-09-18 21:51:42.0','2022-09-18 21:51:42.0'),
	 (1, 10,'teste3','2022-09-18','2022-09-18 21:51:42.0','2022-09-18 21:51:42.0'),
	 (5, 11,'teste1','2022-09-18','2022-09-18 21:55:56.0','2022-09-18 21:55:56.0'),
	 (4, 12,'teste2','2022-09-18','2022-09-18 21:55:56.0','2022-09-18 21:55:56.0'),
	 (1, 13,'teste3','2022-09-18','2022-09-18 21:55:56.0','2022-09-18 21:55:56.0');

-- INNER JOIN das tabelas tbrestaurante, tbtiporestaurante e tbavaliacao
SELECT tbrestaurante.nomeRestaurante, tbtiporestaurante.tipoRestaurante, tbavaliacao.notaAvaliacao FROM tbrestaurante 
	INNER JOIN tbtiporestaurante 
		ON tbtiporestaurante.idTipoRestaurante = tbrestaurante.idTipoRestaurante
		INNER JOIN tbavaliacao 
			ON tbavaliacao.idRestaurante = tbrestaurante.idRestaurante      