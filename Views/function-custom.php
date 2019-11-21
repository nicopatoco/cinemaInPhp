<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>rooms.css">

<main>
    <section>
        <div class="container">
            <h2>Listado de Funciones</h2>

            <form action="<?php echo FRONT_ROOT . "MovieFunction/ShowAddView" ?>" method="POST">
                <button id="ButtonRoomAdd" type="submit" class="btn btn-success" name='room' value='<?php echo $room->getId(); ?>'> Agregar funcion </button>
            </form>

            <form  action="<?php echo FRONT_ROOT . "MovieFunction/Select" ?>" method="POST">
                <table class="table bg-light">
                    <thead class="bg-dark text-white">
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Sala</th>
                        <th>Movie</th>
                    </thead>
                    <tbody><?php foreach ($functionList as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value->getId(); ?> </td>
                                <td><?php echo $value->getSchedule()->getDate(); ?></td>
                                <td><?php echo $value->getRoom()->getName(); ?></td>
                                <td><?php echo $value->getMovie()->getName(); ?></td>
                                <td>
                                    <button type="submit" class="btn btn-danger" name='delete' value='<?php echo $value->getId(); ?>'> Eliminar </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </section>
</main>

