<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar sala</h2>
               <form action="<?php echo FRONT_ROOT ?>Room/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="name" value="" class="form-control" required>
                              </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Capacidad</label>
                                   <input type="text" name="capacity" value="" class="form-control" required>
                              </div>
                         </div>
                    <button type="submit" name="cinemaId" class="btn btn-dark ml-auto d-block" value="<?php echo $this->cinemaId; ?>">Agregar</button>
               </form>
          </div>
     </section>
</main>