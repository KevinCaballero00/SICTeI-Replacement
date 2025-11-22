<?php
// Establecer tiempo máximo de ejecución
set_time_limit(30);

include 'config.php';
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Obtener el email del usuario de la sesión
$email = $_SESSION['email'];

try {
    // Consulta con timeout
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if (!$stmt) {
        die("Error en prepare: " . $conn->error);
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    
} catch (Exception $e) {
    die("Error en la consulta: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Usuario - SICTel 2025</title>
    <link rel="stylesheet" href="../assets/css/styleProfile.css">
</head>

<body>
    <div class="container">
        <div class="form-box active profile-box">
            <?php if (isset($user) && $user): ?>
                <h2>Mi Usuario</h2>
                <div class="profile-info">
                    <div class="info-group">
                        <label>Nombre:</label>
                        <p><?php echo htmlspecialchars($user['name']); ?></p>
                    </div>
                    <div class="info-group">
                        <label>Apellido:</label>
                        <p><?php echo htmlspecialchars($user['lastName']); ?></p>
                    </div>
                    <div class="info-group">
                        <label>Email:</label>
                        <p><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                    <div class="info-group">
                        <label>Rol:</label>
                        <p><?php echo htmlspecialchars($user['role']); ?></p>
                    </div>
                </div>

                <?php if ($user['role'] === 'Ponente'): ?>
                    <button onclick="window.location.href='formulario.php'">Inscribir Ponencia</button>
                <?php endif; ?>

                <?php if ($user['role'] === 'Evaluador'): ?>
                    <button onclick="window.location.href='gestion_formularios.php'">Ver Ponencias</button>
                <?php endif; ?>

                <?php if ($user['role'] === 'Administrador'): ?>
                    <button onclick="window.location.href='gestion_admin.php'">Administrar Usuarios</button>
                <?php endif; ?>

                <button onclick="window.location.href='login.php'">Cerrar Sesión</button>
                <button onclick="window.location.href='../index.html'">Volver al Inicio</button>
            <?php else: ?>
                <p class="error-message">No se encontraron datos del usuario.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>