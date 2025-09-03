<?php
    require '../../includes/app.php';
    use App\Vendedor;

    estaAutenticado();

    $vendedor = new Vendedor;

    $errores = Vendedor::getErrores();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $vendedor = new Vendedor($_POST['vendedor']);
        $errores = $vendedor->validar();

        if(empty($errores)){
            $vendedor->guardar();
        }

    }

    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>  
        <a href="/admin" class="boton boton-verde">Volver</a>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST" action="/admin/vendedores/crear.php" enctype="multipart/form-data">
            <?php  include '../../includes/templates/formulario_vendedores.php'  ?>

            <input type="submit" class="boton boton-verde" value="Registrar Vendedor(a)">

        </form>
    </main>

<?php

    mysqli_close($db);

    incluirTemplate('footer');

?>