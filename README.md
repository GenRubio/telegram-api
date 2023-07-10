## API de Tienda de Telegram
Este proyecto consiste en una API desarrollada en Laravel 9 que utiliza Backpack5 como panel de administración. La API está diseñada para administrar una tienda de Telegram, brindando funcionalidades para comprar productos, recibir notificaciones y controlar pedidos. Además, se han implementado los sistemas de pagos Paypal y Stripe.

### Características principales
- Laravel 9: La API está construida sobre el framework Laravel en su versión 9, aprovechando todas sus capacidades y características avanzadas. Laravel es conocido por su facilidad de uso, robustez y rendimiento.

- Backpack5: Se utiliza el panel de administración Backpack5, una herramienta poderosa que facilita la gestión de la tienda. Con Backpack5, los administradores pueden manejar de manera eficiente los productos, pedidos y notificaciones.

- Compra de productos: La API permite a los usuarios realizar compras de productos a través de Telegram. Los clientes pueden explorar el catálogo de productos, agregar artículos al carrito de compras y finalizar las transacciones de manera segura.

- Notificaciones: Los usuarios reciben notificaciones en tiempo real sobre el estado de sus pedidos. Estas notificaciones se envían a través de Telegram, manteniendo a los clientes actualizados sobre la confirmación de compra, actualizaciones de envío y otras novedades relacionadas con sus pedidos.

- Control de pedidos: La API proporciona funcionalidades para que los usuarios puedan controlar y gestionar sus pedidos de manera efectiva. Los clientes pueden acceder a su historial de pedidos, realizar seguimiento de envíos y solicitar reembolsos cuando sea necesario.

- Sistemas de pagos: La implementación de sistemas de pagos Paypal y Stripe permite a los usuarios realizar transacciones de forma segura y confiable. Estos sistemas de pagos reconocidos brindan una experiencia fluida y confiable para los clientes.

### Proyecto de Frontend
Este proyecto de API de Tienda de Telegram se complementa con una aplicación de frontend desarrollada en Vue 3. Puedes encontrar el repositorio de este proyecto en https://github.com/GenRubio/telegram-webapp.

El proyecto de frontend, desarrollado en Vue 3, ofrece una interfaz de usuario amigable para que los clientes puedan interactuar con la tienda de Telegram de manera intuitiva. A través de esta aplicación, los usuarios pueden explorar productos, realizar compras y gestionar sus pedidos de manera eficiente.

### Instalación y Configuración
Para utilizar la API de Tienda de Telegram, sigue los siguientes pasos:

- Clona el repositorio de la API desde GitHub.

- Ejecuta composer install para instalar las dependencias del proyecto.

- Configura las variables de entorno en el archivo .env con la información correspondiente, incluyendo las credenciales de Paypal y Stripe.

- Configura Ngrok para habilitar la comunicación segura con Telegram:
Descarga e instala Ngrok desde https://ngrok.com.
Ejecuta el comando ./ngrok http 8000 para iniciar Ngrok en el puerto 8000.
Ngrok generará una URL segura con protocolo HTTPS, por ejemplo: https://xxxxxxxx.ngrok.io. Copia esta URL.

- Ejecuta php artisan migrate para realizar las migraciones de la base de datos.

- Inicia el servidor de desarrollo con el comando php artisan serve.

- Para acceder al panel de administración de Backpack5, dirígete a http://localhost:8000/admin e inicia sesión con las credenciales de administrador.

- Para utilizar la aplicación de frontend, clona el repositorio del proyecto de frontend desde https://github.com/GenRubio/telegram-webapp y sigue las instrucciones proporcionadas en ese repositorio para la instalación y configuración.

### Configuracion local
Nesesitamos tener la url de proyecto con protocolo ssh\
Pata ello instalamos el Ngrok\
Ngrok: [ngrok](https://ngrok.com/)
```bash
 ngrok http http://127.0.0.1:8000
```

### Configuracion de Backups 
Archivo: config/database.php hay que configurar la ruta de la ubicacion del mysql
```bash
 'dump' => [
     'dump_binary_path' => 'D:/xampp2/mysql/bin/',
     'use_single_transaction',
     'timeout' => 60 * 5,
 ],
```

### Documentacion Telegraph
Telegraph: [telegraph](https://defstudio.github.io/telegraph/quickstart/setting-webhook)

### Emojis para mensajes
Emojis: [emojis](https://emojiterra.com/es/x/)
