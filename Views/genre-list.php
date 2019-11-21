<?php

use DAO\GenreDAO as GenreDAO;

$repo = new GenreDAO();
$genreList = $repo->GetAll();
?>
<main>
    <section>
        <div class="container">
            <h2>Listado de Generos</h2>
            <table class="table bg-light">
                <thead class="bg-dark text-white">
                    <th>Nombre</th>
                </thead>
                <tbody><?php foreach ($genreList as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value->getDescription(); ?> </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>