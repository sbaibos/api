//create database

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `emloyer` varchar(256) NOT NULL,
  `dateStartEnd` varchar(256) NOT NULL,
  `description` text NOT NULL,
   `analyticalDescription` varchar(256) NOT NULL,
   `siteUrl` varchar(256) NOT NULL,
   `photo` varchar(256) NOT NULL,
   `technologiesUsed` varchar(256) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;


INSERT INTO `myprojects7`.`projects` (`id`, `name`, `employer`, `dateStartEnd`, `description`, `analyticalDescription`, `siteUrl`, `photo`, `technologiesUsed`, `modified`) VALUES (NULL, 'philomama', 'freelancing', '2010 -2011', 'A blog-forum -news site done in Drupal 6. The articles are categorised. According to category are fit into specific panel. New article goes to top section of panel. Older articles go to read more section automatically.The site is also multilingual and includes the rather complicated Drupal tool panels ', 'http://sbaibos.com/patrio.html', 'http://www.sbaibos.com/patrio/', 'http://sbaibos.com/img/patrio_main.jpg', 'Drupal 6, Drupal tools, CSS', CURRENT_TIMESTAMP);

//create
{
      "name": "Patrio Homa",
	  "employer": "freelancing",
	  "dateStartEnd": "2010 -2011", 
	  "description": "A blog-forum -news site done in Drupal 6. The articles are categorised. According to category are fit into specific panel. New article goes to top section of panel. Older articles go to read more section automatically.The site is also multilingual and includes the rather complicated Drupal tool panels ",           
      "analyticalDescription": "http://sbaibos.com/patrio.html",
      "siteUrl": "http://www.sbaibos.com/patrio/",
      "photo": "http://sbaibos.com/img/patrio_main.jpg",
      "technologiesUsed": "Drupal 6, Drupal tools, CSS",
	  "created" : "2018-08-01 00:35:07"
		

    }
	
	//update
	
	{"id":"1","name": "Patrio Homa2",
	  "employer": "freelancing2",
	  "dateStartEnd": "2010 -2010", 
	  "description": "1A blog-forum -news site done in Drupal 6. The articles are categorised. According to category are fit into specific panel. New article goes to top section of panel. Older articles go to read more section automatically.The site is also multilingual and includes the rather complicated Drupal tool panels ",           
      "analyticalDescription": "http://sbaibos.com/patrio2.html",
      "siteUrl": "http://www.sbaibos.com/patrio2/",
      "photo": "http://sbaibos.com2/img/patrio_main.jpg",
      "technologiesUsed": "2Drupal 6, Drupal tools, CSS" }