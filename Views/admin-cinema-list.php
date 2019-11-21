<main>
    <section>
        <div class="container">
            <h2>Listado de Cines</h2>
            <form action="<?php echo FRONT_ROOT ?>Cinema/ShowAddView">
                <button id="ButtonRoomAdd" type="submit" class="btn btn-success"> Agregar Cine </button>
            </form> 
            <form action="<?php echo FRONT_ROOT . "Cinema/Select" ?>" method="POST">
                <table class="table bg-light">
                    <thead class="bg-dark text-white">
                        <th>Nombre</th>
                        <th>Ubicacion</th>
                    </thead>
                    <tbody><?php foreach ($cinemaList as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value->getName(); ?> </td>
                                <td><?php echo $value->getLocation(); ?></td>
                                <td>
                                    <button type="submit" class="btn btn-success" name='rooms' value='<?php echo $value->getId(); ?>'> Admin </button>
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