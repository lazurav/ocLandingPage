CREATE TABLE IF NOT EXISTS `oc_landing` (
      `landing_id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `url_param` varchar(255) NOT NULL,
      `status` tinyint(1) NOT NULL,
      PRIMARY KEY (`landing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;
CREATE TABLE IF NOT EXISTS `oc_landing_description` (
      `landing_id` int(11) NOT NULL,
      `language_id` int(11) NOT NULL,
      `description` text NOT NULL,
      `meta_h1` varchar(255) NOT NULL,
      `meta_title` varchar(255) NOT NULL,
      `meta_description` varchar(255) NOT NULL,
      `meta_keyword` varchar(255) NOT NULL,
      PRIMARY KEY (`landing_id`, `language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
