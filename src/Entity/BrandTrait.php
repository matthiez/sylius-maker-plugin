<?php
declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Form\Extension;

use Ecolos\SyliusBrandPlugin\Entity\Brand;

trait BrandTrait
{
    /**
     * @var Brand|null
     */
    private $brand;

    public function getBrand(): ?Brand {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): void {
        $this->brand = $brand;
    }
}
