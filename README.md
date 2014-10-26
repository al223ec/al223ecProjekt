Projekt
-------------------
Krav och testfall
-----------------
https://docs.google.com/document/d/1Ajvv6el25APgUmSdfPb31AG7uhWWeE9iaKLg3c5faE0/pub

UMLDesign 
-----------------
http://antonledstrom.se/projekt/ProjektUML.png
Alla klasser och attribut är inte med, har fokuserat på att försöka visa MVC designen av applikationen. 
Största delen som saknas är routing klassesn. 

Automatiserad testrapport
-----------------
http://antonledstrom.se/projekt/tests/
Har inte haft tid att programmera så mycket tester som jag önskat 

Installation
-----------------
Användarnamn "admin" och pw: "password" användare med administratör behörighet. 
Användarnamn "user" och pw: "p" en vanlig användare. 

Förändra lösen, användarnamn och adressen till databasen i "settings.xml" i applikationens root.
    
    <dbPassword></dbPassword>
    <dbUserName>root</dbUserName>
    <dbName>project</dbName>
    <dbIpAddress>127.0.0.1</dbIpAddress>

Om man vill att undantag ska visas måste man förändra config.php i core, DE_BUG = true, annars sparas dessa till myerrors.log.  

För att applikationen ska fungera måste dessa tabeller finnas: 

UserTable
-----------------
CREATE TABLE IF NOT EXISTS `users` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`id`),
		  UNIQUE KEY `user_name` (`user_name`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

BloggPostTable
-----------------
CREATE TABLE IF NOT EXISTS `bloggposts` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `titel` varchar(100)  CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `text` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `time` int(11) NOT NULL,
		  `user_id` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76;


En användare med admin behörighet. un: Admin pw: password.
INSERT INTO `users` (`id`, `user_name`, `password_hash`, `is_admin`) VALUES
(4, 'Admin', '$2a$10$XDcs46VyIvI6r2KVnwztLuz5HbyV9zI2/3U58i6pjjFhvIW9BS/wm', 1)


Kommentarer | Dokumentation
-----------------
Har lagt väldigt mycket tid på applikationens själva ramverk och att få till detta på ett snyggt och effektivt sätt.
Jag har också lagt mycket tid på att få till ordentliga testningsmöjligheter med automatiserade tester. 

Testning
----------------
Varit ganska dålig på att dokumentera mina tester, bortsett från de automatiserade testerna. Skulle också ha kunnat skriva betydligt tydligare och mer utvecklade Use-cases. 
Jag har kunnat testa att utveckla ett projekt på ett testdrivet sätt. Har dock inte riktigt haft tid att skriva så mycket tester som jag önskat, spenderade mycket tid på att få till och testa core biten för applikationen. Så stora delar av applikationen inkluderas inte i de automatiserade testerna. 
Att arbeta testdrivet har varit svårt, jag har skrivit tester för klasser som har täckt in koden väl sedan förändrat klasser pga hur utvecklingen har gått och nya krav som har ställts på applikationen då falerar dessa tester och jag behöver skriva om testerna.
Jag tror att skriva TDD kräver en förändring i mitt sätt att programmera, tror jag behöver ta mer eftertänksamma beslut.  

Applikationens design
-----------
Kärnan i applikationen är Router klassen det är denna klass som läser in rätt kontroller och rätt funktion utifrån den URL som användaren anger. Alla giltiga routes finns definerade i klassen Routes. 
Tex url:en root/twitter/ kommer att intiera objektet twitter_controller och dess funktion main som är default samt kallar på tillhörande vys render funktion. 
Url:en /blogg/view/82 intierar blogg_controller och kör dess funktion view med parametern 82.
Vyn ansvarar själv för att inkludera korrekt fil och att "extract:a" dess variabler som har blivit satt genom att kalla på funktioner från kontrollerns funktion. 

En stor nakdel med denna design är att undantag som kastas i vy filerna inte alltid görs att applikationen avbryts. Det finns också ett visst beroende mellan olika filer i all vy klasser. Tycker inte detta är ett egentligt problem, mer att man måste vara medveten hur man definierar variabler över de olika vy filerna. 

Klassen loader som hanterar objekt utifrån ett singelton mönster har också på många sett blivit överflödig, den behövdes i applikationens tidigare skede. Men den är egentligen inte nödvändig nu. 

Sammanfattning
------------------
Övergripande tycker jag applikationen ser bra ut, applikationens stora brist är hur själva renderingen fungerar. Tror jag bör utveckla vidare en renderklass av någon sort som routern i sin tur talar med. 
Applikationen är i vissa delar lite inkonsekvent, detta beror mest på att jag har kommit på. vid tillfället, bättre lösningar på tidigare problem. Detta är mest tydligt i authoriserings biten av applikationen. 
Skulle vilja lägga mer tid på felhantering och bättre användarvänlighet. Sen är det en hel del städning och förbättringar som kan göras på många ställen i applikation tex. hur settingsobjekten hanteras. 