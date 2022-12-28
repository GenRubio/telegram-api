
Configuracion de Backups 
Archivo: config/database.php hay que configurar la ruta de la ubicacion del mysql
'dump' => [
     'dump_binary_path' => 'D:/xampp2/mysql/bin/',
     'use_single_transaction',
     'timeout' => 60 * 5,
],
