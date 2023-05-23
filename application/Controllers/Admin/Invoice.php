<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Invoice as ModelsInvoice;
use App\Models\Order;

class Invoice extends BaseController
{
    // public function __construct()
    // {
    //     parent::__construct();

    //     if ($this->session->userdata('group') !== '1') {
    //         $this->session->set_flashdata('error', 'Sorry, you are not logged in!');
    //         redirect('login');
    //     }

    //     // load model -> model_products
    //     $this->load->model('model_orders');
    // }

    /**
     * Display a list of all invoices.
     */
    public function index(): string
    {
        $invoiceModel     = new ModelsInvoice();
        $data['invoices'] = $invoiceModel->findAll();

        return view('backend/view_all_invoices', $data);
    }

    /**
     * Displays details of a specific invoice.
     *
     * @param int $invoice_id The ID of the invoice to display details for.
     *
     * @return string Returns the HTML view of the invoice details.
     */
    public function detail(int $invoice_id): string
    {
        // Instantiate invoice and order models
        $invoiceModel = new ModelsInvoice();
        $orderModel   = new Order();

        // Retrieve invoice and related orders from the database
        $data['invoice'] = $invoiceModel->find($invoice_id);
        $data['orders']  = $orderModel->where('invoice_id', $invoice_id)->findAll();

        // Render the view with the invoice and order data
        return view('backend/view_invoice_detail', $data);
    }
}
