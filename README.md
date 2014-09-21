Projekt PHP
-----------------
Fungerande applikation som uppfyller kraven. Kraven är beskrivna som Use-Cases.
Driftsatt på publikt webbhotell – En fungerande version skall finnas driftsatt på ett publikt webbhotell. Länk skall publiceras i kursens forum och driftsättas tills bedömning har skett.

	U. Applikationen är ej driftsatt på webbhotell
	3-5. Applikationen är driftsatt på minst ett webbhotell

Storlek och komplexitet hos krav och kod
	U. Applikationen är för liten. Ex en blogg där man bara kan skapa inlägg.
	3. Ex. En blogg där man kan skapa och redigera inlägg, ladda upp bilder, kommentera inlägg och redigera sina egna kommentarer.
	4-5. Ex. blogg med ovanstående krav men med Administrationsvy där man kan administrera användare, sätta rättigheter på användare. Applikationen kan installeras med hjälp utav skript.

Vältestat – Visa upp testfall och testrapport. Applikationen testas även av handledare
	U. Buggar även i huvudscenarion
	3. Applikationens huvudscenarios fungerar samt vanliga alternativa scenarion, applikationen i drift innehåller ordentlig test-data (ex blogg med 30 poster av normallängd)
	4. Inga allvarliga buggar hittas av handledare
	5. Handledare kan inte hitta buggar oavsett vad man gör

Kodkvalitet – Visa upp review-rapport
	U. Allvarliga brott mot kvaliteten exempelvis: Inte ens objektorienterad kod
	3. Några brott mot kodkvaliteten
	4. Inga allvarliga brott mot kodkvaliteten, de som hittas kan motiveras. Studenten kan själv berätta vilka delar av koden som “stinker”
	5. Perfekt kod

Följer MVC arkitektur – Visa upp klassdiagram som visar relationerna mellan klasserna
	U. Flera allvarliga brott mot MVC: Exempelvis $_GET används i modellen
	3. Några brott mot MVC	
	4. Inga allvarliga brott mot MVC, de som hittas kan motiveras. Studenten kan själv berätta vilka delar av koden som “stinker”
	5. Perfekt MVC kod, Observer eller annat plymorfiskt pattern används.

Dokumenterad – Applikationen har användardokumentation samt utvecklardokumentation
	U. Ingen dokumentation
	3. Koden är kommenterad
	4. Koden är bra kommenterad, det finns utvecklardokumentation
	5. Perfekta kommentarer. Det finns även användardokumentation

Installeringsbar – Applikationen skall innehålla instruktioner för hur den driftsätts.
	U. Inga instruktioner för installation
	3. Checklista för hur man gör en release till ett nytt webbhotell finns
	4. Installationsskript som skapar, kataloger, databas-tabeller utifrån hårdkodade uppgifter
	5. Installationsskript med användarinterface

Användarvänlighet – Användaren får feedback och tydliga instruktioner, Applikationen följer normer för webbapplikationer.
	U. Användaren får inte feedback vid felaktiga inmatningar
	3. HTML validerar, användaren får feedback vid felaktiga inmatningar, tydlighet i hur applikationen skall användas
	4-5. Användaren får detaljerad feedback vid felaktiga inmatningar. Användaren får hjälp att inte göra fel

Designbarhet – Applikationens design vägs in.
	U. Applikationen saknar helt CSS
	3. Applikationen har en enkel design
	4. Applikationen kan på enkelt sätt designas om. Exempelvis genom att byta ut CSS-filer
	5. Applikationens design anpassad till designramverk exempelvis http://getbootstrap.com/

Säkerhet – Applikationens säkerhet bedöms
	U. Utvecklaren har inte tagit hänsyn till användarens och systemägarens säkerhet (Exempelvis lösenord i klartext)
	3. Mindre brister mot säkerheten kan hittas
	4-5. Inga allvarliga brister mot säkerheten kan hittas

Publik redovisning av applikationen
	U-3. Ingen publik redovisning krävs
	4. Studenten gör en ca 10 minuters redovisning
	5. Studenten gör en bra redovisning

Enskilt projekt
	U. Studenten har gjort projektet med någon annan
	U. Kod är kopierad/stulen utan tillbörlig källangivelse
	3-5. Studenten har producerat koden själv. Extern kod är angiven med källhänvisning och bibliotek ligger i utmärkt katalog ex. /vendors/

Projekt
-------------------
	Social network 
		Skicka meddelande
		Lägga till vänner 


	Bryggeri
		Med blogg
		Instagramconnection
			http://www.ibm.com/developerworks/library/x-instagram1/
		Facebook connection??? 
			Facebook flöde
		Full CRUD bloggposter
			Möjlighet till redigering i html?
				Känns som mycket javascript 
				http://css-tricks.com/give-designers-tools-get-need/

Beskrivning 
Blogg för ett bryggeri, användaren ska kunna uppdatera en blogg med hjälp av ett PHP gränssnitt. Full CRUD funktionallitet på inläggen.  
Bloggen visar också Instagram och Twitter flöde. 


Krav
------------
	Uppdatera med hjälp av Instagram
	Uppdatera Twitter
	Uppdatera Blog
	Snygg UX
	Göra inlägg
		med bilder??
		Blogginlägg och Instagram inlägg hamnar på samma sida


UC
------------
1. Logga in Autentisera
Main scenario
Starts when a user wants to authenticate.
System asks for username, password, and if system should save the user credentials
User provides username and password
System authenticates the user and presents that authentication succeeded

Alternate Scenarios
1. The system authenticates the user and presents that the authentication succeeded and that the user credentials was saved.
4a. User could not be authenticated
1. System presents an error message
2. Step 2 in main scenario

--Grund för nästan alla UC


2. Posta blogginlägg
Precondition
(UC 1 genomfört)

Main scenario
	1. UC.1 Logga in
	2. Välg Blogg sida
	3. Fyll i relevanta fällt
	4. Posta inlägg
	5. Bekräfta att inlägget uppdaterats 

Alternate Scenarios
	3.b Tagga inlägget
	5.b bekräfta att inlägget har korrekt tag


3. Redigera ett blogginlägg

4. Ta bort ett blogginlägg


5. Posta tweet
	1. Twitter.com
	2. Posta tweet
	3. Bekräfta att tweeten kan ses på bloggen den nya tweeten ska synas överst


6. Posta Instagrambild/text
	1. Logga in på Instagram.com
	2. Posta Inlägg
	3. Bloggen är uppdaterad med den nya instagram posten överst

7. Lika/dislika ett inlägg
	1. Surfa in på bloggen
	2. lika/dislika ett inlägg
	3. Räknaren uppdateras
	4. En ip adress kan endast lika en gång

8. Redigera hur ett inlägg ser ut med styckeindelning samt "media" bilder etc
9. Rediger sin Instgram nyckel via UI 
10. Rediger sin Twitter nyckel via UI 


