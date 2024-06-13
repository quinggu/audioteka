<?php

namespace App\Service\Cart;

use App\Service\Catalog\Product;

interface Cart
{
    public function getId(): string;
    public function getTotalPrice(): int;
    public function isFull(): bool;
    /**
     * @return Product[]
     */
    public function getCartProducts(): iterable;

    public function hasProduct(\App\Entity\Product $product): bool;

    public function addProduct(\App\Entity\Product $product): void;

    public function removeProduct(\App\Entity\Product $product): void;
}
