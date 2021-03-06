CREATE TABLE IF NOT EXISTS `taxonomy` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tag_id` int(10) DEFAULT NULL,
  `taxonomy_id` int(10) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(200) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_id` (`tag_id`),
  KEY `pareent_taxonomy_id` (`taxonomy_id`),
  KEY `pareent_taxonomy_id_2` (`taxonomy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;



ALTER TABLE `items`  ADD `board_id` INT(50) NOT NULL AFTER `createdTime`

ALTER TABLE `theme` ADD `status` INT( 1 ) NOT NULL AFTER `theme_name` 


CREATE TABLE IF NOT EXISTS `theme_value` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `key` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `theme_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
)