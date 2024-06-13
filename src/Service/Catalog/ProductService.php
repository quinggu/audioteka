<?php

namespace App\Service\Catalog;

interface ProductService
{
    public function add(string $name, int $price): Product;

    public function edit(string $id, string $name = '', int $price = 0);

    public function remove(string $id): void;
}