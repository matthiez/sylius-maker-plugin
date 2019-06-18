<?php
declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Entity;

interface MakerAwareInterface
{
    /**
     * @return MakerInterface|null
     */
    public function getMaker(): ?MakerInterface;
    /**
     * @param MakerInterface|null $maker
     */
    public function setMaker(?MakerInterface $maker): void;
}