<?php
    require '../../includes/app.php';
    estaAutenticado();
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager as Image;


    
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header('Location: /admin');
    }

    $propiedad = Propiedad::find($id);
    $vendedores = Vendedor::all();
    

;


    //Validaciones
    $errores = Propiedad::getErrores();


    // Validar que los campos no estén vacíos
    if($_SERVER['REQUEST_METHOD']=== 'POST'){

        //asignar los atributos
        $args = [];
        $args= $_POST['propiedad'];
        

        $propiedad->sincronizar($args);

        $errores = $propiedad->validar();

        $nombreImagen = md5(uniqid(rand(), true)).".jpg";
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $manager = new Image(Driver::class);
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
            $propiedad->setImagen($nombreImagen);
        }
        


        if(empty($errores)){
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);

            }
            $resultado = $propiedad->guardar();

        }


    }
    incluirTemplate('header',false);
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>  
        <a href="/admin" class="boton boton-verde">Volver</a>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST"  enctype="multipart/form-data">
            
            <?php  include '../../includes/templates/formulario_propiedades.php'  ?>

            <input type="submit" class="boton boton-verde" value="Actualizar Propiedad">

        </form>
    </main>

<?php

    mysqli_close($db);

    incluirTemplate('footer');

?>