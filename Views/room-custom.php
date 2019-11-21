<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>rooms.css">

<main>
    <section>
        <div class="container">
            <h2>Listado de salas</h2>

            <form action="<?php echo FRONT_ROOT . "Room/ShowAddView" ?>" method="POST">
                <button id="ButtonRoomAdd" type="submit" class="btn btn-success" name='rooms' value='<?php echo $cinema->getId(); ?>'> Agregar sala </button>
            </form> 

            <form  action="<?php echo FRONT_ROOT . "Room/Select" ?>" method="POST">
                <table class="table bg-light">
                    <thead class="bg-dark text-white">
                        <th>Nombre</th>
                        <th>Capacidad</th>
                    </thead>
                    <tbody><?php foreach ($roomList as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value->getName(); ?> </td>
                                <td><?php echo $value->getCapacity(); ?></td>
                                <td>
                                    <button type="submit" class="btn btn-success" name='function' value='<?php echo $value->getId(); ?>'> Funciones </button>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-warning" name='edit' value='<?php echo $value->getId(); ?>'> Editar </button>
                                </td>
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