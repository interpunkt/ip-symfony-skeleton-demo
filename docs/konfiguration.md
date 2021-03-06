In der parameters.yml und parameters_dev.yml Datenbank Settings eintragen.

### config.yml

```

imports:
    - { resource: parameters.yml }
    - { resource: security.yml }
    - { resource: services.yml }

# Put parameters here that don't need to change on each machine where the app is deployed
# http://symfony.com/doc/current/best_practices/configuration.html#application-related-configuration
parameters:
    locale: de

framework:
    #esi:             ~
    translator: ~
    secret:          "%secret%"
    router:
        resource: "%kernel.root_dir%/config/routing.yml"
        strict_requirements: ~
    form:            ~
    csrf_protection: ~
    validation:      { enable_annotations: true }
    #serializer:      { enable_annotations: true }
    templating:
        engines: ['twig']
        #assets_version: SomeVersionScheme
    default_locale:  "%locale%"
    trusted_hosts:   ~
    trusted_proxies: ~
    session:
        # handler_id set to null will use default session handler from php.ini
        handler_id:  ~
    fragments: { path: /_fragment }
    http_method_override: true

# Twig Configuration
twig:
    debug:            "%kernel.debug%"
    strict_variables: "%kernel.debug%"
    form:
            resources: ['bootstrap_3_layout.html.twig']

# Assetic Configuration
assetic:
    debug:          "%kernel.debug%"
    use_controller: false
    bundles:        [ ]
    #java: /usr/bin/java
    filters:
        cssrewrite: ~
        lessphp:
                            apply_to: "\.less$"
                            # Formatter options: compressed, lessjs, classic
                            formatter: "compressed"
                            preserve_comments: false
                            presets:
                                my_variable: "#000"
        #closure:
        #    jar: "%kernel.root_dir%/Resources/java/compiler.jar"
        #yui_css:
        #    jar: "%kernel.root_dir%/Resources/java/yuicompressor-2.4.7.jar"

# Doctrine Configuration
doctrine:
    dbal:
        driver:   pdo_mysql
        host:     "%database_host%"
        port:     "%database_port%"
        dbname:   "%database_name%"
        user:     "%database_user%"
        password: "%database_password%"
        charset:  UTF8
        # if using pdo_sqlite as your database driver:
        #   1. add the path in parameters.yml
        #     e.g. database_path: "%kernel.root_dir%/data/data.db3"
        #   2. Uncomment database_path in parameters.yml.dist
        #   3. Uncomment next line:
        #     path:     "%database_path%"

    orm:
        entity_managers:
                    default:
                        mappings:
                            FOSUserBundle: ~
                            DevProadminBundle: ~
                            DevProinterpunktBundle: ~
# Swiftmailer Configuration
swiftmailer:
    transport: "%mailer_transport%"
    host:      "%mailer_host%"
    username:  "%mailer_user%"
    password:  "%mailer_password%"
    spool:     { type: memory }
    disable_delivery:  true

services:
    twig.text_extension:
        class: Twig_Extensions_Extension_Text
        tags:
            - name: twig.extension

fos_user:
    db_driver: orm # other valid values are 'mongodb', 'couchdb' and 'propel'
    firewall_name: main
    user_class: DevPro\adminBundle\Entity\User
    from_email:
            address:        webmaster@example.com
            sender_name:    webmaster
    resetting:
            token_ttl: 86400
            email:
                from_email: # Use this node only if you don't want the global email address for the resetting email
                    address:        info@inter-punkt.ch
                    sender_name:    Webmaster
                template:   FOSUserBundle:Resetting:email.txt.twig
            form:
                type:               FOS\UserBundle\Form\Type\ResettingFormType # or 'fos_user_resetting' on Symfony < 2.8
                name:               fos_user_resetting_form
                validation_groups:  [ResetPassword, Default]
    service:
            mailer:                 fos_user.mailer.default
            email_canonicalizer:    fos_user.util.canonicalizer.default
            username_canonicalizer: fos_user.util.canonicalizer.default
            token_generator:        fos_user.util.token_generator.default
            user_manager:           fos_user.user_manager.default
    change_password:
            form:
                validation_groups: [myChangePassword]

jms_translation:
    configs:
        app:
            dirs: [%kernel.root_dir%, %kernel.root_dir%/../src]
            output_dir: %kernel.root_dir%/Resources/translations
            ignored_domains: [routes]
            excluded_names: ["*TestCase.php", "*Test.php"]
            excluded_dirs: [cache, data, logs]
            extractors: [jms_i18n_routing]

jms_i18n_routing:
    default_locale: de
    locales: [de, en]
    strategy: prefix_except_default

vich_uploader:
    db_driver: orm
    mappings:
        imageupload_image:
            uri_prefix:         /img/uploads
            upload_destination: %kernel.root_dir%/../web/assets/img/uploads
            namer:              vich_uploader.namer_origname

            inject_on_load:     false
            delete_on_update:   false
            delete_on_remove:   false

knp_paginator:
    page_range: 5                      # default page range used in pagination control
    default_options:
        page_name: page                # page query parameter name
        sort_field_name: sort          # sort field query parameter name
        sort_direction_name: direction # sort direction query parameter name
        distinct: true                 # ensure distinct results, useful when ORM queries are using GROUP BY statements
    template:
        pagination: KnpPaginatorBundle:Pagination:twitter_bootstrap_v3_pagination.html.twig     # sliding pagination controls template
sortable: KnpPaginatorBundle:Pagination:sortable_link.html.twig # sort link template
```

### parameters_dev.yml

```
# Dev YAML For Local deployment
parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: skeleton
    database_user: root
    database_password: null
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
secret: UxHGsDwEEoo35GsZu
```

### parameters.yml

Beispiel von "yetnet-praesidentenlogin" Produktiv auf Testserver

```
# This file is auto-generated during the composer install
parameters:
    database_host: db55.netzone.ch
    database_port: null
    database_name: interpunkttes3
    database_user: interpunkttes3
    database_password: interpunkttes3
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: ThisTokenIsNotSoSecretChangeIt
```
