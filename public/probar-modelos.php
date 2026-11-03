<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/datos/RepositorioProductos.php';

$repositorio = new RepositorioProductos(__DIR__ . '/../datos/datos.json');

echo '<pre>';
echo 'Busco el id 3: ' . $repositorio->buscarPorId(3)->obtenerNombre() . "\n";

try {
    $repositorio->buscarPorId(9999);
} catch (OutOfBoundsException $error) {
    echo 'Busco el id 9999: ' . $error->getMessage() . "\n";
}
echo '</pre>';