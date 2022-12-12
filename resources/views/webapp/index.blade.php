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
    <script>
        var apiUrl = "https://af05-94-125-96-102.eu.ngrok.io";
    </script>
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
            <div class="products-container_grid_container">
                <div class="products-container_grid_container_item">
                    <div class="products-container_grid_container_item_image">
                        <div class="products-container_grid_container_item_image_content"
                            style="background: url({{ url('images/product/models/0b0c2f1d62dc5a406b484b596209b225-image.jpg') }});background-repeat: no-repeat;background-size: contain; background-position: center;">
                            <div class="products-container_grid_container_item_image_content_price_container">
                                <div class="products-container_grid_container_item_image_content_price_container_price">
                                    10€
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="products-container_price_item_container">
                        <div class="products-container_price_item_container_title">
                            CUVIE BOX
                        </div>
                    </div>
                    <div class="products-container_button_item_container">
                        <div class="products-container_button_item_container_button">
                            VER
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
