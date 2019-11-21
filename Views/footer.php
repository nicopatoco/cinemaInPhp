</body>
<footer>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>footer.css">
    <div class="container">
        <?php
        if(isset($_SESSION["loggedUser"])){
            echo "Bienvenido " .$_SESSION["loggedUser"]->getEmail();
        }
        ?>
        copyright &copy; 2019. Francisco Franco , Nicolas Herrera.
    </div>
</footer>

</html>