INSERT INTO timezones (name, offset) VALUES
	('UTC+0', 0),
	('UTC+1', 1),
	('UTC+2', 2),
	('UTC+3', 3),
	('GB', 0),
	('CZ', 1),
	('DE', 1),
	('IT', 1),
	('RO', 2),
	('RU', 3);

INSERT INTO raiders (id, name, timezone) VALUES
	(1, 'Saidi', 'DE'),
	(2, 'Masya', 'GB'),
	(3, 'Historia', 'UTC+3'),
	(4, 'Aurimond', 'CZ'),
	(5, 'Jean', 'GB'),
	(6, 'Kai', 'RU'),
	(7, 'Grenn', 'DE'),
	(8, 'Shia', 'IT');


INSERT INTO statics (tank1,	tank2, 	heal1,	heal2,	mdps1,	mdps2,	rdps1,	rdps2,	day, 		start, finish) VALUES
					(8, 	5, 		2,		3, 		1,		4,		6,		7, 		'thursday',	'18:00', '21:00'),
					(8, 	5, 		2, 		3, 		1, 		4, 		6, 		7, 		'sunday', '18:00', '21:00');

