### Docs
https://github.com/cocur/slugify

### Basic Usage

#### Controller

```
$slug = $this->get('slugify')->slugify('Hello World!');
```

#### config.yml
You can set the following configuration settings in app/config.yml to adjust the slugify service:

```
cocur_slugify:
    lowercase: <boolean>
    separator: <string>
    regexp: <string>
    rulesets: { }
```

#### Twig

```
{{ 'Hällo Wörld'|slugify }}
```