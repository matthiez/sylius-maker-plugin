<?php
declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Core\Model\ImagesAwareInterface;

class Brand implements ResourceInterface, TranslatableInterface, BrandInterface, ImagesAwareInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    public function __construct() {
        $this->initializeTranslationsCollection();

        $this->images = new ArrayCollection();

        $this->addImage(new BrandImage());
    }

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection|ImageInterface[]
     */
    protected $images;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $slug;

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
    public function getImages(): Collection {
        return $this->images;
    }

    /**
     * {@inheritdoc}
     */
    public function getImagesByType(string $type): Collection {
        return $this->images->filter(function (ImageInterface $image) use ($type) {
            return $type === $image->getType();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function hasImages(): bool {
        return !$this->images->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function hasImage(ImageInterface $image): bool {
        return $this->images->contains($image);
    }

    /**
     * {@inheritdoc}
     */
    public function addImage(ImageInterface $image): void {
        $image->setOwner($this);
        $this->images->add($image);
    }

    /**
     * {@inheritdoc}
     */
    public function removeImage(ImageInterface $image): void {
        if ($this->hasImage($image)) {
            $image->setOwner(null);
            $this->images->removeElement($image);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): BrandTranslation {
        return new BrandTranslation();
    }
}
