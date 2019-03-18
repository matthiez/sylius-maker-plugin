<?php
declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Entity;

interface MakerInterface
{
    public function getId(): ?int;

    public function setName(string $name): void;

    public function getName(): ?string;

    public function setDescription(?string $description): void;

    public function getDescription(): ?string;

    public function setAddress(?string $address): void;

    public function getAddress(): ?string;

    public function setSlug(string $slug): void;

    public function getSlug(): ?string;
}
