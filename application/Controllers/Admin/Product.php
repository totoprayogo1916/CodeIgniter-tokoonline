<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product as ProductModel;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class Product extends BaseController
{
    // public function __construct()
    // {
    // parent::__construct();

    // if ($this->session->userdata('group') !== '1') {
    //     $this->session->set_flashdata('error', 'Sorry, you are not logged in!');
    //     redirect('login');
    // }

    // load model -> model_products
    // $this->load->model('model_products');
    // }

    /**
     * Retrieves all products from the database and renders the view for displaying them.
     */
    public function index(): string
    {
        $modelProduct     = new ProductModel();
        $data['products'] = $modelProduct->findAll();

        return view('backend/view_all_products', $data);
    }

    /**
     * Display the form for creating a new product.
     */
    public function create(): string
    {
        return view('backend/form_tambah_product');
    }

    /**
     * Submits the form data for a new product and saves it to the database
     */
    public function submit(): RedirectResponse
    {
        // Get the validation service
        $validation   = Services::validation();
        $modelProduct = new ProductModel();

        // Set the validation rules for the product form fields
        $validation->setRules([
            'name'        => ['label' => 'product name', 'rules' => 'required'],
            'description' => ['label' => 'description', 'rules' => 'required'],
            'price'       => ['label' => 'product price', 'rules' => 'required|integer'],
            'stock'       => ['label' => 'available stock', 'rules' => 'required|integer'],
        ]);

        // Validate the submitted form data
        if ($validation->withRequest($this->request)->run()) {

            // Get the uploaded file and move it to the designated directory
            $file  = $this->request->getFile('userfile');
            $image = [];

            if ($file->isValid() && ! $file->hasMoved()) {
                $name = $file->getRandomName(); // set random name for file(s)

                $file->move(WRITEPATH . 'uploads', $name);

                // Set the image name for the database entry
                $image = [
                    'image' => $name,
                ];
            }

            // Merge the form data with the image field and save it to the database
            $data = array_merge(
                $this->request->getPost(),
                $image
            );
            $modelProduct->save($data);

            // Redirect to product list main page
            return redirect()->route('admin.product.view');
        }

        // Redirect back to the previous page with user input
        return redirect()->back()->withInput();
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Product Name', 'required');
        $this->form_validation->set_rules('description', 'Product Description', 'required');
        $this->form_validation->set_rules('price', 'Product Price', 'required|integer');
        $this->form_validation->set_rules('stock', 'Available Stock', 'required|integer');

        if ($this->form_validation->run() === false) {
            $data['product'] = $this->model_products->find($id);
            $this->load->view('backend/form_edit_product', $data);
        } else {
            if ($_FILES['userfile']['name'] !== '') {
                // form submit dengan gambar diisi
                // load uploading file library
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size']      = '300'; // KB
                $config['max_width']     = '2000'; // pixels
                $config['max_height']    = '2000'; // pixels

                $this->load->library('upload', $config);

                if (! $this->upload->do_upload()) {
                    $data['product'] = $this->model_products->find($id);
                    $this->load->view('backend/form_edit_product', $data);
                } else {
                    $gambar       = $this->upload->data();
                    $data_product = [
                        'name'        => set_value('name'),
                        'description' => set_value('description'),
                        'price'       => set_value('price'),
                        'stock'       => set_value('stock'),
                        'image'       => $gambar['file_name'],
                    ];
                    $this->model_products->update($id, $data_product);
                    redirect('admin/products');
                }
            } else {
                // form submit dengan gambar dikosongkan
                $data_product = [
                    'name'        => set_value('name'),
                    'description' => set_value('description'),
                    'price'       => set_value('price'),
                    'stock'       => set_value('stock'),
                ];
                $this->model_products->update($id, $data_product);
                redirect('admin/products');
            }
        }
    }

    public function delete($id)
    {
        $this->model_products->delete($id);
        redirect('admin/products');
    }
}
