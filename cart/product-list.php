<div id="product-grid">
    <div class="txt-heading">
        <div class="txt-heading-label">Products</div>
    </div>
    <?php
    $query = "SELECT * FROM products";
    $products_array = $shoppingCart->getAllProducts($query);
    if (! empty($products_array)) {
        foreach ($products_array as $key => $value) {
            ?>
        <div class="products-item">
        <form method="post"
            action="index.php?action=add&categories_id=<?php echo $product_array[$key]["categories_id"]; ?>">
            <div class="products-image">
                <img src="<?php echo $products_array[$key]["image"]; ?>">
                <div class="products-title">
                    <?php echo $products_array[$key]["name"]; ?>
                </div>
            </div>
            <div class="product-footer">
                <div class="float-right">
                    <input type="text" name="quantity" value="1"
                        size="2" class="input-cart-quantity" /><input type="image"
                        src="add-to-cart.png" class="btnAddAction" />
                </div>
                <div class="products-price float-left" id="products-price-<?php echo $products_array[$key]["categories_id"]; ?>"><?php echo "$".$products_array[$key]["price"]; ?></div>
                
            </div>
        </form>
    </div>
    <?php
        }
    }
    ?>
</div>