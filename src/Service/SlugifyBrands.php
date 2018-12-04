<?php

declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Service;

use App\Entity\BrandInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Product\Generator\SlugGenerator;

class SlugifyBrands
{
    private const BATCH_SIZE = 20;

    /** @var EntityRepository */
    private $brandRepository;

    /** @var EntityManagerInterface */
    private $brandManager;

    /** @var array $messages */
    private $messages = [];

    public function __construct(
        EntityRepository $brandRepository,
        ObjectManager $brandManager
    ) {
        $this->brandRepository = $brandRepository;
        $this->brandManager = $brandManager;
    }

    /**
     * @return array
     */
    public function slugify(): array {
        try {
            $i = 1;

            /** @var BrandInterface $brand */
            foreach ($this->brandRepository->findAll() as $brand) {
                try {
                    ++$i;

                    if (null === $brand->getSlug()) {
                        $brand->setSlug((new SlugGenerator)->generate($brand->getName()));

                        if (!$this->brandManager->isOpen()) {
                            throw new \Exception('BrandManager nicht bereit.');

                            break;
                        }

                        $this->brandManager->persist($brand);

                        if (($i % self::BATCH_SIZE) === 0) $this->brandManager->flush();

                        $this->messages[] = 'Slug' . $brand->getSlug() . ' erstellt.';
                    }
                }
                catch (\Exception $ex) {
                    $this->messages[] = $ex;
                }
            }

            $this->brandManager->flush();

            $this->brandManager->clear();
        }
        catch (\Exception $ex) {
            $this->messages[] = $ex;
        }

        return $this->messages;
    }
}
