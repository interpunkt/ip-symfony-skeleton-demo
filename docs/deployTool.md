# Deploy Tool

Als Deploy Tool wird Capifony verwendet.

## Require
1. Ruby
2. Capistrano
3. Capifony

## Use

#### Testserver

Auf dem Netzone Testserver die Subdomain anlegen. Root Ziel im Netzone Panel ist der Path: 
```
"htdocs/url/current/web"
```

#### Konsole

Vor dem Setup in der parameters.yml die Netzone Verbindungsdaten  hinterlegen.

Einmalig in der Konsole das Setup aufrufen. 
```
cap deploy:setup
```

Assetic ausführen für min Files.
```
php app/console assetic:dump --env=prod --no-debug
```

## Deploy
1.
Mit dem nachfolgenden Befehl kann Release auf dem Testserver gepushed werden.
```
cap deploy
```

2. assets/vendor
Das DevTool kann auf dem Bower nicht ausführen, daher muss der "assets/vendor" Folder via FTP in das 1. Release 
hochgeladen werden.

3.
Eure Datenbank am besten Manuel in PHPMyAdmin auf dem Testserver einspielen.