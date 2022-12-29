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
