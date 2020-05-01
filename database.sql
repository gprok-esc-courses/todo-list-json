CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
