<?php
    // base de datos

    require '../../includes/funciones.php';
    $auth = estaAutenticado();
    if(!$auth){
        header("Location: /");
    }
    include("../../includes/config/database.php");
    $db = conectarDB();

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db,$consulta);
    //Validaciones
    $errores = [];

        $titulo = '';
        $precio = '';
        $imagen = '';
        $descripcion = '';
        $habitaciones = '';
        $wc = '';
        $estacionamientos = '';
        $vendedor_id = '';


    // Validar que los campos no estén vacíos
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        // echo '<pre>';
        // var_dump($_FILES);
        // echo '</pre>';

        $titulo = mysqli_real_escape_string($db,$_POST['titulo']);
        $precio = mysqli_real_escape_string($db,$_POST['precio']);
        $descripcion = mysqli_real_escape_string($db,$_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db,$_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db,$_POST['wc']);
        $estacionamientos = mysqli_real_escape_string($db,$_POST['estacionamientos']);
        $vendedor_id = mysqli_real_escape_string($db,$_POST['vendedor']);
        

        $imagen = $_FILES['imagen'];

        // var_dump($imagen['name']);

        // exit;

        if(!$titulo){
            $errores[] = "El título es obligatorio";
        }
        if($precio <= 0 || !$precio){
            $errores[] = "El precio es obligatorio y no puede ser menor o igual a 0";
        }

        if(strlen($descripcion) < 50){
            $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }
            //crear Carpeta

        if(!$habitaciones){
            $errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$wc){
            $errores[] = "El número de baños es obligatorio";
        }

        if(!$estacionamientos){
            $errores[] = "El número de estacionamientos es obligatorio";
        }

        if(!$vendedor_id || $vendedor_id === 0){
            $errores[] = "El vendedor es obligatorio";
        }

        if(!$imagen['name']) {
            $errores[] = "Tienes que anadir una imagen";
        }

        $medida = 1000 * 100;

        if($imagen['size'] > $medida) {
            $errores[] = "La imagen es muy pesada";
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        if(empty($errores)){
            //crear Carpeta
            $carpetaImagenes = '../../imagenes/';
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = md5(uniqid(rand(), true)).".jpg";
            var_dump($nombreImagen);

            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes.$nombreImagen);
            
            $query = "INSERT INTO propiedades(titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id, imagen) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamientos', '$vendedor_id', '$nombreImagen')";
            // echo $query;
            $result = mysqli_query($db,$query);

            if($result){
                header('Location: /admin?resultado=1');
            }
        }


    }
    require '../../includes/funciones.php';
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título de la propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen" accept="image/.jpg, image/.jpeg, image/.png" >

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" placeholder="Descripción de la propiedad" ><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la propiedad</legend>

                <label for="habitaciones">Habitaciones</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ejemplo: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños</label>
                <input type="number" id="wc" name="wc" placeholder="Ejemplo: 2" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamientos">Estacionamiento</label>
                <input type="number" id="estacionamientos" name="estacionamientos" placeholder="Ejemplo: 1" min="0" max="9" value="<?php echo $estacionamientos; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedor" id="vendedor" defaultValue="">
                    <option value="0">-- Seleccionar --</option>
                    <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedor_id === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre']." ".$row['apellido'];?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" class="boton boton-verde" value="Crear Propiedad">

        </form>
    </main>

<?php

    mysqli_close($db);

    incluirTemplate('footer');

?>