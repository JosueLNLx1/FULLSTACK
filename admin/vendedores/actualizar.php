<?php
    require '../../includes/app.php';
    use App\Vendedor;

    estaAutenticado();

    $vendedor = new Vendedor;

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    if(!$id){
        header('Location: /admin');
    }

    $vendedor = Vendedor::find($id);
    

    $errores = Vendedor::getErrores();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $args = $_POST['vendedor'];
        $vendedor->sincronizar($args);
        $errores = $vendedor->validar();

        if(empty($errores)){
            $vendedor->guardar();
        }
    }

    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>  
        <a href="/admin" class="boton boton-verde">Volver</a>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST"  enctype="multipart/form-data">
            <?php  include '../../includes/templates/formulario_vendedores.php'  ?>

            <input type="submit" class="boton boton-verde" value="Guardar Cambios Vendedor(a)">

        </form>
    </main>

<?php

    mysqli_close($db);

    incluirTemplate('footer');
?>