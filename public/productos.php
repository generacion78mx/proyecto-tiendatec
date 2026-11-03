<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/datos/RepositorioProductos.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$repositorio = new RepositorioProductos(__DIR__ . '/../datos/datos.json');
$destacados = array_slice($repositorio->obtenerTodos(), 0, 3);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tienda Tec - Catálogo</title>
        <link rel="stylesheet" href="assets/css/estilos.css">
    </head>
    <body>
        <header>
            <p class="marca">Tienda Tec</p>
            <nav aria-label="Principal">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="productos.php" aria-current="page">Catálogo</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1>Catálogo</h1>


            <a href="agregar-producto.php" class="boton-agregar">Agregar producto +</a>

           <section class="tarjetas-productos">
                <?php foreach ($destacados as $producto): ?>
                    <?php mostrarTarjetaProducto($producto, 3); ?>
                <?php endforeach; ?>
            </section>
        </main>

        <footer>
            <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
        </footer>
    </body>
</html>