<?php 
    //importar la base de datos
    require __DIR__ . '/../config/database.php';
    $db = conectarDB();

    //consultar
    $query = "SELECT * FROM propiedades LIMIT ${limite}";
    $resultado = mysqli_query($db, $query);

    //obtener resultados
?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio">
        <picture>
            <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Anuncio 1" loading="lazy">
        </picture>
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad['titulo']; ?></h3>
            <p class="caja-truncada"><?php echo $propiedad['descripcion']; ?></p>
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
            <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Ver Propiedad</a>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<?php 
    //cerrar la conexion
    mysqli_close($db);
?>