<?php

use DAO\ScheduleDAO as ScheduleDAO;
$repo = new ScheduleDAO();
$scheduleList = $repo->GetAll();

?>

<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>rooms.css">

<main>
    <section>
        <div class="container">
            <h2>Listado de horarios</h2>

            <form action="<?php echo FRONT_ROOT . "Schedule/ShowAddView" ?>" method="POST">
                <button id="ButtonRoomAdd" type="submit" class="btn btn-success" name='add' value='<?php echo $room->getId(); ?>'> Agregar horario </button>
            </form>

            <form  action="<?php echo FRONT_ROOT . "Schedule/Select" ?>" method="POST">
                <table class="table bg-light">
                    <thead class="bg-dark text-white">
                        <th>Id</th>
                        <th>Fecha</th>
                    </thead>
                    <tbody><?php foreach ($scheduleList as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value->getId(); ?> </td>
                                <td><?php echo $value->getDate(); ?></td>
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
