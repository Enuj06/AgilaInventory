<?php

$this->extend('layout/main');
$this->section('body');
?>

<?php if(session()->getFlashdata('success')): ?>
    <div id="alertMessage" class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        // Add JavaScript to automatically hide the alert after 3 seconds
        setTimeout(function(){
            document.getElementById('alertMessage').style.display = 'none';
        }, 3000);
    </script>

    <?php endif; ?>
<h1>Product List</h1>
<a href="/inventory/create" class="btn btn-primary">Add Product</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Category Name</th>
            <th scope="col">Product Name</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Image</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php if (isset($products) && is_array($products)): ?>
        <?php foreach($products as $product): ?>
        <tr>
        <th scope="row"><?= $product['ProductID']?></th>
        <td><?= $product['CategoryName']?></td>
        <td><?= $product['ProductName']?></td>
        <td><?= $product['Description']?></td>
        <td><?= $product['Price']?></td>
        <td><?= $product['Quantity']?></td>
        <td><img src="/uploads/<?= $product['ImageURL']; ?>" alt="" width="100"></td>
        <td><?= $product['created_at']?></td>

        <td>
            <a href="/inventory/edit/<?= $product['ProductID']?>" class="btn btn-warning">Edit</a>
           <!-- <a href="/inventory/delete/<= $product['ProductID']?>" class="btn btn-danger">Delete</a> -->
           <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteLink(<?= $product['ProductID']?>)">Delete</button>
        </td>

        </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No products found</p>
    <?php endif; ?>
    </tbody>
</table>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this product?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a id="deleteProductLink" class="btn btn-danger" href="#">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to set the delete link dynamically
    function setDeleteLink(productID) {
        document.getElementById('deleteProductLink').href = '/inventory/delete/' + productID;
    }
</script>



<?php $this->endSection(); ?>