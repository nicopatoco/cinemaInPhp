<main>
    <section>
        <div class="container">
            <h2>Listado de Cines</h2>
            <form action="<?php echo FRONT_ROOT . "Sales/SalesForCinema" ?>" method="POST">
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
                                    <button type="submit" class="btn btn-warning" name='cinema' value='<?php echo $value->getId(); ?>'> Ventas </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </section>
</main>