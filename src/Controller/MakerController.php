<?php

declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Controller;

use Ecolos\SyliusMakerPlugin\Entity\MakerInterface;
use Ecolos\SyliusMakerPlugin\Repository\MakerRepositoryInterface;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

final class MakerController
{
    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @param EngineInterface $templatingEngine
     */
    public function __construct(EngineInterface $templatingEngine, EntityRepository $makerRepository, ProductRepositoryInterface $productRepository) {
        $this->templatingEngine = $templatingEngine;
        $this->makerRepository = $makerRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function showAction(Request $request): Response {
        $slug = $request->attributes->get("slug");

        /**
         * @var MakerInterface $maker
         */
        $maker = $this->makerRepository->findOneBy(["slug" => $slug]);

        $products = $this->productRepository->findBy(["maker" => $maker->getId()]);

        return $this->templatingEngine->renderResponse(
            '@EcolosSyliusMakerPlugin/Maker/show.html.twig',
            [
                "maker" => $maker,
                "products" => $products
            ]
        );
    }
}
