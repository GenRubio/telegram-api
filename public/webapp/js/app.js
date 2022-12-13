$(document).ready(function () {
    var apiUrl = "https://b1a0-94-125-96-102.eu.ngrok.io";
    var productsContainer = ".products-container_grid_container-js";
    var mainButton = Telegram.WebApp.MainButton;
    mainButton.text = "MI CARRITO (0)";
    mainButton.color = "#f9a917";
    mainButton.disable();
    mainButton.show();
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
                        <div class="products-container_button_item_container_button products-container_button_item_container_button-js" data-product="` + JSON.stringify(product) +`">
                            VER
                        </div>
                    </div>
                </div>`
                    $(productsContainer).append(productHtml);
                });
            }
        })
    }

    $(document).on('click', '.products-container_button_item_container_button-js', function() {
        document.getElementById("product-description-container-js").style.width = "100%";
    })

    $(document).on('click', '.close-product-description-js', function(event) {
        event.preventDefault();
        document.getElementById("product-description-container-js").style.width = "0";
    })
})