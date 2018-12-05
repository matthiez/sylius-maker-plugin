<?php

declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;

final class EcolosSyliusBrandPlugin extends Bundle
{
    use SyliusPluginTrait;
}
