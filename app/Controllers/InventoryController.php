<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InventoryModel;
use App\Models\CategoryModel;
use App\Models\UserModel;

class InventoryController extends BaseController
{
    // public function index2()
    // {
    //     $inventoryModel = new InventoryModel();
    //     $data['inventoryItems'] = $inventoryModel->findAll(); 
    //     return view('inventory_view', $data);         
    // }
    // public function fetchCategories()
    // {
    //     $categoryModel = new CategoryModel();
    //     $categories = $categoryModel->findAll(); 
        
    //     return $this->response->setJSON($categories); 
    // }
    // public function fetchItems()
    // {
    //     $inventoryModel = new InventoryModel();
    //     $items = $inventoryModel->findAll(); // Fetch inventory items from the database
        
    //     return $this->response->setJSON($items); // Return items as JSON
    // }
    // public function itemError()
    // {
    //     return view('itemerror');
    // }

    // public function add()
    // {
    //     $inventoryModel = new InventoryModel();

    //     $formData = $this->request->getPost();

    //     $data = [
    //         'CategoryID' => $formData['category'],
    //         'ProductName' => $formData['itemName'],
    //         'Description' => $formData['description'],
    //         'Price' => $formData['price'],
    //         'Quantity' => $formData['quantity'],
    //     ];

    //     $inserted = $inventoryModel->insert($data);
    // }

    // public function fetchCategoryName($CategoryID)
    // {
    //     if (!$CategoryID) {
    //         return $this->response->setStatusCode(400)->setBody('Invalid CategoryID');
    //     }
    
    //     $categoryModel = new CategoryModel();
    
    //     $category = $categoryModel->find($CategoryID);
    
    //     if ($category) {
    //         $response = [
    //             'CategoryName' => $category['CategoryName']
    //         ];
    
    //         return $this->response->setJSON($response);
    //     } else {
    //         return $this->response->setStatusCode(404)->setBody('Category not found');
    //     }
    // }

    // public function getItem($productId)
    // {
    //     $inventoryModel = new InventoryModel();

    //     // Fetch the item details from the database using the product ID
    //     $item = $inventoryModel->find($productId);

    //     if ($item) {
    //         // If the item is found, return it as JSON response
    //         return $this->respond($item);
    //     } else {
    //         // If the item is not found, return a 404 Not Found response
    //         return $this->failNotFound('Item not found');
    //     }
    // }
    // public function deleteItem($ProductID)
    // {
    //     $inventoryModel = new InventoryModel(); 
    //     $inventoryModel->delete($ProductID);
    // return redirect()->to('/main');
    // }
        public function index(){
    $inventoryModel = new InventoryModel();
    $data['products'] = $inventoryModel->findAll();
    return view('products/list', $data);
}


        public function create(){
            return view('products/add');
        }

        public function store(){
            $insertProduct = new InventoryModel();

            if($img = $this->request->getFile('ImageURL')){
                if($img->isValid() && ! $img->hasMoved()){
                    $imageName = $img->getRandomName();
                    $img->move('uploads/', $imageName);
                }
            }
            $data = array(
                'CategoryName'=> $this->request->getPost('CategoryName'),
                'ProductName'=> $this->request->getPost('ProductName'),
                'Description'=> $this->request->getPost('Description'),
                'Price'=> $this->request->getPost('Price'),
                'Quantity'=> $this->request->getPost('Quantity'),
                'ImageURL'=> $imageName,
            );
            $insertProduct->insert($data);

            return redirect()->to('/inventory')->with('success','Product Added Successfully!');
        }
        public function edit($ProductID){
            $fetchproduct = new InventoryModel();
            $data['product'] = $fetchproduct->where('ProductID', $ProductID)->first();

            return view('products/edit', $data);
        }
        public function update($ProductID){
            $updateProduct = new InventoryModel();
            $db = db_connect();

            if($img = $this->request->getFile('ImageURL')){
                if($img->isValid() && ! $img->hasMoved()){
                    $imageName = $img->getRandomName();
                    $img->move('uploads/', $imageName);
                }
            }

            if(!empty($_FILES['ImageURL']['name'])){
                $db->query("UPDATE products SET ImageURL = '$imageName' WHERE ProductID = '$ProductID' ");
            }

            $data = array(
                'CategoryName'=> $this->request->getPost('CategoryName'),
                'ProductName'=> $this->request->getPost('ProductName'),
                'Description'=> $this->request->getPost('Description'),
                'Price'=> $this->request->getPost('Price'),
                'Quantity'=> $this->request->getPost('Quantity'),
            );

            $updateProduct->update($ProductID, $data);
            return redirect()->to('/inventory')->with('success','Student Updated Successfully!');
        }
        public function delete($ProductID){
            $deleteProduct = new InventoryModel();
            $deleteProduct->delete($ProductID);

            return redirect()->to('/inventory')->with('success','Product Deleted Successfully');
        }
}