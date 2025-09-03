<?php
namespace App;

class Propiedad extends ActiveRecord{

    protected static $tabla='propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedores_id'];
    
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamientos'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "El título es obligatorio";
        }
        if($this->precio <= 0 || !$this->precio){
            self::$errores[] = "El precio es obligatorio y no puede ser menor o igual a 0";
        }

        if(strlen($this->descripcion) < 50){
            self::$errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }
            //crear Carpeta

        if(!$this->habitaciones){
            self::$errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$this->wc){
            self::$errores[] = "El número de baños es obligatorio";
        }

        if(!$this->estacionamiento){
            self::$errores[] = "El número de estacionamientos es obligatorio";
        }

        
        if(!$this->imagen) {
            self::$errores[] = "Tienes que anadir una imagen";
        }
        if(!$this->vendedores_id || $this->vendedores_id === 0){
            self::$errores[] = "El vendedor es obligatorio";
        }
        return self::$errores;
    }
}
