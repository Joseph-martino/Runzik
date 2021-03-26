<div class="products-research-options-container">
    <div class="brand-research-container">
        <h2 class="subtitle">Choisir une marque</h2>
        <div class="brand-cards-container">
            <?php
                    for($i = 0; $i <3; $i++) {
                        $brandName;
                        switch ($i) {
                            case 0:
                                $brandName="runzik";
                                break;
                            case 1:
                                $brandName="beats";
                                break;
                            case 2:
                                $brandName="jbl";
                                break;
                        }
                        echo "<div class=\"brand-card\">
                        <img class=\"".$brandName."-card-logo\" src=\"ressources/images/logos/logo-".$brandName.".png\" alt=\"".$brandName." logo\">
                        <input type=\"checkbox\" id=\"".$brandName."-products\" name=\"".$brandName."-products\">
                    </div>";
                    }
                    ?>

        </div>
        <h2 class="subtitle">Choisir un produit</h2>
    </div>
    <div class="scroll-list-container">
        <label for="product-select">Trier les produits</label>
        <select name="product" id="product-select">
            <option value="ascending-price">Du + cher au - cher</option>
            <option value="decreasing-price ">Du - cher au + cher</option>
        </select>
    </div>
</div>
<div class="products-grid-container">
    <div class="products-line-container">
        <?php
                 $index = 0;
                for($i = 0; $i < 6; $i++){
                    $index++;
                    if($index >3){
                        $index = 1;
                    }
                echo "<div class=\"product-card\">
                <button class=\"add-to-wishlist-button\"><img class=\"wishlist-icon\"
                        src=\"ressources/images/icons/add-to-wishlist-icon-selected.png\"
                        alt=\"add to wishlist icon\"></button>

                <img class=\"".$product."\" src=\"ressources/images/products/".$product.$index.".png\" alt=\"".$product." picture\">

                <div class=\"miniature-product-container\">
                    <img class=\"miniature-product\" src=\"ressources/images/products/miniature-".$product.".png\"
                        alt=\"".$product." picture\">
                        <img class=\"miniature-product\" src=\"ressources/images/products/miniature-".$product.".png\"
                        alt=\"".$product." picture\">
                        <img class=\"miniature-product\" src=\"ressources/images/products/miniature-".$product.".png\"
                        alt=\"".$product." picture\">
                </div>
                <h2 class=\"product-name\">".$screenDisplayName." Run’Zik S Plus</h2>
                <p class=\"product-price\">150€</p>
                <button class=\"see-more-button\">Découvrir</button>
            </div>";
            }
            ?>
    </div>
</div>