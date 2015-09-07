-- MySQL Script generated by MySQL Workbench
-- 09/07/15 18:29:59
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
SHOW WARNINGS;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `Base`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Base` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Base` (
  `name` VARCHAR(100) NOT NULL COMMENT '',
  `date` DATETIME NOT NULL COMMENT '',
  `preview` VARCHAR(200) NULL COMMENT '',
  `tag` VARCHAR(20) NULL COMMENT '',
  `visits` INT NULL COMMENT '',
  `descr` VARCHAR(2000) NULL COMMENT '',
  `likes` INT NULL COMMENT '',
  `share` VARCHAR(100) NULL COMMENT '',
  PRIMARY KEY (`name`, `date`)  COMMENT '')
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `Name_UNIQUE` ON `Base` (`name` ASC)  COMMENT '';

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `calendar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `calendar` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `calendar` (
  `date` DATE NOT NULL COMMENT '',
  `name` VARCHAR(100) NULL COMMENT '',
  `event` VARCHAR(100) NULL COMMENT '',
  PRIMARY KEY (`date`)  COMMENT '')
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `date_UNIQUE` ON `calendar` (`date` ASC)  COMMENT '';

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `records`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `records` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `records` (
  `name` VARCHAR(100) NOT NULL COMMENT '',
  `date` DATETIME NOT NULL COMMENT '',
  `tag` VARCHAR(20) NULL COMMENT '',
  `photo` VARCHAR(100) NULL COMMENT '',
  PRIMARY KEY (`name`, `date`)  COMMENT '')
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `Name_UNIQUE` ON `records` (`name` ASC)  COMMENT '';

SHOW WARNINGS;

-- -----------------------------------------------------
-- Data for table `Base`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `Base` (`name`, `date`, `preview`, `tag`, `visits`, `descr`, `likes`, `share`) VALUES ('Friends party', '2015-09-20', '\\img\\preview\\1.jpg', 'Inspiration', 3, 'Эта история про девушку волшебной красоты, про ее возлюбленного, прекрасного принца, про их особенный день на таинственном острове, в средиземном море... Таких историй может быть много в нашем блоге, скажете вы. Все красивые, влюбленные, на фоне красивых садов, городов, островов... Но Даша и Андрей по праву занимают отдельное место среди всех историй, отдельное место в наших сердцах! В апреле прошлого года нам пришли от Даши несколько сообщение в WhatsApp... Несколько спутанных сообщений - \"Есть ли у нас планы на октябрь? Не собираемся ли мы в Европу? Точнее в Грецию?\" И понеслась... переписка, диалоги, поиски, аудиосообщения, фотографии мест и деталей... В итоге не октябрь, а конец сентября. Не Греция, а Мальта, не голубой, а фиолетовый с розовым в оформлении, и много чего еще успело поменяться за пол-года подготовки. Но одно было неизменно - нам доверили снимать эту свадьбу! И мы благодарны Даше и Андрею, за то, что сдвинули дату церемонии ради нашего присутствия в этот день. И мы благодарны судьбе, что все совпало и срослось. Что вот такую красивую свадебную съемку имеем теперь в своем портфолио и можем вам показать с большим удовольствием!!!', 5, NULL);
INSERT INTO `Base` (`name`, `date`, `preview`, `tag`, `visits`, `descr`, `likes`, `share`) VALUES ('Zhitomir photography', '2015-09-22', '\\img\\preview\\14.jpg', 'Wedding', 5, 'Изучать Италию всегда очень интересно и познавательно! Эта страна абсолютно ни на какую другу не похожая. Все потому, что ее регионы, провинции и коммуны сами не похожи друг на друга! Север Италии - он один, центральная часть сапога совсем другая, а юг и вовсе третий... И таких не больше не меньше 20 регионов, а провинций вообще 110. А коммун знаете сколько? Даже арифметическая прогрессия не поможет нам с вами попасть в нужное число - их 8101. И все разные, как рыбы в море!', 8, NULL);
INSERT INTO `Base` (`name`, `date`, `preview`, `tag`, `visits`, `descr`, `likes`, `share`) VALUES ('Masha and Yakov', '2015-09-24', '\\img\\preview\\4.jpg', 'Love story', 2, 'Говорят - чужие дети быстро растут... Мы можем наблюдать это своими глазами. Совсем недавно, полгода назад на свет появилась чудесная малышка Настя! Она хмурила бровки на выписке из роддома, и через несколько недель на первой фотосесии и даже через полгода \"строит\" нас, то улыбаясь, то не давая согласия на фотосъемку! Держитесь женихи - улыбку Насти нужно заслужить =)', 2, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `calendar`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `calendar` (`date`, `name`, `event`) VALUES ('2013-09-20', 'Friends party', 'Вилазка одногрупників');
INSERT INTO `calendar` (`date`, `name`, `event`) VALUES ('2015-09-20', 'Nastya and Maxim', 'Planed wedding');
INSERT INTO `calendar` (`date`, `name`, `event`) VALUES ('2015-09-22', 'Nastya and Maxim', 'Planed wedding');
INSERT INTO `calendar` (`date`, `name`, `event`) VALUES ('2015-09-23', 'Nastya and Maxim', 'Planed birthday party');
INSERT INTO `calendar` (`date`, `name`, `event`) VALUES ('2015-09-24', 'Nastya and Maxim', 'Planed wedding');

COMMIT;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
