<div class="container">

    <h1> Profile </h1>

    <h3> Email:<?php echo $_SESSION["loggedUser"]->getEmail();?></h3>

    <form action="<?php echo FRONT_ROOT ?>User/Purchase" method="post">
        <div>
            <button type="submit" class="profileButton"> Mis compras </button>
        </div>
    </form>

</div>

