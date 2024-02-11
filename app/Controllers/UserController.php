<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InventoryModel;
use App\Models\CategoryModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class UserController extends BaseController
{
    use ResponseTrait;
    protected $session;

    public function __construct() {
        $this->session = \Config\Services::session(); 
    }

    public function index()
    { 
        $inventoryModel = new UserModel();
        return view('login'); 
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function website()
    {
        return view('website');
    }
    public function goregister()
    {
        return view('register');
    }
    public function register()
    {
        $user = new UserModel();
    
        $token = $this->verification(50);
    
        $data = [
            'FirstName' => $this->request->getVar('firstName'),
            'LastName' => $this->request->getVar('lastName'),
            'Email' => $this->request->getVar('email'),
            'Password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'Phone' => $this->request->getVar('phone'),
            'DateCreated' => date('Y-m-d H:i:s'),
            'Token' => $token,
            'Status' => 'active',
            'Role' => 'user'
        ];
    
        $inserted = $user->insert($data);
    
        if ($inserted) {
            return redirect('/');
        } else {
            return redirect('/goregister');
        }
    }

    public function verification($length)
    { 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
        return substr(str_shuffle($str_result), 
        0, $length); 
    } 

    public function gologin()
    {
        $email = $this->request->getVar("email"); 
        $password = $this->request->getVar("password"); 
        $user = new UserModel();
        $data = $user->where("Email", $email)->first();
    
        if ($data) {
            $storedPasswordHash = $data["Password"];
            $authenticatedPassword = password_verify($password, $storedPasswordHash);
    
            if ($authenticatedPassword) {
                return redirect('store');
            } else {
                // Add debug message for password verification
                log_message('error', 'Invalid password: ' . $password . ' | Stored hash: ' . $storedPasswordHash);
                return $this->respond(['msg' => 'Invalid password'], 200);
            }
        } else {
            // Add debug message for user not found
            log_message('error', 'User not found with email: ' . $email);
            return $this->respond(['msg' => 'User not found'], 200);
        }
    }
}

