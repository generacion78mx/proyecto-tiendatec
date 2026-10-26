<?php
declare(strict_types=1);

require_once __DIR__ .'/../src/modelos/Categoria.php';
require_once __DIR__ .'/../src/modelos/Producto.php';

$perifericos = new Categoria('Periféricos');
$audio = new Categoria('Audio');

echo $perifericos->obtenerNombre().'<br>';
echo $audio->obtenerNombre().'<br> --------------- <br>';

#$intento = new Producto(1, 'Mouse', new Categoria('Periféricos'), 499.00,'Texto',25,'img.png');

$mouse = Producto::desdeArreglo([
    'id' => 1,
    'nombre' => 'Mouse Inalámbrico',
    'categoria' => 'Periféricos',
    'precio' => 499.00,
    'descripcion' => 'Mouse inalámbrico con alte precisión',
    'stock' => 0,
    'imagen' => 'https://placehold.com/200x150?text=Mouse',

]);

echo $mouse->obtenerNombre().' ('.$mouse->obtenerCategoria()->obtenerNombre().') cuesta '.$mouse->obtenerPrecioFormateado().'<br>'; 
echo $mouse->estaDisponible() ? 'Hay existencias' : 'AGOTADO';
?>