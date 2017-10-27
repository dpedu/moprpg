
-- run me like:
--     sudo docker exec -i moprpg_mysql_1 mysql < init.sql

CREATE USER 'rpg'@'%' IDENTIFIED BY 'wiggleyourdickbutt';
GRANT ALL PRIVILEGES ON mop_rpg.* TO 'rpg'@'%';
FLUSH PRIVILEGES;

CREATE DATABASE mop_rpg;

-- USE mop_rpg;

-- CREATE TABLE `mrpg_battles` (
--   `id` text,
--   `use` text,
--   `enemy` text,
--   `enemyhp` text,
--   `other` text
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `mrpg_confirm` (
--   `id` int(11) DEFAULT NULL,
--   `q` text,
--   `yesx` int(11) DEFAULT NULL,
--   `yesy` int(11) DEFAULT NULL,
--   `nox` int(11) DEFAULT NULL,
--   `noy` int(11) DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `mrpg_message` (
--   `id` int(11) DEFAULT NULL,
--   `q` text,
--   `x` int(11) DEFAULT NULL,
--   `y` int(11) DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `mrpg_monsters` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `image` text,
--   `hp` int(11) DEFAULT NULL,
--   `name` text,
--   `diemsg` text,
--   `expgive` int(11) DEFAULT NULL,
--   `power` int(11) DEFAULT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- INSERT INTO `mrpg_monsters` VALUES (1,'rat.png',30,'Rat','rat died',10,0);
-- INSERT INTO `mrpg_monsters` VALUES (2,'chef_1.png',30,'Chef','chef screamed "profit has a tiny dick" and died',20,2);
-- INSERT INTO `mrpg_monsters` VALUES (3,'monster.png',30,'Monster','monster died',30,5);

-- CREATE TABLE `mrpg_stat` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `hp` int(11) DEFAULT NULL,
--   `maxhp` int(11) DEFAULT NULL,
--   `pp` int(11) DEFAULT NULL,
--   `offense` int(11) DEFAULT NULL,
--   `defense` int(11) DEFAULT NULL,
--   `fight` int(11) DEFAULT NULL,
--   `speed` int(11) DEFAULT NULL,
--   `wisdom` int(11) DEFAULT NULL,
--   `strength` int(11) DEFAULT NULL,
--   `force` int(11) DEFAULT NULL,
--   `poison` int(11) DEFAULT NULL,
--   `other` int(11) DEFAULT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- CREATE TABLE `mrpg_users` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `name` text,
--   `password` text,
--   `x` int(11) DEFAULT NULL,
--   `y` int(11) DEFAULT NULL,
--   `dir` text,
--   `inventory` text,
--   `level` int(11) DEFAULT NULL,
--   `lastact` text,
--   `mode` text,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
