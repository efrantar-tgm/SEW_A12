Terminvereinbarungssystem
=========================
Es soll ein kollaboratives Terminvereinbarungssystem (�hnlich wie Doodle) erstellt werden, in dem sich Benutzer koordinieren k�nnen. Folgende Anforderungen sollen dabei erf�llt werden:

Benutzer
o) Neue Benutzer k�nnen sich registrieren
o) Existierende Benutzer k�nnen sich einloggen
o) Man kann nach registrierten Benutzern im System suchen (�ber ihren Namen).
o) Ein Benutzer kann gleichzeitig ein Organisator und Teilnehmer sein.
o) Jeder Benutzer kann sich die Events, die er organisiert, oder Events, an denen er teilnimmt, anzeigen lassen.

Organisator
o) ist ein Benutzer, der Events mit Namen und mehreren Termin- und Zeitvorschl�gen erstellt und die Einladungen an einige registrierte Benutzer schickt
o) darf den Namen, die Termine und Zeiten eines Events �ndern, aber nur bevor sich einer der Benutzer zu dem Event angemeldet hat
o) darf neue Benutzer zu seinen Events zus�tzlich einladen
o) darf eingeladene Benutzer wieder l�schen, bevor sich diese zu dem Event angemeldet haben
o) darf die Events jederzeit l�schen
o) darf zu seinen Events Kommentare posten
o) darf Kommentare zu seinen Events l�schen (auch die von anderen Benutzern)
o) Nachdem sich alle Benutzer zu einer Einladung angemeldet haben, darf der Organisator einen fixen Termin festlegen.

Teilnehmer
o) w�hlt aus den vorgeschlagenen Terminen und Zeiten eines Events (eine Checkbox pro Zeitvorschlag reicht)
o) darf seine Wahl �ndern, bis ein fixer Termin existiert
o) darf Kommentare zu Events, an denen er teilnimmt, posten

Notifications
o) Ein Teilnehmer wird �ber jede neue/editierte/gel�schte Eventeinladung notifiziert.
o) Weiters wird ein Teilnehmer notifiziert, sobald ein fixer Termin f�r ein Event festgelegt wird.
o) Ein Organisator wird notifiziert, sobald sich alle Teilnehmer zu einem seiner Events angemeldet haben.
o) Wenn ein Benutzer zur Zeit einer Notification offline ist, darf diese nicht verloren gehen. Der Benutzer bekommt alle seine vers�umten Notifications, sobald er online kommt.

Events
o) es kann zwei Arten von Events geben
1) Events, bei denen sich die Teilnehmer auf (m�glichst) einen Termin einigen sollen (Standardfall). Der Organisator legt letztendlich einen fixen Termin fest.
2) Events, bei denen jeweils nur ein Teilnehmer pro Termin erlaubt ist (z.B. f�r Elternsprechtag). Der Organisator muss jede Teilnehmer/Termin-Kombination fixieren.

Aufgabenstellung
----------------
Entwickeln Sie ein GUI-Programm, welches das Terminvereinbarungssystem realisiert. Bei der Abgabe m�ssen Sie die Aufgabe auf mindestens drei Rechnern (mit mehreren gleichzeitig gestarteten Clients) pr�sentieren.

Beim Starten des Programms m�ssen der gew�nschte Benutzername und die Netzwerkadresse des Servers angegeben werden (kein Passwort erforderlich). Die Registrierung kann
automatisch bei der ersten Anmeldung erfolgen.

Achten Sie bei der Implementierung auf die transaktionale Sicherheit. �berlegen Sie sich Situationen, in denen z.B. ein Benutzer versucht, eine Terminwahl zu einem in der Zwischenzeit gel�schten Event zu realisieren. Ihr Programm sollte auf solche und �hnliche Situationen entsprechend reagieren.

Beachten Sie bei der Implementierung, dass die Kommentare in derselben Reihenfolge aufgelistet werden m�ssen, in der diese von den einzelnen Benutzern abgeschickt wurden.
Sie m�ssen sich auch Gedanken �ber die Persistenz der Informationen machen. Wenn die Serverinstanz herunterf�hrt, muss der gesamte Inhalt dauerhaft abgelegt worden sein.

Es reicht ein einfaches, aber funktionales GUI. Sie daf�r Frameworks einsetzen.


Vorgehensweise
--------------
Es sind die Meta-Regeln zu beachten. Dabei ist zu beachten, dass nur durch eine obligatorische Design-Review durch die unterrichtenden Lehrkr�fte, das gew�hlte Design (realisiert und vorgestellt mittels UML Diagrammen) verwendet werden darf. Nachtr�gliche �nderungen m�ssen durch einen Change-Request genehmigt werden. Diese m�ssen in eine Feature/Requirements Liste m�nden, die z.B. durch User-Stories definiert werden k�nnen. Zu bedenken sind auch nicht-funktionale Anforderungen an das System, wie z.B. die Anzeigegeschwindigkeit der ersten Termine und Kommentare.

Des weiteren sind Programmier-Teams verpflichtend. Diese sind durch eine/n Tester/in und eine/n Programmierer/in definiert. Angenommene Tasks der einzelnen Stories werden gleichzeitig(!) vom Tester und Programmierer behandelt, wobei der Tester die Anforderungen in z.B. Unit-Tests und der Programmierer in den entsprechenden Codeteilen implementiert. Dabei soll sichergestellt sein, dass sofort geeignete Testf�lle den gerade eben implementierten Code auf dessen Funktionst�chtigkeit �berpr�fen.

Integrations- und Systemtests sind verpflichtend. Dabei sind in diesem Fall auch automatisierte GUI-Tests zu verwirklichen. Der Testbericht im Protokoll muss auch eine kontinuierliche Verbesserung der zu erzielenden Storypoints ersichtlich machen.

Termine:
-------

8.5.2014 AdS: Design Review - Deadline f�r Design der Applikation!
4.6.2014 23:55: Deadline Abgabe (fix - keine Verl�ngerung m�glich!)
5.6.2014: Abnahme Interview (15min / Gruppe)

Dazwischen m�ssen die Teamleader w�chentlich einen Reviewtermin selbstst�ndig wahrnehmen.

Bewertungskriterien:
-------

Dokumentation:
Design:
Implementierung:
Funktionalit�t:
Tests/System: