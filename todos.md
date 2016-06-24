Eine einfache todoliste für die Skeleton Anwendung. Ausführlicher im Jira vorhanden.

Offene Fragen

### Benutzerverwaltung / UserBundle
- Sollten eine Update Funktionalität nur für den Core vorhanden sein oder allgemein.
- Benutzerverwaltung ist in sogut wie jeden Produkt vorhanden, hier sollte noch über genaue Features diskutiert
  werden.
- Soll das Modul Benutzerverwaltung ein Passwort Reset per Default und E-Mail entsprechend gesendet werden.
- Soll der Administrator Benutzer editieren können -> Kann er Passwörter neu setzen können? Ist eigentlich schlecht,
besser wäre hier das der Benutzer eine E-Mail mit einem zufällig generierten Passwort zugesendet bekommt und man nur sein 
eigenes Passwort und Profil ändern kann. Wenn man sein Passwort ändern kann welche sollten gewisse Sicherheitsfeatures 
beachtet werden. Mindestlänge des Passworts, hier schlage ich mindestens 6 Zeichen vor. Weiter soll eine Passwortstärke 
beim ändern angezeigt werden?
Soll das UserBundle als eigenes Bundle laufen oder im Core integiert werden?

### Versions / Update Bundle
Hier muss noch das Handling mit Fabian besprochen werden. Die Page auf der anderen Seite kann grundsätzlich schon gebaut 
werden. Hier wird ein Sublink angelegt
- updateskeleton@interpunkt-test.ch
Api Token anlegen. Aktuelle Version festlegen und Json Response ausführen.
