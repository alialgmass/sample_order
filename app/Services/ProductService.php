<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getAllProducts($pagination)
    {
        return Product::pagenate($pagination);
    }
}
