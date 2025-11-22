<?php
set_time_limit(300); // 5 minutos
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$password = getenv("MYSQLPASSWORD");
$database = getenv("MYSQLDATABASE");
$port = getenv("MYSQLPORT");

echo "<h2>Conectando a Railway MySQL...</h2>";
echo "Host: $host<br>";
echo "Database: $database<br><br>";

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

echo "✅ Conectado correctamente<br><br>";

// Lee el archivo SQL desde la carpeta db
$sql_file = __DIR__ . '/../db/sictel_db.sql';

if (!file_exists($sql_file)) {
    die("❌ No se encuentra el archivo: $sql_file");
}

echo "📄 Leyendo archivo SQL...<br>";
$sql = file_get_contents($sql_file);

echo "📦 Tamaño del archivo: " . strlen($sql) . " bytes<br><br>";

// Ejecutar el SQL completo
echo "⏳ Importando base de datos...<br>";

if ($conn->multi_query($sql)) {
    echo "✅ SQL ejecutado<br>";
    
    // Limpiar resultados
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
    
    echo "<br>✅ <strong>¡Base de datos importada exitosamente!</strong><br><br>";
    
    // Verificar tablas creadas
    $result = $conn->query("SHOW TABLES");
    echo "<h3>Tablas creadas:</h3>";
    while ($row = $result->fetch_array()) {
        echo "✓ " . $row[0] . "<br>";
    }
    
} else {
    echo "❌ Error al ejecutar SQL: " . $conn->error;
}

$conn->close();
echo "<br><br><strong>Puedes borrar este archivo ahora por seguridad.</strong>";
?>