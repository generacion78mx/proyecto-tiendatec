<?php
declare(strict_types=1);

require_once __DIR__ . '/../modelos/Producto.php';

// Todo texto que viene de los datos se escapa antes de imprimirse en HTML.
function escapar(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function mostrarTarjetaProducto(Producto $producto, int $nivelTitulo = 2): void
{
    $titulo = 'h' . $nivelTitulo;
    $nombre = escapar($producto->obtenerNombre());
    $categoria = escapar($producto->obtenerCategoria()->obtenerNombre());
    ?>
    <article>
        <img src="<?= escapar($producto->obtenerImagen()) ?>" alt="Foto de <?= $nombre ?>">
        <div class="tarjeta-producto-info">
            <<?= $titulo ?>><?= $nombre ?></<?= $titulo ?>>
            <p class="etiqueta-categoria">Categoría: <?= $categoria ?></p>
            <p class="texto-secundario"><?= escapar($producto->obtenerDescripcion()) ?></p>
            <p class="tarjeta-producto-precio">Precio: <?= $producto->obtenerPrecioFormateado() ?></p>
            <?php mostrarDisponibilidad($producto); ?>
            <a class="enlace-detalle" href="producto-detalle.php?id=<?= $producto->obtenerId() ?>">Ver detalle de <?= $nombre ?></a>
        </div>
    </article>
    <?php
}

function mostrarDisponibilidad(Producto $producto): void
{
    if ($producto->estaDisponible()) {
        echo '<p class="disponibilidad disponible">Disponible: ' . $producto->obtenerStock() . ' piezas</p>';
        return;
    }

    echo '<p class="disponibilidad agotado">Agotado</p>';
}