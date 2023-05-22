<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class Login extends BaseController
{
    /**
     * Returns the form_login view.
     */
    public function index(): string
    {
        return view('form_login');
    }

    /**
     * Authenticate the user
     */
    public function auth(): RedirectResponse
    {
        // Get the validation service
        $validation = Services::validation();

        // Set the validation rules for the username and password fields
        $validation->setRules([
            'username' => ['label' => 'username', 'rules' => 'required|alpha_numeric'],
            'password' => ['label' => 'password', 'rules' => 'required|alpha_numeric'],
        ]);

        // Validate the submitted form data
        if ($validation->withRequest($this->request)->run()) {
            // Get the User model
            $modelUser = new User();

            // Get the username and password from the submitted form data
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // Find the user with the given username
            $getUser = $modelUser->where('username', $username)->first();

            // If the user exists and the password matches, log in the user
            if ($getUser !== null) {
                if ($getUser->password === $password) {
                    switch ($getUser->group) {
                        case '1' : // admin
                            return redirect()->route('admin.product.view');
                            break;

                        case '2' : // member
                            return redirect()->to('/');
                            break;

                        default: break;
                    }
                }
            }
        }

        // If the submitted form data is invalid, redirect back to the login form with an error message
        return redirect()->back()->withInput()->with('error', 'Wrong Username / Password!');
    }

    public function logout()
    {
        session()->sess_destroy();
        redirect('login');
    }
}
