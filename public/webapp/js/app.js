$(document).ready(function () {
    var productsContainer = ".products-container_grid_container-js";

    loadProducts();

    function loadProducts() {
        $.ajax({
            url: apiUrl + "/api/products",
            method: "GET",
            success: function (data) {
                data.forEach(product => {
                    let productHtml = `<div class="products-container_grid_container_item">
                    <div class="products-container_grid_container_item_image">
                        <div class="products-container_grid_container_item_image_content"
                            style="background: url(` + product.image + `);background-repeat: no-repeat;background-size: contain; background-position: center;">
                            <div class="products-container_grid_container_item_image_content_price_container">
                                <div class="products-container_grid_container_item_image_content_price_container_price">
                                    ` + product.price + `€
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="products-container_price_item_container">
                        <div class="products-container_price_item_container_title">
                        ` + product.name + `
                        </div>
                    </div>
                    <div class="products-container_button_item_container">
                        <div class="products-container_button_item_container_button">
                            VER
                        </div>
                    </div>
                </div>`
                    $(productsContainer).append(productHtml);
                });
            }
        })
    }
})