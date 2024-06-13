<?php

namespace App\Service\CartProducts;

use App\Service\Catalog\Product;

interface CartProducts
{
    public function getProductCounter(): int;

    public function setProductCounter(int $productCounter): \App\Entity\CartProducts;

    public function getProduct(): Product;
}
