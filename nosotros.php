<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>
    </main>
    <div class="contenedor contenido-nosotros">
        <div class="imagen">
            <picture srcset="build/img/nosotros.webp" type="image/webp"></picture>
            <picture srcset="build/img/nosotros.jpg" type="image/jpeg"></picture>
            <img src="build/img/nosotros.jpg" alt="sobre nosotros" loading="lazy">
        </div>
        <div class="texto-nosotros">
            <blockquote>
                25 anos de experiencia
            </blockquote>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur quidem fuga nulla aliquid sunt praesentium ut rerum, tenetur porro molestias, cumque eos repellat hic delectus illo? Obcaecati vitae tempore aut ratione cumque provident illo saepe sapiente suscipit magni voluptas impedit consequuntur, a architecto molestiae accusantium veritatis fuga. Vero omnis unde rem repellat quas laboriosam obcaecati cumque, laudantium amet, dolor eveniet, est expedita ad ipsa possimus quae nisi praesentium explicabo quam suscipit itaque. Explicabo vitae dicta tempora sint, animi voluptatibus quasi laudantium? Natus modi esse pariatur iusto debitis, architecto impedit rem aliquid nulla itaque vel temporibus excepturi ipsam error perferendis non!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem corrupti laboriosam doloribus veritatis unde minima sed eius voluptatibus vitae nesciunt repellat praesentium possimus, odio perferendis cupiditate distinctio ad pariatur minus repellendus animi vel architecto tenetur expedita? Ab itaque, enim nemo inventore et facilis asperiores accusamus recusandae est vero aut quaerat in labore cum. Odio dolorum eos quasi facere dicta? Ea, non iure. Veritatis placeat odit rerum unde id numquam nisi.</p>
        </div>
    </div>
    <section class="contenedor seccion">
        <h1>Mas sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    Nisi ullam id voluptate mollitia cum, eius odit architecto? Sunt, 
                    necessitatibus similique culpa sed.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    Nisi ullam id voluptate mollitia cum, eius odit architecto? Sunt, 
                    necessitatibus similique culpa sed.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    Nisi ullam id voluptate mollitia cum, eius odit architecto? Sunt, 
                    necessitatibus similique culpa sed.</p>
            </div>
        </div>
    </section>


<?php
    incluirTemplate('footer');
?>