<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>schedule.css">

<div class="container">
    <form action="<?php echo FRONT_ROOT ?>PaymentMethod/Add" method="post">

        <div>
            <label>Descripción:</label>
            <input type="text" name="description" required>
        </div>

        <div>
            <button type="submit" class="btn btn-success"> Agregar </button>
        </div>
    </form>
</div>