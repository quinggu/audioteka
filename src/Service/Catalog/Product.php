<?php

namespace App\Service\Catalog;

use DateTime;

interface Product
{
    public function getId(): string;
    public function getName(): string;
    public function setName(): \App\Entity\Product;
    public function getPrice(): int;
    public function setPrice(): \App\Entity\Product;
    public function getCreatedAt(): DateTime;
}
