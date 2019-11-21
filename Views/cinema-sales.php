<h1>Ventas</h1>
<hr>

<div class="container">
<tr>
    <h3>Cine :<?php echo " ".$cinema->getName(); ?><h3>
    <?php foreach ($cinema->getRoomsList() as $key => $value) {
        ?><h3> Sala: <?php echo $value->getName(); ?> <h3> <?php
    } ?>
    <h3>Ventas:<?php echo " ".$sales ?><h3>
    <h3>Descuentos:<?php echo " ".$discount ?><h3>
    <h3>Recaudación total:<?php echo " ".$total ?><h3>
</td>
</div>
<hr>