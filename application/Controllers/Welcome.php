<?php

namespace App\Controllers;

use App\Models\Product;
use CodeIgniter\HTTP\RedirectResponse;
use Totoprayogo\Lib\Cart;

class Welcome extends BaseController
{
    /**
     * Display a list of all products.
     */
    public function index(): string
    {
        $modelProduct     = new Product();
        $data['title'] = 'Front-End Toko Online';
        $data['products'] = $modelProduct->findAll();

        return view('welcome_message', $data);
    }

    /**
     * Adds a product to the cart
     *
     * @param int $product_id The ID of the product to add to the cart
     */
    public function add_to_cart(int $product_id): RedirectResponse
    {
        // Instantiate a Product model and a Cart object
        $modelProduct = new Product();
        $cart         = new Cart();

        // Get the product by ID
        $product = $modelProduct->find($product_id);

        // Prepare the data to insert into the cart
        $data = [
            'id'    => $product->id,
            'qty'   => 1,
            'price' => $product->price,
            'name'  => $product->name,
        ];

        // Insert the data into the cart
        $cart->insert($data);

        // Redirect to the homepage
        return redirect()->to('/');
    }

    /**
     * Display the contents of the cart.
     */
    public function cart(): string
    {
        return view('show_cart');
    }

    /**
     * Clear the user's shopping cart.
     */
    public function clear_cart(): RedirectResponse
    {
        $cart = new Cart();

        $cart->destroy();

        return redirect()->to('/');
    }
}

// End of file welcome.php
// Location: ./application/controllers/welcome.php
