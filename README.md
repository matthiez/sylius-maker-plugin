1. modify composer.json:
            {
                "repositories": [
                    {
                        "type": "vcs",
                        "url":  "git@github.com:arivelox/sylius-maker-plugin.git"
                    }
                ],
                "require": {
                    "ecolos/sylius-brand-plugin": "dev-master"
                }
            }


2. run composer update

3. configure vich-uploader
       https://github.com/dustin10/VichUploaderBundle/blob/master/Resources/doc/installation.md#user-content-choose-and-configure-a-persistence-engine

4. add to config/bundles.php
        [
            Ecolos\SyliusBrandPlugin\EcolosSyliusBrandPlugin::class => ['all' => true]
            Vich\UploaderBundle\VichUploaderBundle::class => ['all' => true]
        ]

5. run php bin/console cache:clear

6. run php bin/console doctrine:migrations:diff



