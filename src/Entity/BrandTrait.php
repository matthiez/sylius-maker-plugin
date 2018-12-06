<?php
declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Entity;

trait BrandTrait
{
    /**
     * @var Brand|null
     */
    protected $brand;

    public function getBrand(): ?Brand {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): void {
        $this->brand = $brand;
    }
}
