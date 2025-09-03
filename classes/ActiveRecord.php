<?php

namespace App;

class ActiveRecord{
    //base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    protected static $errores = [];



    public function guardar(){
        if(!is_null($this->id)){
            $this->actualizar();
        }else{
            $this->crear();
        }
    }

    public function crear(){
        //sanitizar datos

        $atributos = $this->sanitizarAtributos();


        
        $query = "INSERT INTO ".static::$tabla."(";
        $query .= join(", ", array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= " ');";


        $resultado = self::$db->query($query);


            if($resultado){
                header('Location: /admin?resultado=1');
            }
    }

    public function actualizar(){

        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE ".static::$tabla." SET ";
        $query .= join(', ',$valores);
        $query .= "WHERE id =  '". self::$db->escape_string($this->id). "' ";
        $resultado = self::$db->query($query);


        if($resultado){
            header('Location: /admin?resultado=1');
        }
        

    }

    //definir la conexion a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }

    public function eliminar(){
        $query = "DELETE FROM ".static::$tabla." WHERE id = ". self::$db->escape_string($this->id)."";
        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }

    }



    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna === "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){

            $sanitizado[$key] = self::$db->escape_string($value);

        }
        return $sanitizado;
    }

    //validacion
    public static function getErrores(){
        return static::$errores;
    }

    public function validar(){
        static::$errores = [];
        return static::$errores;
    }

    public function setImagen($imagen){

        //elimina la imagen previa
        if(isset($this->id)){
            $this->borrarImagen();
        }

        if($imagen){
            $this->imagen = $imagen;
        }

    }

    public function borrarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
    }

    public static function all(){
        $query = "SELECT * FROM ".static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Obtiene determinado numero de registros

    public static function get($cantidad){
        $query = "SELECT * FROM ".static::$tabla." LIMIT {$cantidad}";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //busca una propiedad por su id

    public static function find($id){
        $consulta = "SELECT * FROM ".static::$tabla." WHERE id = {$id}";
        $resultado = self::consultarSQL($consulta);
        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        $resultado = self::$db->query($query);

        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

       $resultado->free();
       return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        
        return $objeto;
    }

    //sincroniza el objeto en memoria con los cambios que haga el usuario
    public function sincronizar($args = []){
        foreach($args as $key => $value){

            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }


        }
    }
}