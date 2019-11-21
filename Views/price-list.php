<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>rooms.css">

<main>
    <section>
        <div class="container">
            <h2>Listado de Precios</h2>

            <form action="<?php echo FRONT_ROOT . "Price/ShowAddView" ?>" method="POST">
                <button id="ButtonRoomAdd" type="submit" class="btn btn-success" name='price'> Agregar Precio </button>
            </form>

            <form  action="<?php echo FRONT_ROOT . "Price/Select" ?>" method="POST">
                <table class="table bg-light">
                    <thead class="bg-dark text-white">
                        <th>Amount</th>
                        <th>Description</th>
                    </thead>
                    <tbody><?php foreach ($priceList as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value->getAmount(); ?></td>
                                <td><?php echo $value->getDescription(); ?></td>
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

