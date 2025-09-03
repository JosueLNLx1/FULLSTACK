<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
        </picture>
        <h2>Llene el formulario de contacto</h2>
        <form class="formulario">
            <fieldset>
                <legend>Informacion personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu nombre" id="nombre">

                <label for="email">email</label>
                <input type="email" placeholder="e-mail" id="email">

                <label for="telefono">Telefono</label>
                <input type="tel" placeholder="Telefono" id="telefono">

                <label for="mensaje">Mensaje:</label>
                <textarea name="mensaje" id="mensaje"></textarea>
            </fieldset>
            <fieldset>
                <legend> Informacion sobre la propiedad</legend>
                <label for="opciones">Vende o compra:</label>
                <select name="opciones" id="opciones">
                    <option value="" disabled selected>---Seleccione---</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>
                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto">

            </fieldset>
            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser contactado</p>
                <div class="form-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" value="telefono" id="contactar-telefono" name="contacto">
                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto">
                </div>
                <p>Si eligio telefono elija la fecha y hora para ser contactado</p>
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha">
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora" min="09:00" max="18:00">
            </fieldset>
            <input type="submit" name="Enviar" id="enviar" placeholder="Enviar" class="boton-verde" value="Enviar">
        </form>
    </main>

    
<?php
    incluirTemplate('footer');
?>