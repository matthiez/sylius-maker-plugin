<?php

namespace Ecolos\SyliusBrandPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    /**
     * @param MenuBuilderEvent $event
     */
    public function addAdminMenuItems(MenuBuilderEvent $event): void {
        $menu = $event->getMenu();

        $menu
            ->getChild('catalog')
            ->addChild('new-subitem')
            ->setLabel('Brands')
            ->setLabelAttribute('icon', 'registered')
            ->setUri('/admin/brands');
    }
}
