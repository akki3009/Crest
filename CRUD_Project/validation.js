$(document).ready(function () {
    $("#loginForm").validate({
        rules: {

            user_name: {
                required: true,
                user_name: true,
                minlength: 4
            },
            user_password: {
                required: true,
                minlength: 6
            },

        },
        messages: {
            user_name: {
                required: 'Pls Enter User Name...',
                minlength: 'User Name must be atleast 4 character'
            },
            user_password: {
                required: 'Enter password...',
                minlength: 'Password must be atleast 6 character'
            },
        },
    });
    $("#categoryForm").validate({
        rules: {
            category_image: {
                required: true,
            },
            category_name: {
                required: true,
                minlength: 3
            },
            category_order: {
                required: true,
                minlength: 1
            },

        },
        messages: {
            category_image: {
                required: 'Please Insert Image...',
            },
            category_name: {
                required: 'Enter Category...',
                minlength: 'Category Name must be atleast 3 character'
            },
            category_order: {
                required: 'Enter Order...',
                minlength: 'pls Enter order'
            },
        },
    });
    $("#categoryForm1").validate({
        rules: {
            category_name: {
                required: true,
                minlength: 3
            },
            category_order: {
                required: true,
                minlength: 1
            },

        },
        messages: {
            category_name: {
                required: 'Enter Category...',
                minlength: 'Category Name must be atleast 3 character'
            },
            category_order: {
                required: 'Enter Order...',
                minlength: 'Please Enter order...'
            },
        },
    });
    $("#productForm").validate({
        rules: {
            image_name: {
                required: true,
            },
            product_name: {
                required: true,
                minlength: 3
            },
            category_name: {
                required: {
                    depends: function (element) {
                        return $("#category_name").val() == "none";
                    }
                }
            },
            price: {
                required: true,
            },
            sale_price: {
                required: true,
            },
            product_quantity: {
                required: true,
            },
            product_order: {
                required: true,
            },


        },
        messages: {
            image_name: {
                required: 'Insert Image',
            },
            product_name: {
                required: 'Enter Product Name',
                minlength: 'Product Name must be atleast 3 character'
            },
            category_name: {
                required: 'Select Category',

            },
            price: {
                required: 'Enter Price',
            },
            sale_price: {
                required: 'Enter Sale Price',
            },
            product_quantity: {
                required: 'Enter Quantity',

            },
            product_order: {
                required: 'Enter Order',

            },
        },
    });
    $("#productForm1").validate({
        rules: {
            product_name: {
                required: true,
                minlength: 3
            },
            category_name: {
                required: {
                    depends: function (element) {
                        return $("#category_name").val() == "none";
                    }
                }
            },
            price: {
                required: true,
            },
            sale_price: {
                required: true,
            },
            product_quantity: {
                required: true,
            },
            product_order: {
                required: true,
            },
        },
        messages: {
            product_name: {
                required: 'Enter Product Name',
                minlength: 'Product Name must be atleast 3 character'
            },
            category_name: {
                required: 'Select Category',

            },
            price: {
                required: 'Enter Price',
            },
            sale_price: {
                required: 'Enter Sale Price',
            },
            product_quantity: {
                required: 'Enter Quantity',
            },
            product_order: {
                required: 'Enter Order',
            },
        },
    });
});