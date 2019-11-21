<?php

use DAO\UserDAO as UserDAO;

$repo = new UserDAO();
$userList = $repo->GetAll();
?>
<main>
    <section>
        <div class="container">
            <h2>Listado de Usuarios</h2>
            <form action="<?php echo FRONT_ROOT . "User/Select" ?>" method="POST">
                <table class="table bg-light">
                    <thead class="bg-dark text-white">
                        <th>Email</th>
                        <th>Password</th>
                        <th>SecondPassword</th>
                    </thead>
                    <tbody><?php foreach ($userList as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value->getEmail(); ?> </td>
                                <td><?php echo $value->getPassword(); ?></td>
                                <td><?php echo $value->getSecondPassword(); ?></td>
                                <td>
                                    <button type="submit" class="btn btn-warning" name='edit' value='<?php echo $value->getId(); ?>'> Editar </button>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-danger" name='delete' value='<?php echo $value->getId(); ?>'> Eliminar </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </section>
</main>