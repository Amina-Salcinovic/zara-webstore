let ProductService = {
    init: function() {
        $("#addProductForm").validate({
            submitHandler: function(form) {
                var product = Object.fromEntries(new FormData(form).entries());
                ProductService.addProduct(product);
                form.reset();
            }
        });

        $("#editProductForm").validate({
            submitHandler: function(form) {
                var product = Object.fromEntries(new FormData(form).entries());
                ProductService.editProduct(product);
            }
        });

        ProductService.getAllProducts();
    },

    openAddModal: function() {
        $('#addProductModal').show(); 
    },

    closeModal: function() {
        $('#addProductModal').hide();
        $('#editProductModal').hide();
        $('#deleteProductModal').modal('hide');
    },

    getAllProducts: function() {
        RestClient.get("products", function(data) {
            Utils.datatable('products-table', [
                { data: 'name', title: 'Product Name' },
                { data: 'price', title: 'Price' },
                { data: 'category', title: 'Category' },
                {
                    title: 'Actions',
                    render: function(data, type, row, meta) {
                        const rowStr = encodeURIComponent(JSON.stringify(row));
                        return `<div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-primary" onclick="ProductService.openEditModal('${row.id}')">Edit</button>
                            <button class="btn btn-danger" onclick="ProductService.openConfirmationDialog(decodeURIComponent('${rowStr}'))">Delete</button>
                        </div>`;
                    }
                }
            ], data, 10);
        }, function(xhr, status, error) {
            console.error("Error fetching products:", error);
        });
    },

    getProductById: function(id, callback) {
        RestClient.get('product/' + id, function(data) {
            if(callback) callback(data);
        }, function(xhr, status, error) {
            console.error("Error fetching product by ID:", error);
        });
    },

    addProduct: function(product) {
        $.blockUI({ message: '<h3>Processing...</h3>' });
        RestClient.post('products', product, function(response) {
            toastr.success("Product added successfully");
            $.unblockUI();
            ProductService.getAllProducts();
            ProductService.closeModal();
        }, function(response) {
            toastr.error(response.message || "Error adding product");
            ProductService.closeModal();
        });
    },

    editProduct: function(product) {
        console.log(product);
        $.blockUI({ message: '<h3>Processing...</h3>' });
        RestClient.patch('product/' + product.id, product, function(response) {
        toastr.success("Product updated successfully");
        $.unblockUI();
        ProductService.getAllProducts();
        ProductService.closeModal();
    }, function(xhr, status, error) {
        console.error('Error updating product', error);
        $.unblockUI();
    });

    },

    openEditModal: function(id) {
        $.blockUI({ message: '<h3>Loading...</h3>' });
        $('#editProductModal').show();
        ProductService.getProductById(id, function(product) {
            $('input[name="id"]').val(product.id);
            $('input[name="name"]').val(product.name);
            $('input[name="price"]').val(product.price);
            $('input[name="category"]').val(product.category);
            $.unblockUI();
        });
    },

    openConfirmationDialog: function(product) {
        product = JSON.parse(product);
        $("#deleteProductModal").modal("show");
        $("#delete-product-body").html("Do you want to delete product: " + product.name + "?");
        $("#delete_product_id").val(product.id);
    },

    deleteProduct: function() {
        const id = $("#delete_product_id").val();
        RestClient.delete('products/' + id, null, function(response) {
            toastr.success("Product deleted successfully");
            ProductService.getAllProducts();
            ProductService.closeModal();
        }, function(response) {
            toastr.error(response.message || "Error deleting product");
            ProductService.closeModal();
        });
    }  
};

// CLICK ON PRODUCT IMAGE → ADD TO CART
$(document).on("click", ".product-image", function () {
  CartService.add({
    product_id: $(this).data("id"),
    name: $(this).data("name"),
    price: Number($(this).data("price")),
    image_url: $(this).data("image")
  });
});


// CLICK ON HEART → ADD TO FAVORITES
$(document).on("click", ".add-favorite", function (e) {
  e.stopPropagation(); // da klik na srce ne doda i u cart
  FavoritesService.add($(this).data("id"));
});

