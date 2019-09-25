# INSTALLATION:

1. Add Github repository to composer.json:
    ```Add repository from Github
                {
                    "repositories": [
                        {
                            "type": "vcs",
                            "url":  "git@bitbucket.org:ecolos/sylius-maker-plugin.git"
                        }
                    ]
                }
    ```

2. Install package via composer from Github 
    ```console
    composer require ecolos/sylius-maker-plugin
    ```

3. Configure vich-uploader package
       see https://github.com/dustin10/VichUploaderBundle/blob/master/Resources/doc/installation.md#user-content-choose-and-configure-a-persistence-engine

4. Add to config/bundles.php
    ```php
            [
                Ecolos\SyliusMakerPlugin\EcolosSyliusMakerPlugin::class => ['all' => true]
                Vich\UploaderBundle\VichUploaderBundle::class => ['all' => true]
            ]
    ```

5. Clear the symfony cache
    ```console
    php bin/console cache:clear
    ```

6.  Determine doctrine schema changes and migrate
    ```console
    php bin/console doctrine:migrations:diff
    php bin/console doctrine:migrations:execute --up XXXXXXXXXXXXX
    ```

7. Set configs

    Add to config/routes.yaml
    ```yaml
    ecolos_sylius_maker_plugin:
        resource: "@EcolosSyliusMakerPlugin/Resources/config/routing.yaml"
    ```

    Edit config/services.yml
    ```yaml
    imports:
        - { resource: "@EcolosSyliusMakerPlugin/Resources/config/config.yaml" }
    ```
    
    Add to config/packages/_sylius.yml
    ```yaml
    imports:
        - { resource: "@EcolosSyliusMakerPlugin/Resources/config/_sylius.yaml" }
    ```
    
    Add to config/packages/doctrine.yml
    ```yaml
        doctrine:
            orm:
                mappings:
                    EcolosSyliusMakerPlugin:
                        is_bundle: true
                        type: yml
                        dir: '/Resources/config/doctrine'
    ```

8. Edit src/Entity/Product.php
    ```php
    namespace App\Entity;
    use Ecolos\SyliusMakerPlugin\Entity\MakerTrait;
    use Sylius\Component\Core\Model\Product as BaseProduct;
    class Product extends BaseProduct { use MakerTrait; }
    ``` 

# USAGE:
```html
<a href="{{ path('ecolos_sylius_maker_plugin_list') }}">{{ 'ecolos_sylius_maker_plugin.makers'|trans }}</a>
``` 
... or simply visit /brands (for "en" locale - use /marken for "de" locale)

# TOOLS:
    - Command ecolos:slugify_makers
        Creates a slug from entity.name

# TODO
    - Add tests

