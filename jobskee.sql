-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2013 at 10:16 PM
-- Server version: 5.5.27
-- PHP Version: 5.3.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `jobskee`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@example.com', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `cover_letter` text,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(150) DEFAULT NULL,
  `websites` text,
  `attachment` text,
  `token` varchar(32) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `banlist`
--

CREATE TABLE IF NOT EXISTS `banlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` varchar(160) DEFAULT NULL,
  `url` varchar(150) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `url`, `sort`) VALUES
(1, 'Programming', 'Find the best Programming jobs here!', 'programming', 1),
(2, 'Design', 'Find the best Design jobs here!', 'design', 2),
(3, 'Business', 'Find the best Business jobs here!', 'business', 3),
(4, 'IT Admin', 'Find the best IT Admin jobs here!', 'it-admin', 4),
(5, 'Content', 'Find the best Content jobs here!', 'content', 6),
(6, 'Support', 'Find the best Support jobs here!', 'support', 5);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` varchar(160) DEFAULT NULL,
  `url` varchar(150) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `description`, `url`, `sort`) VALUES
(1, 'Anywhere', 'Find the best jobs here!', 'anywhere', 1),
(2, 'Manila', 'Find the best Manila jobs here!', 'manila', 2),
(3, 'Madrid', 'Find the best Madrid jobs here!', 'madrid', 3),
(4, 'Frankfurt', 'Find the best Frankfurt jobs here!', 'frankfurt', 4),
(5, 'Beijing', 'Find the best Beijing jobs here!', 'beijing', 5),
(6, 'New York', 'Find the best New York jobs here!', 'new-york', 6);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `category` tinyint(4) DEFAULT NULL,
  `city` tinyint(4) DEFAULT NULL,
  `description` text,
  `perks` text,
  `how_to_apply` text,
  `company_name` varchar(255) DEFAULT NULL,
  `logo` text,
  `url` text,
  `email` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `category`, `city`, `description`, `perks`, `how_to_apply`, `company_name`, `logo`, `url`, `email`, `is_featured`, `token`, `status`, `created`) VALUES
(1, 'Optimized Modular Contingency', 1, 4, 'Quia numquam reiciendis ipsa dolorum. Non nihil eveniet pariatur nam doloremque. Nam provident consequuntur sed sunt quod veritatis at. A vel quia molestias quia. Natus labore nihil tenetur modi a ipsum. Culpa aperiam est sed quasi eum eum assumenda.', 'Voluptates debitis earum error et saepe tempore.\r\n\r\ndebitis earum error et saepe tempore.', 'Est voluptas cum aut sit sint quo. Eos cumque harum est velit.\r\n\r\ndebitis earum error et saepe tempore.', 'White Inc', '1387023698_inmotion.gif', 'http://mullerrussel.com/', 'rus@mullerrussel.com', 0, '356a192b7913b04c54574d18c28d46e6', 1, '2013-12-03 02:53:58'),
(2, 'Proactive Non-volatile Functionalities', 6, 6, 'Magni voluptas dolor optio repudiandae doloribus explicabo. Nam sunt labore suscipit eaque. Cupiditate sapiente inventore debitis repellat.', 'Eos molestiae doloribus laborum maxime dolor consequatur nemo.', 'Eveniet enim odit alias. Aperiam est sapiente magni deleniti adipisci dolores.', 'Gutkowski-Sanford', '', 'http://www.yundt.info/', 'nframi@gleasonokuneva.com', 1, 'da4b9237bacccdf19c0760cab7aec4a8', 1, '2013-12-03 02:53:58'),
(3, 'Monitored Eco-centric Attitude', 5, 6, 'Sunt amet eum unde delectus dolorem. Et molestiae dolores eos perferendis et hic ad hic. Laborum unde ut et facere fugit. Accusantium asperiores et animi veritatis accusamus.', 'Sed distinctio et nisi et. Voluptas harum omnis dolor porro sit voluptate.', 'Perferendis magnam voluptatum molestiae repudiandae.', 'Emard, Terry and Padberg', '', 'http://walker.com/', 'dickens.einar@keebler.org', 1, '77de68daecd823babbb58edb1c8e14d7', 0, '2013-12-03 02:53:58'),
(4, 'Distributed Maximized Ability', 3, 2, 'Error illum consectetur voluptatum ea consequatur hic. Culpa alias rem praesentium modi. Consequatur tenetur nihil perspiciatis. Ex est voluptatibus doloremque voluptatibus et sunt. Et quia est quibusdam numquam veniam.', 'Ut ipsa laborum velit praesentium eligendi nesciunt. Quam iure quod tempora aperiam laboriosam excepturi fuga dolorem.', 'Autem dignissimos modi assumenda dolorum inventore asperiores.', 'Mayert-Gerlach', '', 'http://www.bartell.org/', 'stevie.volkman@bahringerwindler.com', 0, '1b6453892473a467d07372d45eb05abc', 0, '2013-12-03 02:53:58'),
(5, 'Distributed Responsive Info-mediaries', 5, 3, 'Sint voluptas non laudantium. Error quia architecto optio suscipit. Nemo rerum nihil esse expedita vel ad. Fuga fuga ut fugiat est. Dolorem eligendi quia animi aut.', 'Nulla neque voluptatum tenetur laborum et.', 'Maiores magnam velit esse non.', 'Wiza, Abshire and Kessler', '', 'http://kundeglover.net/', 'huel.norbert@bergnaum.biz', 1, 'ac3478d69a3c81fa62e60f5c3696165a', 1, '2013-12-03 02:53:59'),
(6, 'Mandatory Mission-critical Database', 1, 6, 'Quod dolorum ut quod aut distinctio voluptas itaque alias. Voluptatem ut aut quia fuga a. Ducimus dolore quia soluta ad at ipsum incidunt. Nesciunt in suscipit qui porro dolorum nesciunt quam. Est a assumenda expedita alias iste. Dolorum provident tenetur voluptatibus voluptas et officia deserunt.', 'Aliquam et nihil vero facere consequatur.', 'Animi est nesciunt velit sequi id doloribus. Nihil et illum consequatur qui aut consequatur ea.', 'Osinski, Marvin and Farrell', '', 'http://denesik.net/', 'gkoch@morissette.com', 1, 'c1dfd96eea8cc2b62785275bca38ac26', 1, '2013-12-03 02:53:59'),
(7, 'Re-engineered Exuding Info-mediaries', 6, 4, 'Ullam est assumenda cupiditate voluptates. Qui corporis ut vel laborum qui quibusdam corporis. Et nemo natus pariatur molestiae tempore dolorem. Id non vitae accusantium qui ut. Molestiae nobis et sint recusandae illo.', 'Praesentium magni eos dolorum amet aut ex. Qui deleniti exercitationem totam quos.', 'Nam eligendi recusandae facilis. Sed porro est nesciunt mollitia.', 'Buckridge and Sons', '', 'http://tremblay.info/', 'baylee50@schoenjerde.com', 1, '902ba3cda1883801594b6e1b452790cc', 1, '2013-12-03 02:53:59'),
(8, 'Function-based Secondary Artificialintelligence', 2, 6, 'Corporis placeat eos odit distinctio non sunt voluptatem culpa. Voluptatum consequatur laudantium quos et laborum nihil. Rerum mollitia incidunt eveniet quod. Natus inventore omnis distinctio animi voluptatem commodi. Reiciendis nulla ducimus labore est ad molestias.', 'Perspiciatis a voluptatum unde.', 'Id natus illo repudiandae totam reprehenderit voluptatum. Veritatis quos soluta nulla aut in maiores.', 'Douglas and Sons', '', 'http://www.terry.com/', 'sgoldner@yahoo.com', 1, 'fe5dbbcea5ce7e2988b8c69bcfdfde89', 1, '2013-12-03 02:53:59'),
(9, 'Stand-alone Exuding Hardware', 4, 2, 'In perferendis aperiam iusto minima reprehenderit. Qui et nisi impedit sequi qui consequatur. Exercitationem architecto beatae rerum hic odit molestias sint adipisci. Aspernatur est est commodi doloremque incidunt non quis. Architecto possimus in vel sed.', 'Voluptas maxime et expedita dolores libero mollitia. Nemo et quo qui repellat ut cumque.', 'Ea tenetur odit eaque quos vero. Ratione eius fugit accusamus quo.', 'Wolf, Moen and Zemlak', '', 'http://www.schmidtmertz.com/', 'ischmitt@torphyschneider.com', 1, '0ade7c2cf97f75d009975f4d720d1fa6', 1, '2013-12-03 02:53:59'),
(10, 'Persistent Tertiary Encoding', 6, 1, 'Ratione ut nulla est laudantium. Cum provident corporis deleniti iure. Corporis provident est cupiditate facilis voluptatem autem laboriosam ab. Quis repellendus qui possimus nihil ducimus aut fugit sit. Rem molestiae minima sapiente odit.', 'Autem delectus eaque accusantium. Ipsam praesentium architecto ut magnam cupiditate nemo dolorum.', 'Voluptatem quo cum voluptas enim exercitationem. Eos rerum sed sed velit vitae.', 'Carter, Keeling and O''Hara', '', 'http://www.welchschumm.com/', 'pollich.deven@bogan.net', 1, 'b1d5781111d84f7b3fe45a0852e59758', 1, '2013-12-03 02:53:59'),
(11, 'Front-line Static Paradigm', 3, 2, 'Id et qui laboriosam ut magnam dicta est. Id qui amet rerum quis vero. Neque molestias nemo magni nam consequatur. Nam dolor dolorum aut magni. Dolorum aut et in. Et ut repellendus qui dignissimos corporis.', 'Dolorem delectus iste et et.', 'Architecto ut laudantium consequuntur cumque voluptatem ut. Qui natus eum minus non.', 'Leuschke, Wisozk and Koss', '', 'http://www.muller.biz/', 'powlowski.gabrielle@trantowparisian.net', 1, '17ba0791499db908433b80f37c5fbc89', 0, '2013-12-03 02:53:59'),
(12, 'Optimized Content-based Benchmark', 4, 1, 'Enim atque magnam nihil. Eum et expedita consequatur consequatur qui commodi. Ipsam est non officiis accusantium hic sequi. Rerum nemo iusto molestias quisquam laborum voluptates consectetur dolor. Ratione accusamus rerum cum sequi sed ut magni pariatur. Temporibus tempore doloremque qui ut aut animi.', 'Qui ab facilis nobis accusamus laboriosam.', 'Est ad vel hic quia assumenda rerum.', 'Glover, Greenholt and Boyle', '', 'http://www.swaniawski.com/', 'ziemann.stanton@gusikowski.net', 0, '7b52009b64fd0a2a49e6d8a939753077', 0, '2013-12-03 02:53:59'),
(13, 'Function-based 5thgeneration Migration', 4, 6, 'Voluptatem nulla autem cumque voluptate fugiat voluptates rerum. Cum maxime quibusdam et in quasi voluptatem. Ea natus consequatur voluptas sed. Quis dolores dicta sit accusamus aspernatur iste.', 'Nisi incidunt qui adipisci atque nobis nam occaecati.', 'Minima repellendus quibusdam eveniet iste beatae incidunt unde.', 'Friesen-Lowe', '', 'http://conroy.info/', 'bertrand29@yahoo.com', 0, 'bd307a3ec329e10a2cff8fb87480823d', 0, '2013-12-03 02:53:59'),
(14, 'Organized 5thgeneration Processimprovement', 3, 2, 'Sint dolorem qui necessitatibus. Rerum suscipit animi consequatur omnis. Eveniet ullam omnis dolore est molestiae. Quia in reiciendis libero molestias.', 'Quia ut nesciunt minima eveniet cumque.', 'Velit maxime quasi accusamus omnis doloribus praesentium. Accusantium repellendus dolorem deserunt est repudiandae aut porro.', 'Volkman Ltd', '', 'http://www.corkery.info/', 'yhagenes@ohara.com', 1, 'fa35e192121eabf3dabf9f5ea6abdbcb', 0, '2013-12-03 02:54:00'),
(15, 'Innovative Non-volatile Definition', 3, 6, '**Dolorem aut recusandae adipisci aut.** \r\n\r\n- Quas aut temporibus repellat et et voluptatem. \r\n- Dolores ut quo explicabo maiores dolor nemo velit. \r\n- Aliquam vitae modi aut odit reiciendis et aspernatur blanditiis. \r\n\r\n*Velit nemo quos consectetur porro quisquam eos.* \r\n\r\nNihil qui deserunt aspernatur sequi et.', 'Consequatur iure corporis distinctio dolorum nesciunt omnis. Laborum est eveniet perferendis eaque reprehenderit consequatur.', 'Ullam at et eum. Ducimus accusamus et qui.', 'Langosh-Rohan', '', 'http://www.nikolaus.com/', 'mitchell.daphne@gmail.com', 0, 'f1abd670358e036c31296e66b3b66c38', 0, '2013-12-03 02:54:00'),
(16, 'Vision-oriented Analyzing Systemengine', 1, 1, 'Reprehenderit vero porro quidem ratione veniam quia. Culpa nesciunt fuga aspernatur explicabo. Ducimus expedita dolorem aut dicta. Veritatis et quia impedit perspiciatis consectetur sunt impedit.', 'Molestiae provident animi officiis enim eaque. Eveniet ut impedit eligendi vero.', 'Sit itaque nihil ex sed consectetur sunt fuga.', 'Smitham Ltd', '', 'http://willms.com/', 'kacey.morissette@dibbert.net', 0, '1574bddb75c78a6fd2251d61e2993b51', 0, '2013-12-03 02:54:00'),
(17, 'Customizable Assymetric Approach', 5, 6, 'Quidem sit totam dolor quia. Ut nostrum corporis ut et. Incidunt libero rerum rem itaque et ex recusandae non. Tempora adipisci quis voluptates aut tenetur repellat natus architecto.', 'Ut adipisci id molestias ea impedit nihil quisquam. Saepe culpa nihil aspernatur aliquam ut minus.', 'Provident rem perferendis numquam non dolor aperiam optio praesentium. Dolorum voluptates aperiam nesciunt quo voluptas dolor natus eos.', 'Cassin-Veum', '', 'http://www.connelly.com/', 'deontae67@hettinger.biz', 1, '0716d9708d321ffb6a00818614779e77', 0, '2013-12-03 02:54:00'),
(18, 'Adaptive Actuating Success', 4, 2, 'Qui inventore eum illum quisquam iusto. Voluptatem sed odit eveniet. Hic et neque modi magni placeat nulla ut sequi. Assumenda placeat ea expedita vel inventore.', 'Ex et rerum ea ab est et occaecati. Aut velit dolores repudiandae sed aspernatur.', 'Quo modi voluptate quia est. Odit et ut quisquam sunt quia.', 'Leffler-VonRueden', '', 'http://www.corwinreilly.info/', 'miguel.windler@yahoo.com', 1, '9e6a55b6b4563e652a23be9d623ca505', 1, '2013-12-03 02:54:00'),
(19, 'Centralized Multimedia Infrastructure', 3, 6, 'Et quo rerum tempore sint non ipsa omnis voluptatem. Sit perferendis eum aliquam ad. Est nesciunt et deserunt tempora voluptate. Sed velit quaerat asperiores nostrum illo vel nam. Expedita consequatur harum nisi voluptatem velit nemo consequatur.', 'Ut quibusdam quae explicabo optio ab est.', 'Autem voluptate est sequi dolor. Nisi praesentium dicta est voluptatum qui doloremque et saepe.', 'Renner LLC', '', 'http://www.daughertybergnaum.biz/', 'annie39@hotmail.com', 1, 'b3f0c7f6bb763af1be91d9e74eabfeb1', 1, '2013-12-03 02:54:00'),
(20, 'Proactive Cohesive Success', 1, 5, 'Voluptatum natus a reiciendis aut voluptatibus. Corporis earum in quaerat sunt aliquam harum quas. Impedit rerum quis deleniti nihil aspernatur. Qui laudantium non nihil voluptatem rem.', 'Et rerum quia animi qui voluptate. Ut qui provident quia necessitatibus ea voluptas blanditiis.', 'Distinctio sit sapiente voluptatem voluptate quia rerum quidem. Nam omnis voluptatem quo nisi molestiae qui nostrum quam.', 'McKenzie PLC', '', 'http://roberts.biz/', 'mallory.gutmann@connkuhn.com', 0, '91032ad7bbcb6cf72875e8e8207dcfba', 1, '2013-12-03 02:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` varchar(160) DEFAULT NULL,
  `url` varchar(150) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `description`, `url`, `content`) VALUES
