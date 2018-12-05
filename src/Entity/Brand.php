<?php
declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;

class Brand implements ResourceInterface, TranslatableInterface, BrandInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    public function __construct() {
        $this->initializeTranslationsCollection();
    }

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    public function getId(): ?int {
        return $this->id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setSlug(string $slug): void {
        $this->slug = $slug;
    }

    public function getSlug(): ?string {
        return $this->slug;
    }

    public function setDescription(?string $description): void {
        $this->getTranslation()->setDescription($description);
    }

    public function getDescription(): ?string {
        return $this->getTranslation()->getDescription();
    }

    public function setAddress(?string $address): void {
        $this->getTranslation()->setAddress($address);
    }

    public function getAddress(): ?string {
        return $this->getTranslation()->getAddress();
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): BrandTranslation {
        return new BrandTranslation();
    }
}
