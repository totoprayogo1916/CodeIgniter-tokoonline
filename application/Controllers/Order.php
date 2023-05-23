<?php

namespace App\Controllers;

use App\Models\Order as ModelsOrder;
use CodeIgniter\HTTP\RedirectResponse;
use Totoprayogo\Lib\Cart;

class Order extends BaseController
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     if (! $this->session->userdata('username')) {
    //         redirect('login');
    //     }
    //     $this->load->model('model_orders');
    // }

    /**
     * Process the order.
     *
     * This function creates a new instance of the Cart class and ModelsOrder class to process the order.
     * If the cart has any items, it destroys the cart and returns the order_success view.
     * If the cart has no items, it redirects to the homepage with an error message.
     *
     * @return RedirectResponse|string
     */
    public function index()
    {
        $cart       = new Cart();
        $orderModel = new ModelsOrder();

        $orderModel->process();

        if ($cart->total_items() > 0) {
            $cart->destroy();

            return view('order_success');
        }

        return redirect()->to('/')->with('error', 'Failed to processed your order, please try again!');
    }
}
