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
        var apiUrl = "https://7031-94-125-96-102.eu.ngrok.io";
    </script>
    <script src="{{ url('webapp/js/app.js') }}"></script>
    <script>
        function setThemeClass() {
            document.documentElement.className = Telegram.WebApp.colorScheme;
        }
        Telegram.WebApp.onEvent('themeChanged', setThemeClass);
        setThemeClass();
    </script>
    <style>
        body {
            font-family: sans-serif;
            background-color: var(--tg-theme-bg-color, #ffffff);
            color: var(--tg-theme-text-color, #222222);
            font-size: 16px;
            margin: 0;
            padding: 0;
            color-scheme: var(--tg-color-scheme);
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="apiUrl"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('apiUrl').innerHTML = apiUrl;
        }, false);
    </script>
</body>
