<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/datos/RepositorioProductos.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$repositorio = new RepositorioProductos(__DIR__ . '/../datos/datos.json');
$idSolicitado = (int) filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);

$productoEncontrado = true;
try {
    $producto = $repositorio->buscarPorId($idSolicitado);
} catch (OutOfBoundsException $error) {
    $productoEncontrado = false;
    http_response_code(404);
}
?>
<!DOCTYPE html>
<htm lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
        <title>Tienda Tec - Detalle producto</title>
        <link rel="stylesheet" href="assets/css/estilos.css">
    </head>
    <body>
        <header>
            <h1>Bienvenido a Tienda Tec</h1>
            <nav aria-label="Principal">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="productos.php" aria-current="page">Catálogo</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <?php if ($productoEncontrado): ?>
                <h1><?= escapar($producto->obtenerNombre()) ?></h1>
                <!-- Aquí va el HTML de tu ficha, con los métodos de $producto -->
                <p>Precio: <?= $producto->obtenerPrecioFormateado() ?></p>
                <?php mostrarDisponibilidad($producto); ?>
            <?php else: ?>
                <h1>Producto no encontrado</h1>
                <p>El producto que buscas no existe o ya no está disponible.</p>
                <a href="productos.php">Volver al catálogo</a>
            <?php endif; ?>
        </main>

        <footer>
            <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
        </footer>

    </body>
</html>