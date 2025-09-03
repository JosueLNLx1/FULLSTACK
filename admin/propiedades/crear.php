<?php
    // base de datos

    require '../../includes/app.php';
    use App\Propiedad;
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager as Image;
    use App\Vendedor;

    
    estaAutenticado();

    $propiedad = new Propiedad();

    //consulta para obtener todos los vendedores
    $vendedores = Vendedor::all();

    //Validaciones
    $errores = [];


    // Validar que los campos no estén vacíos
    if($_SERVER['REQUEST_METHOD']=== 'POST'){

        $propiedad = new Propiedad($_POST['propiedad']);
        $nombreImagen = md5(uniqid(rand(), true)).".jpg";
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $manager = new Image(Driver::class);
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        $errores = $propiedad->validar();



        if(empty($errores)){
            //crear Carpeta
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }
            
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);

            
            $propiedad->guardar();
            


        }


    }
    incluirTemplate('header',false);
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>  
        <a href="/admin" class="boton boton-verde">Volver</a>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php  include '../../includes/templates/formulario_propiedades.php'  ?>

            <input type="submit" class="boton boton-verde" value="Crear Propiedad">

        </form>
    </main>

<?php

    mysqli_close($db);

    incluirTemplate('footer');

?>