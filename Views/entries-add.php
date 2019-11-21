<div class="container">
    <div>
        <h3> <?php echo $_SESSION["loggedUser"]->getEmail(); ?> ,gracias por utilizar nuesto servicio de compra online. </h3>
    </div>
    <div>
        <h4> Funciones para: <?php echo $functionList[0]->getMovie()->getName(); ?></h4>
    </div><br>
    <form action="<?php echo FRONT_ROOT ?>Entry/Payment" method="post">
    
        <label for="party">Seleccione su fecha y cine:</label>
        <select name="function" onchange="getFunctionId()" required>
        <?php foreach ($functionList as $key => $function) { ?>
            <option id="date" value="<?php echo $function->getId(); ?>"><?php echo $function->getSchedule()->getDate()."  Cine:".$function->getRoom()->getCinema()->getName(); ?></option>
        <?php } ?>
        </select><br>

        <div>
            <label for="party">Cantidad entradas:</label>
            <input name="amount" id="QTY" type="number" min="1" max="5" onchange="multiply()" required>
        </div>

        <div>
            <label for="party">Precio por ticket:$</label>
            <input type="text" name="priceAmount" id="PPRICE" value="<?php echo $function->getPrice()->getAmount(); ?>" readonly/>
        </div>

        <div>
            <label for="party">Discount:$ </label>
            <input type="text" name="discount" id="DISCOUNT" readonly />
        </div>

        <div>
            <label for="party">Total:$ </label>
            <input type="text" name="total" id="TOTAL" readonly />
        </div><br>

        <label for="party">Seleccionar medio de pago:</label>
        <select name="paymentmethod" required>
            <option value="Tarjeta de Credito">Tarjeta de Credito</option>
            <option value="Tarjeta de Debito">Tarjeta de Debito</option>
        </select>

        <br><br>
        <div>
            <button type="submit" class="btn btn-success"> Comprar </button>
        </div>
        <br><br><br><br><br><br>
        <input name="price" type="hidden" value="<?php echo $function->getPrice()->getId();?>">
    </form>
</div>

