<html>
    <head>
        <title>Tienda Tec - Agregar Producto</title>
    </head>
    <body>
        <header>
            <h1>Bienvenido a Tienda Tec</h1>
            <nav>
                <a href="index.php">Inicio</a>
                <a href="productos.php">Catálgo</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </header>

        <main>
            <section>
                <h2>Agregar Nuevo Producto</h2>
                <form action="#" method="post"> 
                    <label for="nombre">Nombre del producto:</label>
                    <input type="text" name="nombre" id="nombre" required>
                    <br>
                    <label for="categoria">Categoría:</label>
                    <input type="text" name="categoria" id="categoria" required>
                    <br>
                    <label for="precio">Precio:</label>
                    <input type="number" name="precio" id="precio" step="0.01" min="0">
                    <br>
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock" id="stock" min="0">

                    <button type="submit">Agregar Producto</button>
                </form>
        </main>

        <footer>
            <p>&copy; 2026 Tienda Tec. Todos los derechos reservados.</p>
        </footer>

    </body>
</html>