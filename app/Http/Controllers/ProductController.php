<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function show()
    {
        $id = 1;
        $produk = "Laptop HP";

        return view('list_product', compact('id', 'produk'));
    }
}
