DROP TABLE IF EXISTS `ddd`;

CREATE TABLE `ddd` (
  `id` tinyint NOT NULL,
  `origem` int NOT NULL,
  `destino` int NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `ddd` (`id`, `origem`, `destino`, `valor`) VALUES
(1,	11,	16,	1.9),
(2,	16,	11,	2.9),
(3,	11,	17,	1.7),
(4,	17,	11,	2.7),
(5,	11,	18,	0.9),
(6,	18,	11,	1.9);
