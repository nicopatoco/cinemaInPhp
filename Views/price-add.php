<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>schedule.css">

<div class="container">
    <form action="<?php echo FRONT_ROOT ?>Price/Add" method="post">
        <div>
            <label>Precio:</label>
            <input name="amount" type="number" min="0.00" max="1000.00" step="0.01" required>
        </div>

        <div>
            <label>Descripción:</label>
            <input type="text" name="description" required>
        </div>

        <div>
            <button type="submit" class="btn btn-success"> Agregar </button>
        </div>
    </form>
</div>