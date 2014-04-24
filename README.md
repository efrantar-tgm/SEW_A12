Terminvereinbarungssystem
=========================
Es soll ein kollaboratives Terminvereinbarungssystem (ähnlich wie Doodle) erstellt werden, in dem sich Benutzer koordinieren können. Folgende Anforderungen sollen dabei erfüllt werden:

Benutzer
o) Neue Benutzer können sich registrieren
o) Existierende Benutzer können sich einloggen
o) Man kann nach registrierten Benutzern im System suchen (über ihren Namen).
o) Ein Benutzer kann gleichzeitig ein Organisator und Teilnehmer sein.
o) Jeder Benutzer kann sich die Events, die er organisiert, oder Events, an denen er teilnimmt, anzeigen lassen.

Organisator
o) ist ein Benutzer, der Events mit Namen und mehreren Termin- und Zeitvorschlägen erstellt und die Einladungen an einige registrierte Benutzer schickt
o) darf den Namen, die Termine und Zeiten eines Events ändern, aber nur bevor sich einer der Benutzer zu dem Event angemeldet hat
o) darf neue Benutzer zu seinen Events zusätzlich einladen
o) darf eingeladene Benutzer wieder löschen, bevor sich diese zu dem Event angemeldet haben
o) darf die Events jederzeit löschen
o) darf zu seinen Events Kommentare posten
o) darf Kommentare zu seinen Events löschen (auch die von anderen Benutzern)
o) Nachdem sich alle Benutzer zu einer Einladung angemeldet haben, darf der Organisator einen fixen Termin festlegen.

Teilnehmer
o) wählt aus den vorgeschlagenen Terminen und Zeiten eines Events (eine Checkbox pro Zeitvorschlag reicht)
o) darf seine Wahl ändern, bis ein fixer Termin existiert
o) darf Kommentare zu Events, an denen er teilnimmt, posten

Notifications
o) Ein Teilnehmer wird über jede neue/editierte/gelöschte Eventeinladung notifiziert.
o) Weiters wird ein Teilnehmer notifiziert, sobald ein fixer Termin für ein Event festgelegt wird.
o) Ein Organisator wird notifiziert, sobald sich alle Teilnehmer zu einem seiner Events angemeldet haben.
o) Wenn ein Benutzer zur Zeit einer Notification offline ist, darf diese nicht verloren gehen. Der Benutzer bekommt alle seine versäumten Notifications, sobald er online kommt.

Events
o) es kann zwei Arten von Events geben
1) Events, bei denen sich die Teilnehmer auf (möglichst) einen Termin einigen sollen (Standardfall). Der Organisator legt letztendlich einen fixen Termin fest.
2) Events, bei denen jeweils nur ein Teilnehmer pro Termin erlaubt ist (z.B. für Elternsprechtag). Der Organisator muss jede Teilnehmer/Termin-Kombination fixieren.

Aufgabenstellung
----------------
Entwickeln Sie ein GUI-Programm, welches das Terminvereinbarungssystem realisiert. Bei der Abgabe müssen Sie die Aufgabe auf mindestens drei Rechnern (mit mehreren gleichzeitig gestarteten Clients) präsentieren.

Beim Starten des Programms müssen der gewünschte Benutzername und die Netzwerkadresse des Servers angegeben werden (kein Passwort erforderlich). Die Registrierung kann
automatisch bei der ersten Anmeldung erfolgen.

Achten Sie bei der Implementierung auf die transaktionale Sicherheit. Überlegen Sie sich Situationen, in denen z.B. ein Benutzer versucht, eine Terminwahl zu einem in der Zwischenzeit gelöschten Event zu realisieren. Ihr Programm sollte auf solche und ähnliche Situationen entsprechend reagieren.

Beachten Sie bei der Implementierung, dass die Kommentare in derselben Reihenfolge aufgelistet werden müssen, in der diese von den einzelnen Benutzern abgeschickt wurden.
Sie müssen sich auch Gedanken über die Persistenz der Informationen machen. Wenn die Serverinstanz herunterfährt, muss der gesamte Inhalt dauerhaft abgelegt worden sein.

Es reicht ein einfaches, aber funktionales GUI. Sie dafür Frameworks einsetzen.


Vorgehensweise
--------------
Es sind die Meta-Regeln zu beachten. Dabei ist zu beachten, dass nur durch eine obligatorische Design-Review durch die unterrichtenden Lehrkräfte, das gewählte Design (realisiert und vorgestellt mittels UML Diagrammen) verwendet werden darf. Nachträgliche Änderungen müssen durch einen Change-Request genehmigt werden. Diese müssen in eine Feature/Requirements Liste münden, die z.B. durch User-Stories definiert werden können. Zu bedenken sind auch nicht-funktionale Anforderungen an das System, wie z.B. die Anzeigegeschwindigkeit der ersten Termine und Kommentare.

Des weiteren sind Programmier-Teams verpflichtend. Diese sind durch eine/n Tester/in und eine/n Programmierer/in definiert. Angenommene Tasks der einzelnen Stories werden gleichzeitig(!) vom Tester und Programmierer behandelt, wobei der Tester die Anforderungen in z.B. Unit-Tests und der Programmierer in den entsprechenden Codeteilen implementiert. Dabei soll sichergestellt sein, dass sofort geeignete Testfälle den gerade eben implementierten Code auf dessen Funktionstüchtigkeit überprüfen.

Integrations- und Systemtests sind verpflichtend. Dabei sind in diesem Fall auch automatisierte GUI-Tests zu verwirklichen. Der Testbericht im Protokoll muss auch eine kontinuierliche Verbesserung der zu erzielenden Storypoints ersichtlich machen.

Termine:
-------

8.5.2014 AdS: Design Review - Deadline für Design der Applikation!
4.6.2014 23:55: Deadline Abgabe (fix - keine Verlängerung möglich!)
5.6.2014: Abnahme Interview (15min / Gruppe)

Dazwischen müssen die Teamleader wöchentlich einen Reviewtermin selbstständig wahrnehmen.

Bewertungskriterien:
-------

Dokumentation:
Design:
Implementierung:
Funktionalität:
Tests/System: