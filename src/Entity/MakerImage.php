<?php

declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Table;
use Sylius\Component\Core\Model\Image;

/**
 * @Entity
 * @Table(name="ecolos_maker_image")
 */
class MakerImage extends Image
{
    /**
     * @ManyToOne(targetEntity="Ecolos\SyliusMakerPlugin\Entity\Maker", inversedBy="images")
     * @JoinColumn(name="owner_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * @var MakerInterface
     */
    protected $owner;
}
