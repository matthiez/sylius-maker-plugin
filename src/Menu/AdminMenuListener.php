<?php

namespace Ecolos\SyliusMakerPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    /**
     * @param MenuBuilderEvent $event
     */
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $menu
            ->getChild('catalog')
            ->addChild('new-subitem')
            ->setLabel('Makers')
            ->setLabelAttribute('icon', 'registered')
            ->setUri('/admin/makers');
    }
}
