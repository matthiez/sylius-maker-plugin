<?php

declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Service;

use Ecolos\SyliusMakerPlugin\Entity\MakerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Product\Generator\SlugGenerator;

class SlugifyMakers
{
    private const BATCH_SIZE = 20;

    /** @var EntityRepository */
    private $makerRepository;

    /** @var EntityManagerInterface */
    private $makerManager;

    /** @var array $messages */
    private $messages = [];

    public function __construct(
        EntityRepository $makerRepository,
        ObjectManager $makerManager
    ) {
        $this->makerRepository = $makerRepository;
        $this->makerManager = $makerManager;
    }

    /**
     * @return array
     */
    public function slugify(): array {
        try {
            $i = 1;

            /** @var MakerInterface $maker */
            foreach ($this->makerRepository->findAll() as $maker) {
                try {
                    ++$i;

                    if (null === $maker->getSlug()) {
                        $maker->setSlug((new SlugGenerator)->generate($maker->getName()));

                        if (!$this->makerManager->isOpen()) {
                            throw new \Exception('MakerManager is not ready.');

                            break;
                        }

                        $this->makerManager->persist($maker);

                        if (($i % self::BATCH_SIZE) === 0) $this->makerManager->flush();

                        $this->messages[] = 'Slug' . $maker->getSlug() . ' created.';
                    }
                }
                catch (\Exception $ex) {
                    $this->messages[] = $ex;
                }
            }

            $this->makerManager->flush();

            $this->makerManager->clear();
        }
        catch (\Exception $ex) {
            $this->messages[] = $ex;
        }

        return $this->messages;
    }
}
