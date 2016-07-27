-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 22, 2007 at 10:09 PM
-- Server version: 4.0.16
-- PHP Version: 4.4.1
-- 
-- Database: `dargamin_dareborn`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `categories`
-- 

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `nummer` int(11) NOT NULL default '0',
  `catid` int(11) NOT NULL auto_increment,
  `catname` longtext NOT NULL,
  `catdesc` longtext NOT NULL,
  PRIMARY KEY  (`catid`)
) TYPE=MyISAM AUTO_INCREMENT=35 ;

-- 
-- Dumping data for table `categories`
-- 

INSERT INTO `categories` (`nummer`, `catid`, `catname`, `catdesc`) VALUES (1, 32, 'Introduction', '<p>If you are new to the clan site, here is a guide on what to do. Firstly, if you dont know about something, check \r\nthe <a href=faq.php>FAQ</a> on help on it. So, what do you do once you know about the clan? There are lots of things you can do. Most \r\nimportabtly, stay active. Being active makes you popular and gives you a high reputation.\r\n</p>\r\n<p>\r\nOnce you get more involved and feel like helping the clan even more, take a job. Chose a job you wish to take \r\nand post about it on the <u>jobs board</u>(no board made yet, however). Go to the jobs page to find out more.\r\n</p>\r\n<p>\r\nIf you do these things more and more, you will earn respect and may very well be promoted. \r\nHere is a list of the things you can do to get a high position:\r\n</p>\r\n<ol align=left>\r\n<li> Posting on the forum (share ideas, comment on ideas and comment on anything)</li>\r\n<li> Sharing your msn/aim address (so that we can easily contact you)</li>\r\n<li> Join a squad (see the ~squads~ page)</li>\r\n<li> Coming along to clan events</li>\r\n<li> Taking a job and contributing to it</li>\r\n<li> Earning trust (show you are trustworthy and responsible)</li>\r\n</ol>\r\n\r\n<p>\r\nAfter doing these things, you will very likely become an admin. So, try to be as active as possible and contribute \r\nbut most importantly of all, have fun!\r\n</p>\r\n\r\n<p>Some people have done all of these and instantly been ranked up to the highest of positions.\r\nKane1245 is an example who was active, went to all of the events and showed he could be trusted.\r\nHe is now in the council of the top5!\r\n'),
(2, 34, 'FAQ', '\r\n\r\nCan I join?\r\n\r\n\r\n\r\nOf course, we are open to anyone if they pass the rules, requirements and accept them (you must be over lvl 70). We don’t care about your age or who you are as long as you don’t beg like a n00b and you don’t flame (like Dawnzombie did). You obviously have to play runescape too (free or member version).\r\n\r\n\r\n\r\nDo I get free stuff for joining the clan?\r\n\r\n\r\n\r\nNo you do not get free stuff. We do not believe in bribing our members. If you are a n00b who needs free stuff to join, go join another clan such as those you may see handing out free rune to new members. You must NEVER beg other clan members for free stuff but if you work hard, you may very well be rewarded.\r\n\r\n\r\n\r\nHow do I become a mod or an admin?\r\n\r\n\r\n\r\nTo be promoted to a higher rank you must be active on the site and post on the private boards quite often. If you display a good attitude and loyalty you will be promoted to a moderator. If you continue on like this and donate time/efforts for movies/clan events you could be promoted to an administrator.\r\n\r\n\r\n\r\nWhat do I have to do to be “active”?\r\n\r\n\r\n\r\nTo be active you have to log on to the clan site but that is not all. To be seen as an active clan member you should post on the private board and participate in clan events (not just watch movies and view the most active boards every so often).\r\n\r\n\r\n\r\n\r\n\r\nWill I be kicked out if I don’t log on for 2 months?\r\n\r\n\r\n\r\nYes, not being active for 2 months results in being deleted from the clan site and thrown out of the clan. If this happens, simply reapply. Then you can rejoin as long as you will be active. \r\n\r\n\r\n\r\nWhat’s the point in going to clan events such as PK trips. Why should I have to come?\r\n\r\n\r\n\r\nWhen you join the clan you are accepting that you will try to support our events when you can. After all, why join if you’re not thinking of going to events? What’s the point of a clan then?\r\n\r\n\r\n\r\nHow do I talk to other clan members and administrators?\r\n\r\n\r\n\r\nYou can always message us on the clan site using MESSAGING but the best way is to use MSN / AOL instant messenger especially before PK trips. Get an account on MSN or AOL instant messengers and put your screen names in ‘account setup’ so we can also instant message you. \r\n\r\n\r\n\r\nI feel useless in the clan. What can I do?\r\n\r\n\r\n\r\nThis is good for us. you can advertise the clan to others who are at least combat level 70, (make sure to never publicly announce the clan site URL, only tell others privately, (say Darktiger.run.to) you can post on the private board with ideas and things you want the clan to do. You can also help edit/crop pictures for clan movies. For more information see the clan jobs board.\r\n\r\n\r\n\r\nAll these people are getting thrown out! What will get me thrown out?? Am I in danger???????\r\n\r\n\r\n\r\nWe delete people from the clan for reasonable causes. We do not accept the following: flaming, scamming, hacking, begging, abusive behaviour, SPYING FROM OTHER CLANS and complainers. (See rules section)\r\n\r\n\r\n\r\nI know a noob and I want them dead!\r\n\r\n\r\n\r\nIf you want someone whacked, tell us and we’ll take care of tha matter. If there is a noob that really bugs you then get a picture of him and we can put him on the noob board of shame! J\r\n\r\n\r\n\r\nWhat basic things can I download to protect me from getting hacked?\r\n\r\n\r\n\r\nIf you do not have zone alarm the firewall then you should get it at www.zonelabs.com and I strongly suggest Nortan antivirus as they work well as one to make a good protection. Also, don’t be stupid in giving your password away and don’t get scammed. Note: Zone Alarm will not protect agenced key loggers and other harmful Trojan viruses. The best solution is to buy Nortan Internet Security 2004.\r\n\r\n\r\n\r\nI got hacked! Can the clan help me?\r\n\r\n\r\n\r\nIf one of our members get hacked on runescape, we are willing to find the hacker and make him pay and if you lost a lot of stuff then we could try to help out (don’t expect new, free equipment). See the help Board for more details. If you are hacked on the clan site then we will try to recover your password. (Contact CLEAKO @ Cleako@hotmail.com) One more thing, for a hard to guess password, uses a code like “he7isc”.\r\n\r\n\r\n\r\nHuh? Why cant I log in, my password doesn’t work! Can I get it mailed to me?\r\n\r\n\r\n\r\nIf you lose your password or find it is changed, all you have to do after seeing that your password is incorrect is look down below the login when it says Login Failed. There is a password recovery box there. All you must do is type in your runescape name and your password will be automatically mailed right to your email.\r\n\r\n\r\n\r\nWhen is the most active time on the clan site and on runescape?\r\n\r\n\r\n\r\nThat would be Saturday/Saturday night J\r\n\r\n\r\n\r\n\r\n\r\nTime zones!? What time zone does the clan try to run on?\r\n\r\n\r\n\r\nMost of the users are in American East Coast time/ Eastern Standard Time (EST) also the same as New York City Time. TNUAC is in GMT which is 5 hours ahead so work out the time relevance between your time and EST/NYC time.\r\n\r\n\r\n\r\nWhen’s the next PK trip?\r\n\r\n\r\n\r\nTo find this out see the shout box and the clan events board. There is also a page located on the left column called “Whens the next PK trip?” Most of the time after a date has been set, CLEAKO will reset the counters to count down to the minute until the PK trip is held, and several counters are displayed, each on main times that most clan members are located on. If the time is way out of your ability to come like 3am, then tell us on the clan events board. (with a 12 hour time zone period this is hard!)\r\n\r\n\r\n\r\nYou talk about Nazis and KKK. Why is this?\r\n\r\n\r\n\r\nWe do NOT believe in these things and any form of dictatorism and people killing. Some clan members may talk of such things, but nobody believes in it. Were all equal here and simply make fun of it J\r\n\r\n\r\n\r\nCan I join another clan once I’m in Dark Tigers of Death?\r\n\r\n\r\n\r\nIf you are already a clan member, NO. If u get deleted from the clan for a distinctive reason and make a new clan, that clan will be destroyed unless allied somehow. However, if you ask to leave and make a new clan its fine with us (As long as those who are recruited ARE NOT MEMBERS OF THIS CLAN. If your friend''s clan wants to ally that is fine as long as they follow the “so you want to ally” rules and fill out a form (located on same page).\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nHave we missed anything? Please ask us! TNUAC, on msn messenger at tnuac_915@hotmail.com and on AOL instant messenger TNUAC101 or EREZ GOLD on msn asdj_edge13@hotmail.com and djedge13 on AIM. Just message any admin on the clan site\r\n\r\n------------------------------------------------------\r\n\r\n');

