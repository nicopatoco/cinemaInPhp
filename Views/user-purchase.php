<h1>Mis compras</h1>
<hr>
<div class="container">
    <?php foreach($userEntries as $key =>$entry){ ?>

    <table class="profileTable">
    <thead>
        <tr>
            <th class="profileTdTh"></th>
            <th class="profileTdTh"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="profileTdTh">
                <h3>Ticket Nro:<?php echo " ".$entry->getId();?><h3>
                <h3>Cine:<?php echo " ".$entry->getCinema()->getName(); ?><h3>
                <h3>Sala:<?php echo " ".$entry->getRoom()->getName();?><h3>
                <h3>Fecha y horario:<?php echo " ".$entry->getFunction()->getSchedule()->getDate();?><h3>
                <h3>Pelicula:<?php echo " ".$entry->getMovie()->getName();?><h3>
                <h3>Precio:<?php echo " ".$entry->getPrice()->getAmount();?><h3>
                <h3>Descuento:<?php echo " ".$entry->getDiscount(); ?><h3>
                <h3>Total:<?php echo " ".$entry->getTotal(); ?><h3>
            </td>
            <td class="profileTdTh">
                <img style="width:250px;height:250px;" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=
                <?php echo "Ticket number: ".$entry->getId()." Cinema: ".$entry->getCinema()->getName().
                " Room: ".$entry->getRoom()->getName()." Date: ".$entry->getFunction()->getSchedule()->getDate();?>">
            </td>
        </tr>
    </tbody>
    </table>
    <hr>
    <?php }?>   
</div>



