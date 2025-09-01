<?php 
    include 'includes/config/database.php';

    $db = conectarDB();
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header('Location: /');
    }

    $query = "SELECT * FROM propiedades WHERE id = {$id}";

    $resultado = mysqli_query($db, $query);

    if($resultado->num_rows === 0) {
        header('Location: /');
    }

    $propiedad = mysqli_fetch_assoc($resultado);


    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

        <picture>
            <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la propiedad" loading="lazy">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur quidem fuga nulla aliquid sunt praesentium ut rerum, tenetur porro molestias, cumque eos repellat hic delectus illo? Obcaecati vitae tempore aut ratione cumque provident illo saepe sapiente suscipit magni voluptas impedit consequuntur, a architecto molestiae accusantium veritatis fuga. Vero omnis unde rem repellat quas laboriosam obcaecati cumque, laudantium amet, dolor eveniet, est expedita ad ipsa possimus quae nisi praesentium explicabo quam suscipit itaque. Explicabo vitae dicta tempora sint, animi voluptatibus quasi laudantium? Natus modi esse pariatur iusto debitis, architecto impedit rem aliquid nulla itaque vel temporibus excepturi ipsam error perferendis non!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem corrupti laboriosam doloribus veritatis unde minima sed eius voluptatibus vitae nesciunt repellat praesentium possimus, odio perferendis cupiditate distinctio ad pariatur minus repellendus animi vel architecto tenetur expedita? Ab itaque, enim nemo inventore et facilis asperiores accusamus recusandae est vero aut quaerat in labore cum. Odio dolorum eos quasi facere dicta? Ea, non iure. Veritatis placeat odit rerum unde id numquam nisi.</p>
            <p></p>
        </div>
    </main>

    
<?php include 'includes/templates/footer.php';
    mysqli_close($db);
?>