-- --------------------------------------------------------

-- 
-- Table structure for table `forum`
-- 

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `board` varchar(30) NOT NULL default '',
  `topic` int(11) NOT NULL default '0',
  `replied` varchar(30) NOT NULL default '',
  `timestamp` varchar(30) default NULL,
  `locked` varchar(30) NOT NULL default '0',
  `message` longtext NOT NULL,
  `subject` varchar(30) NOT NULL default '',
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL default '',
  `area` varchar(30) NOT NULL default '',
  `conn` varchar(30) NOT NULL default '',
  `posted` varchar(30) NOT NULL default '',
  `edited` varchar(11) NOT NULL default '0',
  `replies` int(30) NOT NULL default '0',
  `lastpost` varchar(30) default NULL,
  `views` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=116 ;

-- 
-- Dumping data for table `forum`
-- 

INSERT INTO `forum` (`board`, `topic`, `replied`, `timestamp`, `locked`, `message`, `subject`, `id`, `username`, `area`, `conn`, `posted`, `edited`, `replies`, `lastpost`, `views`) VALUES ('6', 0, '90', '1174450025', '0', 'COOKIES!', 'cookies', 97, 'grogbro', '', '', 'Mar 20 09:07PM', '0', 0, NULL, 0),
('6', 1, '98', '1174525706', '0', 'Cleako,\r\nIn this version I have turned off the application accept part. You can turn it on in login.php if I''m correct.\r\n\r\nSome pages do not contain the login check... I was working too fast ;)\r\n\r\nIn the database at voting, I''m not sure but the answer fields must be NOT empty, otherwise there''ll be an error.', 'Some stuff...', 98, 'peter', '', '', 'Mar 20 11:42PM', '0', 3, 'Mar 21 06:08PM', 66),
('6', 0, '90', '1174419081', '0', 'sup dude', 'yo', 94, 'peter', '', '', 'Mar 20 12:31PM', '0', 0, NULL, 0),
('6', 0, '90', '1174419503', '0', 'Peter!', '', 95, 'cleako', '', '', 'Mar 20 12:38PM', '0', 0, NULL, 0),
('6', 1, '90', '1174510178', '0', 'I like eggs', 'What is there to eat', 90, 'Cleako', '', '', 'Mar 20 12:15PM', '0', 9, 'Mar 21 01:49PM', 50),
('6', 0, '90', '1174425184', '0', 'all works now?', '', 96, 'peter', '', '', 'Mar 20 02:13PM', '0', 0, NULL, 0),
('6', 0, '90', '1174487013', '0', 'COOKIES ROCK!', '', 101, 'cleako', '', '', 'Mar 21 07:23AM', '0', 0, NULL, 0),
('6', 0, '98', '1174487097', '0', 'Thanks for the help, I was wondering which page had the application accept part.\r\n\r\nWith the voting, is that error a "cannot divide by zero" sort of error?\r\n\r\nBTW: have you ever been sucessful at getting the login.php page to use MD5 passwords?  That is one thing I need to convert this to because I''d like to use this with that game Grogbro and I are working on.', '', 102, 'cleako', '', '', 'Mar 21 07:24AM', '0', 0, NULL, 0),
('6', 0, '90', '1174495207', '0', 'Floating wetsuit, whats a morning boner?', '', 104, 'argaroth', '', '', 'Mar 21 09:40AM', '0', 0, NULL, 0),
('6', 0, '98', '1174498193', '0', 'Yes the voting error is the "cannot divide by zero"\r\n\r\nnever done the md5\r\n\r\nthe avatar is in the database', '', 105, 'peter', '', '', 'Mar 21 10:29AM', '0', 0, NULL, 0),
('6', 0, '90', '1174506583', '0', ';)', '', 106, 'cleako', '', '', 'Mar 21 12:49PM', '0', 0, NULL, 0),
('6', 0, '98', '1174506612', '0', 'great, thanks', '', 108, 'cleako', '', '', 'Mar 21 12:50PM', '0', 0, NULL, 0),
('6', 0, '90', '1174509907', '0', 'hai guyz! *sips orange juice*', '', 113, 'Braveheart49', '', '', 'Mar 21 01:45PM', '0', 0, NULL, 0),
('6', 0, '90', '1174510178', '0', 'WHERES THE RED BEER????', '', 114, 'cleako', '', '', 'Mar 21 01:49PM', '0', 0, NULL, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `forum_list`
-- 

DROP TABLE IF EXISTS `forum_list`;
CREATE TABLE IF NOT EXISTS `forum_list` (
  `timestamp` timestamp(14) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `forum` varchar(30) NOT NULL default '',
  `description` varchar(100) NOT NULL default '',
  `topics` int(11) NOT NULL default '0',
  `posts` varchar(11) NOT NULL default '',
  `lastpost` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `forum_list`
-- 

INSERT INTO `forum_list` (`timestamp`, `id`, `forum`, `description`, `topics`, `posts`, `lastpost`) VALUES ('20070322055721', 6, 'The Pub', 'Talk about anything here.', -1, '', 'Mar 21 06:08PM'),
('20070322055721', 7, 'Technology', 'Discuss computers and other sorts of technology here.', 0, '', ''),
('20070322055652', 8, 'Movies and Music', 'Talk all about movies and music here.', 0, '', ''),
('20070322055835', 9, 'Letters of Marque', 'Show off your favorite poems and artwork here.', 0, '', ''),
('20070322055905', 10, 'Dead men Tell no tales', 'This is the ultimate smack board, where anything you say can, and will be used against you. C+P WARS', 0, '', ''),
('20070322055948', 11, 'Private board based games', 'Bringing back the good stuff.', 0, '', ''),
('20070322060017', 12, 'Towelon''s mansion', 'Hilarity persues!', 0, '', ''),
('20070322060104', 13, 'N00b board of shame', 'All n00bs belong here.', 0, '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `messaging`
-- 

DROP TABLE IF EXISTS `messaging`;
CREATE TABLE IF NOT EXISTS `messaging` (
  `id` int(11) NOT NULL auto_increment,
  `subject` varchar(30) NOT NULL default '[no text]',
  `message` longtext NOT NULL,
  `from` int(30) NOT NULL default '0',
  `to` int(30) NOT NULL default '0',
  `recieved` varchar(50) NOT NULL default '',
  `timestamp` varchar(50) NOT NULL default '',
  `folder` set('inbox','trash','outbox','deleted') NOT NULL default '',
  `read` varchar(50) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=114 ;

-- 
-- Dumping data for table `messaging`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `news`
-- 

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(30) NOT NULL default '',
  `message` varchar(100) NOT NULL default '',
  `date` varchar(30) default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=15 ;

-- 
-- Dumping data for table `news`
-- 

INSERT INTO `news` (`id`, `category`, `message`, `date`) VALUES (9, 'Maintenance', 'Updated PHP security on the news page and on the PHP info', 'Mar 21, 2007'),
(8, 'Site update', 'Added the news back', 'Mar 21, 2007'),
(10, 'Site update', 'Cleaned up the news table for appeal', 'Mar 21, 2007'),
(11, 'Site update', 'added the dragon, enabled applications', 'Mar 22, 2007'),
(12, 'Site update', 'Made login invisible on main page to those already logged in, added "remember me" check box', 'Mar 22, 2007'),
(13, 'Site update', 'Register and login pages both use MD5 passwords, still need to update account setup''s change passwor', 'Mar 22, 2007'),
(14, 'Site update', 'Placed the news table in an iframe to save page space', 'Mar 22, 2007');

-- --------------------------------------------------------

-- 
-- Table structure for table `online`
-- 

DROP TABLE IF EXISTS `online`;
CREATE TABLE IF NOT EXISTS `online` (
  `user` varchar(30) NOT NULL default '',
  `timestamp` varchar(30) NOT NULL default '',
  `ip` varchar(50) NOT NULL default '',
  `sitename` varchar(60) NOT NULL default '',
  `page` varchar(40) NOT NULL default ''
) TYPE=MyISAM;

-- 
-- Dumping data for table `online`
-- 

INSERT INTO `online` (`user`, `timestamp`, `ip`, `sitename`, `page`) VALUES ('cleako', '1174626562', '24.211.253.22', 'Annihilators', 'private.php');

-- --------------------------------------------------------

-- 
-- Table structure for table `poll`
-- 

DROP TABLE IF EXISTS `poll`;
CREATE TABLE IF NOT EXISTS `poll` (
  `total` int(30) default '0',
  `id` int(11) NOT NULL auto_increment,
  `answer1` varchar(30) NOT NULL default '',
  `answer2` varchar(30) NOT NULL default '',
  `answer3` varchar(30) NOT NULL default '',
  `answer4` varchar(30) NOT NULL default '',
  `answer5` varchar(30) NOT NULL default '',
  `answer6` varchar(30) NOT NULL default '',
  `question` varchar(50) NOT NULL default '',
  `status` varchar(30) NOT NULL default '',
  `votes1` varchar(30) default NULL,
  `voting` varchar(30) NOT NULL default '',
  `vote` varchar(30) NOT NULL default '',
  `votes2` int(30) default NULL,
  `votes3` int(30) default NULL,
  `votes4` int(30) default NULL,
  `votes5` int(30) default NULL,
  `votes6` int(30) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `poll`
-- 

INSERT INTO `poll` (`total`, `id`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `answer6`, `question`, `status`, `votes1`, `voting`, `vote`, `votes2`, `votes3`, `votes4`, `votes5`, `votes6`) VALUES (2, 9, 'To party', 'To make babies', 'To pwn noobs', 'To slay dragons', 'To get to level 99', '', 'What is the meaning of life?', 'open', NULL, '', '', 2, NULL, NULL, NULL, NULL),
(1, 10, 'YEAH!', 'nope :(', '', '', '', '', 'Does this site rock or what?', 'open', '1', '', '', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(50) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `name` varchar(50) NOT NULL default '',
  `msn` varchar(50) NOT NULL default '',
  `yahoo` varchar(50) NOT NULL default '',
  `icq` varchar(50) NOT NULL default '',
  `aim` varchar(50) NOT NULL default '',
  `country` varchar(50) NOT NULL default '',
  `birth` varchar(50) NOT NULL default '',
  `user_level` varchar(50) NOT NULL default '',
  `dl` varchar(50) NOT NULL default '',
  `accepted` int(2) NOT NULL default '0',
  `last_login_date` varchar(30) default NULL,
  `login_count` bigint(100) NOT NULL default '0',
  `posts` int(11) NOT NULL default '0',
  `voting` varchar(30) NOT NULL default '',
  `last_login_timestamp` varchar(30) NOT NULL default '',
  `topic_id` varchar(30) NOT NULL default '',
  `account` varchar(50) NOT NULL default '',
  `skype` varchar(30) NOT NULL default '',
  `rank` varchar(30) NOT NULL default 'Member',
  `avwidth` int(11) NOT NULL default '100',
  `avheigth` int(11) NOT NULL default '100',
  `sig` text NOT NULL,
  `avatar` varchar(100) NOT NULL default 'images/noavatar.gif',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=39 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `msn`, `yahoo`, `icq`, `aim`, `country`, `birth`, `user_level`, `dl`, `accepted`, `last_login_date`, `login_count`, `posts`, `voting`, `last_login_timestamp`, `topic_id`, `account`, `skype`, `rank`, `avwidth`, `avheigth`, `sig`, `avatar`) VALUES (20, 'Cleako', '8969d0f660779554ada68c07ab1a91f8', 'cleako@gmail.com', 'Brett Ellis', 'cleako@hotmail.com', 'masterofnoobz@yahoo.com', '', 'Caesar Lupus', 'USA', '18-07-1987', '1', 'Top Administrator', 1, 'Mar 22 10:07:02PM', 58, 21, '8,10,9', '1174626422', '', '', 'Blackwolfmarwood', 'Admin', 100, 100, 'I am t3h master of t3h n00bz', 'http://www.dargamingco.com/av-2.jpg'),
(21, 'Braveheart49', 'feeb4bbb085f1566812e956e9c671511', 'majere86@hotmail.com', '', '', '', '', '', '', '', '1', 'Member', 1, 'Mar 21 01:44:25PM', 4, 1, '', '1174509865', '', '', '', 'Admin', 100, 100, '', 'images/noavatar.gif'),
(23, 'peter', '5e6fcb9c648d799cd888502c85db4b84', 'admin@flottieljezeilen.net', '', '', '', '', '', '', '', '10', 'Member', 1, 'Mar 22 07:33:53PM', 9, 4, '9', '1174617233', '', '', '', 'Dracconian', 100, 100, '', 'images/noavatar.gif'),
(29, 'grogbro', 'c070caf5c443ef79c97a4ff7b32ae6a1', 'grogbro@yahoo.com', 'Greg Breault', '', '', '', '', '', '', '10', 'Member', 1, 'Mar 20 09:06:21PM', 1, 1, '', '1174449981', '', '', '', 'Member', 100, 100, '', 'images/noavatar.gif'),
(31, 'argaroth', 'bed9617d382a93d4aec86455afcc2dd4', 'argaroth@gmail.com', 'Erez', 'argaroth@romanwolves.com', '', '20513753', '', 'Israel', '16-04-1989', '1', 'Admin', 1, 'Mar 22 11:42:17AM', 4, 1, '', '1174588937', '', '', '', 'Admin', 100, 100, '', 'images/noavatar.gifhttp://img.photobucket.com/albums/v503/argaroth/14921500149215111492-150014931490');
