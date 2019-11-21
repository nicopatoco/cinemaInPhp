<nav>
     <ul>
          <li><a id="homeNavegation" class="active" href="http://localhost/Framework/">Home</a></li>
          <li><a href="<?php echo FRONT_ROOT ?>Movie/ShowListView">Cartelera</a></li>
          <form action ="<?php echo FRONT_ROOT ?>Movie/ShowListViewForGenre" method="post">
               <li>
                    <div class="dropdown">
                    <select name="genre" class="dropbtn">
                    <?php foreach($genreList as $key => $value) { ?>
                         <option value="<?php echo $value->getId(); ?>"> <?php echo $value->getDescription(); ?> </option>
                    <?php } ?>
                    </select>
                    <input type="submit">
                    </div>
               </li>
          </form>
          <form action ="<?php echo FRONT_ROOT ?>Movie/ShowListViewForDate" method="post">
               <li>
                    <div class="dropdown">
                    <select name="date" class="dropbtn">
                    <?php foreach($dateList as $value) { ?>
                         <option value="<?php echo $value; ?>"> <?php echo $value ?> </option>
                    <?php } ?>
                    </select>
                    <input type="submit">
                    </div>
               </li>
          </form>
          <li><a href="<?php echo FRONT_ROOT ?>User/Profile">Mi perfil</a></li>
          <li style="float:right"><a href="<?php echo FRONT_ROOT ?>User/LogOut">logout</a></li>
     </ul>
</nav>
</header>