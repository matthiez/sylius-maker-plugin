<?php
declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Sylius\Component\Resource\Model\AbstractTranslation;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @Entity
 * @Table(name="ecolos_maker_translation")
 */
class MakerTranslation extends AbstractTranslation implements ResourceInterface
{
    /**
     * @Column(type="integer")
     * @Id()
     * @GeneratedValue()
     * @var integer
     */
    private $id;

    /**
     * @Column(type="string", nullable=true)
     * @var string|null
     */
    private $description;

    /**
     * @Column(type="string", nullable=true)
     * @var string|null
     */
    private $address;

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
