<?php
require_once "DBController.php";

class ShoppingCart extends DBController
{

    function getAllProducts()
    {
        $query = "SELECT * FROM products";
        
        $productsResult = $this->getDBResult($query);
        return $productsResult;
    }

    function getMemberCartItem($users_id) {
           $query = "SELECT products.*, cart.id as cart_id, cart.quantity FROM products, cart WHERE 
            products.id = cart.product_id AND cart.users_id = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $users_id
            )
        );
        
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }

    function getProductsByCode($products_categories_id)
    {
        $query = "SELECT * FROM products WHERE categories_id=?";
        
        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $products_categories_id
            )
        );
        
        $productsResult = $this->getDBResult($query, $params);
        return $productsResult;
    }

    function getCartItemByProducts($product_id, $users_id)
    {
        $query = "SELECT * FROM cart WHERE product_id = ? AND users_id = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $users_id
            )
        );
        
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }

    function addToCart($product_id, $quantity, $users_id)
    {
        $query = "INSERT INTO cart (product_id,quantity,users_id) VALUES (?, ?, ?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $users_id
            )
        );
        
        $this->updateDB($query, $params);
    }

    function updateCartQuantity($quantity, $cart_id)
    {
        $query = "UPDATE cart SET  quantity = ? WHERE id= ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );
        
        $this->updateDB($query, $params);
    }

    function deleteCartItem($cart_id)
    {
        $query = "DELETE FROM cart WHERE id = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );
        
        $this->updateDB($query, $params);
    }

    function emptyCart($users_id)
    {
        $query = "DELETE FROM cart WHERE users_id = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $users_id
            )
        );
        
        $this->updateDB($query, $params);
    }
}
