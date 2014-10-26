Projekt
-------------------
Krav och testfall
-----------------
https://docs.google.com/document/d/1Ajvv6el25APgUmSdfPb31AG7uhWWeE9iaKLg3c5faE0/pub

UMLDesign 
-----------------
http://antonledstrom.se/projekt/ProjektUML.png

Automatiserad testrapport
-----------------
http://antonledstrom.se/projekt/tests/

Installation
-----------------
Förändra lösen, användarnamn och adressen till databasen i "settings.xml" i applikationens root.
Om man vill att undantag ska visas måste man förändra config.php i core, DE_BUG = true, annars sparas dessa till myerrors.log.  

För att applikationen ska fungera måste dessa tabeller finnas. 


UserTable
CREATE TABLE IF NOT EXISTS `users` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`id`),
		  UNIQUE KEY `user_name` (`user_name`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

BloggPostTable
CREATE TABLE IF NOT EXISTS `bloggposts` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `titel` varchar(100)  CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `text` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `time` int(11) NOT NULL,
		  `user_id` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76;


Kommentarer
-----------------
Har lagt väldigt mycket tid på applikationens själva ramverk och att få till detta på ett snyggt och effektivt sätt.
Jag har också lagt mycket tid på att få till ordentliga testningsmöjligheter med automatiserade tester. 

Jag har inte styrt projektet så mycket på gott och ont. Dock har jag kunnat testa att utveckla applikationen på ett testdrivet sätt 

Om jag designar om projektet måste auth hanteras på ett speciellt sätt, kanske partial page variant

En stor nakdel med denna design är att undantag som kastas i vy filerna inte alltid görs att applikationen avbryts. Det finns också ett visst beroende mellan olika filer i all vy klasser. Tycker inte detta är ett egentligt problem, mer att man måste vara medveten hur man definierar variabler över de olika vy filerna. 

Varit ganska dålig på att dokumentera mina tester. Skulle också ha kunnat skriva tydligare och mer utvecklade Use-cases. 

Har inte riktigt haft tid att skriva så mycket tester som jag önskat, spenderade mycket tid på att få till och testa core biten för applikationen. 


