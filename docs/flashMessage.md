### Twig .. Layout_backend.html.twig

Im Twig File sind 3 Flash Messages hinterlegt.
1. Success
2. Warning
3. Failed
 

```
           {% block flashMessage %}
                {% if app.session.flashBag.has('success') %}
                    <div class="alert alert-success">
                        {% for msg in app.session.flashBag.get('success') %}
                            {{ msg }}
                        {% endfor %}
                    </div>
                {% endif %}
            {% endblock %}
````

### Controller

Im Controller Flash Message setzen

```
$request->getSession()
        ->getFlashBag()
        ->add('success', 'Das Passwort wurde erfolgreich geändert!')
        ;            
```