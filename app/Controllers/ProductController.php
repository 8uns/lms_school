<?php

namespace App\Controllers;

use App\Core\Controller;

class ProductController extends Controller
{

    public function __construct()
    {
        return parent::__construct();
    }

    public function categories(string $productId, string $categoryId): void
    {
        echo "PRODUCT $productId, CATEGORY $categoryId";
    }
    public function componen(): void
    {
        $this->view('layouts/header');
        $this->view('layouts/componen');
        $this->view('layouts/footer');
    }
}
