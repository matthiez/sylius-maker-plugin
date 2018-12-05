<?php
declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Entity;

use Sylius\Component\Resource\Model\AbstractTranslation;
use Sylius\Component\Resource\Model\ResourceInterface;

class BrandTranslation extends AbstractTranslation implements ResourceInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $address;

    public function getId(): int {
        return $this->id;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(string $description): self {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function setAddress(string $address): self {
        $this->address = $address;

        return $this;
    }
}
