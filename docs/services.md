Damit wir einen Service im Controller z.B. ansprechen können muss dieser in der Service.yml registriert werden. 


### Service registrieren
```
# Learn more about services, parameters and containers at
# http://symfony.com/doc/current/book/service_container.html
parameters:
#    parameter_name: value
services:
#    service_name:
#        class: AppBundle\Directory\ClassName
#        arguments: ["@another_service_name", "plain_value", "%parameter_name%"]
```

Danach können wir uns den Service holen über
```
$this->get('service_name')
```