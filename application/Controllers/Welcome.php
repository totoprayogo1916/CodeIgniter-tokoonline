<?php

namespace App\Controllers;

use App\Models\Product;
use Totoprayogo\Lib\Cart;

class Welcome extends BaseController
{
    public function index(): string
    {
        $modelProduct = new Product();

        $data['products'] = $modelProduct->findAll();

        return view('welcome_message', $data);
    }

    public function add_to_cart($product_id)
    {
        $modelProduct = new Product();
        $cart         = new Cart();

        $product = $modelProduct->find($product_id);
        $data    = [
            'id'    => $product->id,
            'qty'   => 1,
            'price' => $product->price,
            'name'  => $product->name,
        ];

        $cart->insert($data);

        return redirect()->to('/');
    }

    public function cart()
    {
        // displays what currently inside the cart
        // print_r($this->cart->contents());
        return view('show_cart');
    }

    public function clear_cart()
    {
        $cart = new Cart();

        $cart->destroy();

        return redirect()->to('/');
    }
}

// End of file welcome.php
// Location: ./application/controllers/welcome.php