(1, 'About', 'About this page', 'about', 'An h1 header\r\n============\r\n\r\nParagraphs are separated by a blank line.\r\n\r\n2nd paragraph. *Italic*, **bold**, `monospace`. Itemized lists\r\nlook like:\r\n\r\n  * this one\r\n  * that one\r\n  * the other one\r\n\r\nNote that --- not considering the asterisk --- the actual text\r\ncontent starts at 4-columns in.\r\n\r\n> Block quotes are\r\n> written like so.\r\n>\r\n> They can span multiple paragraphs,\r\n> if you like.\r\n\r\nUse 3 dashes for an em-dash. Use 2 dashes for ranges (ex. "it''s all in\r\nchapters 12--14"). Three dots ... will be converted to an ellipsis.\r\n\r\n\r\n\r\nAn h2 header\r\n------------\r\n\r\nHere''s a numbered list:\r\n\r\n 1. first item\r\n 2. second item\r\n 3. third item\r\n\r\nNote again how the actual text starts at 4 columns in (4 characters\r\nfrom the left side). Here''s a code sample:\r\n\r\n    # Let me re-iterate ...\r\n    for i in 1 .. 10 { do-something(i) }\r\n\r\nAs you probably guessed, indented 4 spaces. By the way, instead of\r\nindenting the block, you can use delimited blocks, if you like:\r\n\r\n~~~\r\ndefine foobar() {\r\n    print "Welcome to flavor country!";\r\n}\r\n~~~\r\n\r\n(which makes copying & pasting easier). You can optionally mark the\r\ndelimited block for Pandoc to syntax highlight it:\r\n\r\n~~~python\r\nimport time\r\n# Quick, count to ten!\r\nfor i in range(10):\r\n    # (but not *too* quick)\r\n    time.sleep(0.5)\r\n    print i\r\n~~~\r\n\r\n\r\n\r\n### An h3 header ###\r\n\r\nNow a nested list:\r\n\r\n 1. First, get these ingredients:\r\n\r\n      * carrots\r\n      * celery\r\n      * lentils\r\n\r\n 2. Boil some water.\r\n\r\n 3. Dump everything in the pot and follow\r\n    this algorithm:\r\n\r\n        find wooden spoon\r\n        uncover pot\r\n        stir\r\n        cover pot\r\n        balance wooden spoon precariously on pot handle\r\n        wait 10 minutes\r\n        goto first step (or shut off burner when done)\r\n\r\n    Do not bump wooden spoon or it will fall.\r\n\r\nNotice again how text always lines up on 4-space indents (including\r\nthat last line which continues item 3 above). Here''s a link to [a\r\nwebsite](http://foo.bar). Here''s a link to a [local\r\ndoc](local-doc.html). Here''s a footnote [^1].\r\n\r\n[^1]: Footnote text goes here.\r\n\r\nTables can look like this:\r\n\r\nsize  material      color\r\n----  ------------  ------------\r\n9     leather       brown\r\n10    hemp canvas   natural\r\n11    glass         transparent\r\n\r\nTable: Shoes, their sizes, and what they''re made of\r\n\r\n(The above is the caption for the table.) Here''s a definition list:\r\n\r\napples\r\n  : Good for making applesauce.\r\noranges\r\n  : Citrus!\r\ntomatoes\r\n  : There''s no "e" in tomatoe.\r\n\r\nAgain, text is indented 4 spaces. (Alternately, put blank lines in\r\nbetween each of the above definition list lines to spread things\r\nout more.)'),
(2, 'Contact', 'Contact us', 'contact', '# An exhibit of Markdown\r\n\r\nThis note demonstrates some of what [Markdown][1] is capable of doing.\r\n\r\n*Note: Feel free to play with this page. Unlike regular notes, this doesn''t automatically save itself.*\r\n\r\n## Basic formatting\r\n\r\nParagraphs can be written like so. A paragraph is the basic block of Markdown. A paragraph is what text will turn into when there is no reason it should become anything else.\r\n\r\nParagraphs must be separated by a blank line. Basic formatting of *italics* and **bold** is supported. This *can be **nested** like* so.\r\n\r\n## Lists\r\n\r\n### Ordered list\r\n\r\n1. Item 1\r\n2. A second item\r\n3. Number 3\r\n4. Ⅳ\r\n\r\n*Note: the fourth item uses the Unicode character for [Roman numeral four][2].*\r\n\r\n### Unordered list\r\n\r\n* An item\r\n* Another item\r\n* Yet another item\r\n* And there''s more...\r\n\r\n## Paragraph modifiers\r\n\r\n### Code block\r\n\r\n    Code blocks are very useful for developers and other people who look at code or other things that are written in plain text. As you can see, it uses a fixed-width font.\r\n\r\nYou can also make `inline code` to add code into other things.\r\n\r\n### Quote\r\n\r\n> Here is a quote. What this is should be self explanatory. Quotes are automatically indented when they are used.\r\n\r\n## Headings\r\n\r\nThere are six levels of headings. They correspond with the six levels of HTML headings. You''ve probably noticed them already in the page. Each level down uses one more hash character.\r\n\r\n### Headings *can* also contain **formatting**\r\n\r\n### They can even contain `inline code`\r\n\r\nOf course, demonstrating what headings look like messes up the structure of the page.\r\n\r\nI don''t recommend using more than three or four levels of headings here, because, when you''re smallest heading isn''t too small, and you''re largest heading isn''t too big, and you want each size up to look noticeably larger and more important, there there are only so many sizes that you can use.\r\n\r\n## URLs\r\n\r\nURLs can be made in a handful of ways:\r\n\r\n* A named link to [MarkItDown][3]. The easiest way to do these is to select what you want to make a link and hit `Ctrl+L`.\r\n* Another named link to [MarkItDown](http://www.markitdown.net/)\r\n* Sometimes you just want a URL like <http://www.markitdown.net/>.\r\n\r\n## Horizontal rule\r\n\r\nA horizontal rule is a line that goes across the middle of the page.\r\n\r\n---\r\n\r\nIt''s sometimes handy for breaking things up.\r\n\r\n## Images\r\n\r\nMarkdown can also contain images. I''ll need to add something here sometime.\r\n\r\n## Finally\r\n\r\nThere''s actually a lot more to Markdown than this. See the official [introduction][4] and [syntax][5] for more information. However, be aware that this is not using the official implementation, and this might work subtly differently in some of the little things.\r\n\r\n\r\n  [1]: http://daringfireball.net/projects/markdown/\r\n  [2]: http://www.fileformat.info/info/unicode/char/2163/index.htm\r\n  [3]: http://www.markitdown.net/\r\n  [4]: http://daringfireball.net/projects/markdown/basics\r\n  [5]: http://daringfireball.net/projects/markdown/syntax\r\n'),
(3, 'Terms', 'terms', 'terms', 'An h1 header\r\n============\r\n\r\nParagraphs are separated by a blank line.\r\n\r\n2nd paragraph. *Italic*, **bold**, `monospace`. Itemized lists\r\nlook like:\r\n\r\n  * this one\r\n  * that one\r\n  * the other one\r\n\r\nNote that --- not considering the asterisk --- the actual text\r\ncontent starts at 4-columns in.\r\n\r\n> Block quotes are\r\n> written like so.\r\n>\r\n> They can span multiple paragraphs,\r\n> if you like.\r\n\r\nUse 3 dashes for an em-dash. Use 2 dashes for ranges (ex. "it''s all in\r\nchapters 12--14"). Three dots ... will be converted to an ellipsis.\r\n\r\n\r\n\r\nAn h2 header\r\n------------\r\n\r\nHere''s a numbered list:\r\n\r\n 1. first item\r\n 2. second item\r\n 3. third item\r\n\r\nNote again how the actual text starts at 4 columns in (4 characters\r\nfrom the left side). Here''s a code sample:\r\n\r\n    # Let me re-iterate ...\r\n    for i in 1 .. 10 { do-something(i) }\r\n\r\nAs you probably guessed, indented 4 spaces. By the way, instead of\r\nindenting the block, you can use delimited blocks, if you like:\r\n\r\n~~~\r\ndefine foobar() {\r\n    print "Welcome to flavor country!";\r\n}\r\n~~~\r\n\r\n(which makes copying & pasting easier). You can optionally mark the\r\ndelimited block for Pandoc to syntax highlight it:\r\n\r\n~~~python\r\nimport time\r\n# Quick, count to ten!\r\nfor i in range(10):\r\n    # (but not *too* quick)\r\n    time.sleep(0.5)\r\n    print i\r\n~~~\r\n\r\n\r\n\r\n### An h3 header ###\r\n\r\nNow a nested list:\r\n\r\n 1. First, get these ingredients:\r\n\r\n      * carrots\r\n      * celery\r\n      * lentils\r\n\r\n 2. Boil some water.\r\n\r\n 3. Dump everything in the pot and follow\r\n    this algorithm:\r\n\r\n        find wooden spoon\r\n        uncover pot\r\n        stir\r\n        cover pot\r\n        balance wooden spoon precariously on pot handle\r\n        wait 10 minutes\r\n        goto first step (or shut off burner when done)\r\n\r\n    Do not bump wooden spoon or it will fall.\r\n\r\nNotice again how text always lines up on 4-space indents (including\r\nthat last line which continues item 3 above). Here''s a link to [a\r\nwebsite](http://foo.bar). Here''s a link to a [local\r\ndoc](local-doc.html). Here''s a footnote [^1].\r\n\r\n[^1]: Footnote text goes here.\r\n\r\nTables can look like this:\r\n\r\nsize  material      color\r\n----  ------------  ------------\r\n9     leather       brown\r\n10    hemp canvas   natural\r\n11    glass         transparent\r\n\r\nTable: Shoes, their sizes, and what they''re made of\r\n\r\n(The above is the caption for the table.) Here''s a definition list:\r\n\r\napples\r\n  : Good for making applesauce.\r\noranges\r\n  : Citrus!\r\ntomatoes\r\n  : There''s no "e" in tomatoe.\r\n\r\nAgain, text is indented 4 spaces. (Alternately, put blank lines in\r\nbetween each of the above definition list lines to spread things\r\nout more.)'),
(4, 'Conditions', 'conditions', 'conditions', '# An exhibit of Markdown\r\n\r\nThis note demonstrates some of what [Markdown][1] is capable of doing.\r\n\r\n*Note: Feel free to play with this page. Unlike regular notes, this doesn''t automatically save itself.*\r\n\r\n## Basic formatting\r\n\r\nParagraphs can be written like so. A paragraph is the basic block of Markdown. A paragraph is what text will turn into when there is no reason it should become anything else.\r\n\r\nParagraphs must be separated by a blank line. Basic formatting of *italics* and **bold** is supported. This *can be **nested** like* so.\r\n\r\n## Lists\r\n\r\n### Ordered list\r\n\r\n1. Item 1\r\n2. A second item\r\n3. Number 3\r\n4. Ⅳ\r\n\r\n*Note: the fourth item uses the Unicode character for [Roman numeral four][2].*\r\n\r\n### Unordered list\r\n\r\n* An item\r\n* Another item\r\n* Yet another item\r\n* And there''s more...\r\n\r\n## Paragraph modifiers\r\n\r\n### Code block\r\n\r\n    Code blocks are very useful for developers and other people who look at code or other things that are written in plain text. As you can see, it uses a fixed-width font.\r\n\r\nYou can also make `inline code` to add code into other things.\r\n\r\n### Quote\r\n\r\n> Here is a quote. What this is should be self explanatory. Quotes are automatically indented when they are used.\r\n\r\n## Headings\r\n\r\nThere are six levels of headings. They correspond with the six levels of HTML headings. You''ve probably noticed them already in the page. Each level down uses one more hash character.\r\n\r\n### Headings *can* also contain **formatting**\r\n\r\n### They can even contain `inline code`\r\n\r\nOf course, demonstrating what headings look like messes up the structure of the page.\r\n\r\nI don''t recommend using more than three or four levels of headings here, because, when you''re smallest heading isn''t too small, and you''re largest heading isn''t too big, and you want each size up to look noticeably larger and more important, there there are only so many sizes that you can use.\r\n\r\n## URLs\r\n\r\nURLs can be made in a handful of ways:\r\n\r\n* A named link to [MarkItDown][3]. The easiest way to do these is to select what you want to make a link and hit `Ctrl+L`.\r\n* Another named link to [MarkItDown](http://www.markitdown.net/)\r\n* Sometimes you just want a URL like <http://www.markitdown.net/>.\r\n\r\n## Horizontal rule\r\n\r\nA horizontal rule is a line that goes across the middle of the page.\r\n\r\n---\r\n\r\nIt''s sometimes handy for breaking things up.\r\n\r\n## Images\r\n\r\nMarkdown can also contain images. I''ll need to add something here sometime.\r\n\r\n## Finally\r\n\r\nThere''s actually a lot more to Markdown than this. See the official [introduction][4] and [syntax][5] for more information. However, be aware that this is not using the official implementation, and this might work subtly differently in some of the little things.\r\n\r\n\r\n  [1]: http://daringfireball.net/projects/markdown/\r\n  [2]: http://www.fileformat.info/info/unicode/char/2163/index.htm\r\n  [3]: http://www.markitdown.net/\r\n  [4]: http://daringfireball.net/projects/markdown/basics\r\n  [5]: http://daringfireball.net/projects/markdown/syntax\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `category_id` tinyint(4) NOT NULL,
  `city_id` tinyint(4) NOT NULL,
  `token` varchar(50) NOT NULL,
  `last_sent` datetime DEFAULT NULL,
  `is_confirmed` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
