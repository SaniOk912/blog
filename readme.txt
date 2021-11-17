Welcome!
All the database settings are located in 'config.php'.

Database structure:

CREATE TABLE `newTestSchema`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `img` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `age` INT NOT NULL , `status` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`));

CREATE TABLE `newTestSchema`.`posts` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `content` TEXT NOT NULL , `author_id` INT NOT NULL , `img` VARCHAR(255) NOT NULL , `date` DATETIME NOT NULL , `likes` INT NOT NULL , PRIMARY KEY (`id`));

CREATE TABLE `newTestSchema`.`likes` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `post_id` INT NOT NULL , PRIMARY KEY (`id`));

CREATE TABLE `newTestSchema`.`comments` ( `id` INT NOT NULL AUTO_INCREMENT , `author_id` INT NOT NULL , `post_id` INT NOT NULL , `content` TEXT NOT NULL , `date` DATETIME NOT NULL , `likes` INT NOT NULL , PRIMARY KEY (`id`));
