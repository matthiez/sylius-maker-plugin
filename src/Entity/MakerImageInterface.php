<?php
declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Entity;

use Sylius\Component\Core\Model\ImageInterface;

interface MakerImageInterface extends ImageInterface, MakerAwareInterface
{
}
