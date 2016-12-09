# Deploy Tool

Als Deploy Tool wird Capifony verwendet.

## Require
1. Ruby
2. Capistrano
3. Capifony

## Use

#### Testserver

Auf dem Netzone Testserver die Subdomain anlegen. Root Ziel im Netzone Panel ist der Path 

"htdocs/url/current/web"

#### Konsole

Einmalig in der Konsole das Setup aufrufen. 
```
cap deploy:setup
```

## Deploy

```
cap deploy
```