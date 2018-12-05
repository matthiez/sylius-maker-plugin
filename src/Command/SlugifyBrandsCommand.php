<?php

declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Command;

use Ecolos\SyliusBrandPlugin\Service\SlugifyBrands;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class SlugifyBrandsCommand extends ContainerAwareCommand
{
    protected function configure() {
        $this->setHidden(false)
            ->setName('ecolos:slugify_brands')
            ->setDescription('Adds a slug to each brand from its name.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void {
        /** @var SlugifyBrands $slugifyBrands */
        $slugifyBrands = $this->getContainer()->get('Ecolos\SyliusBrandPlugin\Service\SlugifyBrands');

        $output->writeln(var_dump($slugifyBrands->slugify()));
    }
}
