<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 20.11.18
 * Time: 11:21
 */

namespace Ecolos\SyliusBrandPlugin\Entity;

interface BrandInterface
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
