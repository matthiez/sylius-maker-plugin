<?php
declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Entity;

use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

trait MakerTrait
{
    /**
     * @OneToOne(targetEntity="Ecolos\SyliusMakerPlugin\Entity\Maker")
     * @var Maker|null
     */
    protected $maker;

    public function getMaker(): ?Maker
    {
        return $this->maker;
    }

    public function setMaker(?Maker $maker): void
    {
        $this->maker = $maker;
    }
}
