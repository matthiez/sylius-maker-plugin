<?php
declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Command;

use Ecolos\SyliusMakerPlugin\Service\SlugifyMakers;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class SlugifyMakersCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setHidden(false)
            ->setName('ecolos:slugify_makers')
            ->setDescription('Adds a slug to each maker from its name.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        /** @var SlugifyMakers $slugifyMakers */
        $slugifyMakers = $this->getContainer()->get('Ecolos\SyliusMakerPlugin\Service\SlugifyMakers');

        $output->writeln(var_dump($slugifyMakers->slugify()));
    }
}
