<?php
declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Entity;

use Sylius\Component\Core\Model\Product;

class ProductInterface extends Product
{
    use MakerTrait;
}