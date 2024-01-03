<?php
require_once '../models/Database.php';

// Obtener el correo electrónico enviado por AJAX
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';

// Consultar si el correo electrónico ya está registrado
$query = $pdo->prepare("SELECT COUNT(*) as count FROM usuarios WHERE correo = ?");
$query->execute([$correo]);
$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result['count'] > 0) {
    echo '<span style="color: red;">¡El correo electrónico ya está registrado!</span>';
} else {
    echo '<span style="color: green;">El correo electrónico está disponible.</span>';
}
