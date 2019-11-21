<main>
    <section>
        <div class="container">
            <h2>Modificar Sala</h2>
            <form action="<?php echo FRONT_ROOT ?>Room/Update" method="POST">
                <div>
                    <div>
                        <div>
                            <input type="hidden" name="room_id" value="<?php echo $room->getId(); ?>">
                            <label for="">Nombre</label>
                            <input type="text" name="room_name" value="<?php echo $room->getName(); ?>" required>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="">Capacidad</label>
                            <input type="number" name="capacity" value="<?php echo $room->getCapacity(); ?>" class="form-control" required>
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