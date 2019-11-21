<main>
    <section>
        <div class="container">
            <h2>Modificar Cine</h2>
            <form action="<?php echo FRONT_ROOT ?>Cinema/Update" method="POST">
                <div>
                    <div>
                        <div>
                            <input type="hidden" name="cinema_id" value="<?php echo $cinema->getId(); ?>">
                            <label for="">Nombre</label>
                            <input type="text" name="cinema_name" value="<?php echo $cinema->getName(); ?>">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="">Direccion</label>
                            <input type="text" name="cinema_location" value="<?php echo $cinema->getLocation(); ?>">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <button type="submit" name="button">Editar</button>
                    </div>
                </div>
        </div>
        </form>
        </div>
    </section>
</main>