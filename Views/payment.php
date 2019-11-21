<form action="<?php echo FRONT_ROOT ?>Entry/Add" method="post">

        <input name="function" type="hidden" value="<?php echo $_POST['function'] ;?>">
        <input name="amount" type="hidden" value="<?php echo $_POST['amount'] ;?>">
        <input name="price" type="hidden" value="<?php echo $_POST['price'] ;?>">
        <input name="discount" type="hidden" value="<?php echo $_POST['discount'] ;?>">
        <input name="total" type="hidden" value="<?php echo $_POST['total'] ;?>">
        <input name="paymentmethod" type="hidden" value="<?php echo $_POST['paymentmethod'] ;?>">

        <div>
            <label for="party">Nombre en la tarjeta </label>
            <input type="text" id="card" name="cardname" placeholder="Juan Perez" required>
        </div>
        <div>
            <label for="ccnum">Numeros de la tarjeta</label>
            <input type="text" id="card" name="cardnumber" minlength="16" maxlength="16" placeholder="1111-2222-3333-4444" required>
        </div>
        <div>
            <label for="expmonth">Mes de vencimiento</label>
            <input type="text" id="card" name="expmonth" placeholder="Septiembre" required>
        </div>
        <div>
            <label for="expyear">Año de vencimiento</label>
            <input type="text" id="card" name="expyear" placeholder="2018" required>
        </div>
        <div>
            <label for="cvv">CVV</label>
            <input type="text" id="card" name="cvv" placeholder="352" minlength="3" maxlength="3" required>
        </div>

        <br><br>
        <div>
            <button type="submit" class="btn btn-success"> Comprar </button>
        </div>
        <br><br><br><br><br><br>
</form>