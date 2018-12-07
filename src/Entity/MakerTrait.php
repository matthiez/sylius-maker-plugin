<?php
declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Entity;

trait MakerTrait
{
    /**
     * @var Maker|null
     */
    protected $maker;

    public function getMaker(): ?Maker {
        return $this->maker;
    }

    public function setMaker(?Maker $maker): void {
        $this->maker = $maker;
    }
}
