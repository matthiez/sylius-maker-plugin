#INSTALLATION:

1. modify composer.json:
            {
                "repositories": [
                    {
                        "type": "vcs",
                        "url":  "git@github.com:ECOLOS-DE/sylius-maker-plugin.git"
                    }
                ],
                "require": {
                    "ecolos/sylius-maker-plugin": "dev-master"
                }
            }


2. run composer update

3. configure vich-uploader
       https://github.com/dustin10/VichUploaderBundle/blob/master/Resources/doc/installation.md#user-content-choose-and-configure-a-persistence-engine

4. add to config/bundles.php
        [
            Ecolos\SyliusMakerPlugin\EcolosSyliusMakerPlugin::class => ['all' => true]
            Vich\UploaderBundle\VichUploaderBundle::class => ['all' => true]
        ]

5. run php bin/console cache:clear

6. run php bin/console doctrine:migrations:diff

7. edit config/packages/doctrine.yml
    doctrine:
        orm:
            mappings:
                EcolosSyliusMakerPlugin:
                    is_bundle: true
                    type: yml
                    dir: '/Resources/config/doctrine'
                    
8. edit src/Entity/Product.php
    <?php
    declare(strict_types=1);
    namespace App\Entity;
    use Ecolos\SyliusMakerPlugin\Entity\MakerTrait;
    use Sylius\Component\Core\Model\Product as BaseProduct;
    class Product extends BaseProduct { use MakerTrait; }


#USAGE:
     <a href="{{ path('ecolos_sylius_maker_plugin_list') }}">
     {{ 'ecolos_sylius_maker_plugin.makers'|trans }}
     </a> or visit /brands

#TOOLS:
- Command ecolos:slugify_makers
    - Creates a slug from entity.name



