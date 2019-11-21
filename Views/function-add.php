<div class="container">
    <form action="<?php echo FRONT_ROOT ?>MovieFunction/Add" method="post">
        <div>
            <label for="start">Fecha de inicio de la funcion:</label>
            <input type="date" name="date"value="2019-11-19" min="2018-01-01" required>
        </div>

        <div>
            <label for="appt-time">Horario de la funcion: </label>
            <input type="time" name="time" value="13:30" required>
        </div>

        <div>
            <label for="party">Cantidad de dias que se proyectara la pelicula:</label>
            <input name="amountdays" type="number" min="1" required>
        </div>

        <label for="party">Seleccionar pelicula:</label>
        <select name="movie" required>
        <?php foreach ($movieList as $key => $value) { ?>
            <option value="<?php echo $value->getId(); ?>"><?php echo $value->getName(); ?></option>
        <?php } ?>
        </select>
        
        <div>
            <label for="party">Seleccionar precio:</label>
            <select name="price" required>
            <?php foreach ($priceList as $key => $value) { ?>
                <option value="<?php echo $value->getId(); ?>"><?php echo $value->getDescription()."  $". $value->getAmount();?></option>
            <?php } ?>
            </select>
        </div>

        <div>
            <button type="submit" class="btn btn-success" name="room" value="<?php echo $room->getId(); ?>"> Agregar </button>
        </div>
    </form>
</div>