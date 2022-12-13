<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="MobileOptimized" content="176" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="robots" content="noindex,nofollow" />
    <title></title>
    <script src="https://telegram.org/js/telegram-web-app.js?1"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('webapp/css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="{{ url('webapp/js/app.js') }}"></script>
    <script>
        function setThemeClass() {
            document.documentElement.className = Telegram.WebApp.colorScheme;
        }
        Telegram.WebApp.onEvent('themeChanged', setThemeClass);
        setThemeClass();
    </script>
</head>

<body>
    <div class="container">
        <div class="products-container">
            <div class="products-container_grid_container products-container_grid_container-js"></div>
        </div>
        <div id="product-description-container-js" class="product-description-container">
            <div class="close-product-description close-product-description-js">
                &times;
            </div>
            <div class="product-description-container_title_container">
               SUPER
            </div>
            <div class="product-description-container_content_container_row">
                <div>
                    <div class="products-container_grid_container_item">
                        <div class="products-container_grid_container_item_image">
                            <div class="products-container_grid_container_item_image_content"
                                style="background: url({{ url('images/product/models/0b0c2f1d62dc5a406b484b596209b225-image.jpg') }});background-repeat: no-repeat;background-size: contain; background-position: center;">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="product-description-container_especifications">
                        <div class="products-container_grid_container_item">
                            <div class="products-container_grid_container_item_image">
                                <div class="products-container_grid_container_item_image_content"
                                    style="background: url({{ url('images/icons/bg2-1.png') }});background-repeat: no-repeat;background-size: contain; background-position: center;">
                                </div>
                            </div>
                        </div>
                        <div class="products-container_grid_container_item">
                            <div class="products-container_grid_container_item_image">
                                <div class="products-container_grid_container_item_image_content"
                                    style="background: url({{ url('images/icons/bg2-2.png') }});background-repeat: no-repeat;background-size: contain; background-position: center;">
                                </div>
                            </div>
                        </div>
                        <div class="products-container_grid_container_item">
                            <div class="products-container_grid_container_item_image">
                                <div class="products-container_grid_container_item_image_content"
                                    style="background: url({{ url('images/icons/bg2-3.png') }});background-repeat: no-repeat;background-size: contain; background-position: center;">
                                </div>
                            </div>
                        </div>
                        <div class="products-container_grid_container_item">
                            <div class="products-container_grid_container_item_image">
                                <div class="products-container_grid_container_item_image_content"
                                    style="background: url({{ url('images/icons/bg2-4.png') }});background-repeat: no-repeat;background-size: contain; background-position: center;">
                                </div>
                            </div>
                        </div>
                        <div class="products-container_grid_container_item">
                            <div class="products-container_grid_container_item_image">
                                <div class="products-container_grid_container_item_image_content"
                                    style="background: url({{ url('images/icons/bg2-5.png') }});background-repeat: no-repeat;background-size: contain; background-position: center;">
                                </div>
                            </div>
                        </div>
                        <div class="products-container_grid_container_item">
                            <div class="products-container_grid_container_item_image">
                                <div class="products-container_grid_container_item_image_content"
                                    style="background: url({{ url('images/icons/bg2-6.png') }});background-repeat: no-repeat;background-size: contain; background-position: center;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
