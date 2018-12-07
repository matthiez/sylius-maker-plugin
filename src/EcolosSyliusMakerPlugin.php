<?php

declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;

final class EcolosSyliusMakerPlugin extends Bundle
{
    use SyliusPluginTrait;
}
