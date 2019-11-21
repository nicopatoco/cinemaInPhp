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
          <li style="float:right"><button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button></li>
          <li style="float:right"><button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Sign Up</button></li>
     </ul>
</nav>
</header>

<div id="id01" class="modal">
     <form class="modal-content animate" action="<?php echo FRONT_ROOT ?>User/Checklogin" method="post">

          <div class="imgcontainer">
               <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
               <img src="<?php echo CSS_PATH ?>loginImg.jpg" alt="Avatar" class="avatar">
          </div>

          <div class="container">
               <label for="uname"><b>Username</b></label>
               <input type="email" placeholder="Enter Username" name="username" required>

               <label for="psw"><b>Password</b></label>
               <input type="password" placeholder="Enter Password" name="password" required>

               <button type="submit">Login</button>
               <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
               </label>
          </div>

          <div class="container">
               <button type="button" onclick="window.location.href='<?php echo FRONT_ROOT ?>User/CheckFacebookLogin'" >Login with facebook</button>
          </div>

          <div class="container" style="background-color:#f1f1f1">
               <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
               <span class="psw">Forgot <a href="#">password?</a></span>
          </div>
     </form>
</div>

<div id="id02" class="modal">
     <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
     <form class="modal-content" action="<?php echo FRONT_ROOT ?>User/Add" method="post">
          <div class="container">
               <h1>Sign Up</h1>
               <p>Please fill in this form to create an account.</p>
               <hr>
               <label for="email"><b>Email</b></label>
               <input type="email" placeholder="Enter Email" name="username" required>

               <label for="psw"><b>Password</b></label>
               <input type="password" placeholder="Enter Password" name="password" required>

               <label for="psw-repeat"><b>Repeat Password</b></label>
               <input type="password" placeholder="Repeat Password" name="secondPassword" required>

               <label>
                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
               </label>

               <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

               <div class="clearfix">
                    <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                    <button type="submit" class="signupbtn">Sign Up</button>
               </div>
          </div>
     </form>
</div>