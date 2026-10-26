<?php
declare(strict_types = 1);

require_once __DIR__ . '/Categoria.php';

class Producto{
    private const CAMPOS_OBLIGATORIOS = [
        'id','nombre','categoria','precio','descripcion','stock','imagen',
    ];

    private int $id;
    private string $nombre;
    private Categoria $categoria;
    private float $precio;
    private string $descripcion;
    private int $stock;
    private string $imagen;

    private function __construct(
        int $id,
        string $nombre,
        Categoria $categoria,
        float $precio,
        string $descripcion,
        int $stock,
        string $imagen
    ){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->categoria = $categoria;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->stock = $stock;
        $this->imagen = $imagen;
    }

    private static function exigirCampos(array $registro):void{
        foreach(self::CAMPOS_OBLIGATORIOS as $campo){
            if(!array_key_exists($campo,$registro)){
                throw new InvalidArgumentException("El producto no tiene el campo ".$campo);
            }
        }
    }

    public static function desdeArreglo(array $registro): Producto{
        self::exigirCampos($registro);

        return new Producto(
            (int) $registro['id'],
            (string) $registro['nombre'],
            new Categoria((string) $registro['categoria']),
            (float) $registro['precio'],
            (string) $registro['descripcion'],
            (int) $registro['stock'],
            (string) $registro['imagen']
        );
    }

    public function obtenerId(): int{
        return $this->id;
    }

    public function obtenerNombre(): string{
        return $this->nombre;
    }

    public function obtenerCategoria(): Categoria{
        return $this->categoria;
    }

    public function obtenerPrecio(): float{
        return $this->precio;
    }

    public function obtenerDescripcion(): string{
        return $this->decripcion;
    }

    public function obtenerStock(): int{
        return $this->stock;
    }

    public function obtenerImagen(): string{
        return $this->imagen;
    }

    public function estaDisponible(): bool{
        return $this->stock > 0;
    }

    public function obtenerPrecioFormateado(): string{
        return '$'.number_format($this->precio,2);
    }

}


?>