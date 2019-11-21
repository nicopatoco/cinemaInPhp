<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>rooms.css">

<main>
    <section>
        <div class="container">
            <h2>Formas de pago</h2>

            <form action="<?php echo FRONT_ROOT . "PaymentMethod/ShowAddView" ?>" method="POST">
                <button id="ButtonRoomAdd" type="submit" class="btn btn-success" name='price'> Agregar Forma de pago </button>
            </form>

            <form  action="<?php echo FRONT_ROOT . "PaymentMethod/Select" ?>" method="POST">
                <table class="table bg-light">
                    <thead class="bg-dark text-white">
                        <th>Description</th>
                    </thead>
                    <tbody><?php foreach ($paymentList as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value->getPaymentName(); ?></td>
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

