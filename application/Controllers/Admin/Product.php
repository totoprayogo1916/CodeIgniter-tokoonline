<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product as ProductModel;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class Product extends BaseController
{
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

    /**
     * View the product edit page for a specific product by its ID.
     *
     * @param int $id The ID of the product to edit
     *
     * @return string The view for editing the product
     */
    public function edit(int $id): string
    {
        $modelProduct    = new ProductModel();
        $data['product'] = $modelProduct->find($id);

        return view('backend/form_edit_product', $data);
    }

    /**
     * Update a product in the database.
     */
    public function update(): RedirectResponse
    {
        // Get the validation service
        $validation   = Services::validation();
        $modelProduct = new ProductModel();

        // Set the validation rules for the product form fields
        $validation->setRules([
            'id'          => ['label' => 'ID', 'rules' => 'required|integer'],
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

    /**
     * Delete a product by ID.
     *
     * @param int $id The ID of the product to delete.
     */
    public function delete(int $id): RedirectResponse
    {
        $modelProduct = new ProductModel();
        $modelProduct->delete($id);

        return redirect()->back();
    }
}
