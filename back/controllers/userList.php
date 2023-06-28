<?php  
// require_once '../config/function.php';
if (!connect()){

    header('location:index.php?action=login');
    exit();

}
    // require_once '../inc/header.inc.php';
    $users = execute("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);
    //    debug($_SESSION); die();

    if (isset($_GET['i'])){
        // gestion du changement de rôle
        if (isset($_GET['a']) && $_GET['a']=='role'){
            $user=execute("SELECT role FROM user WHERE id=:id", array(
                    ':id'=>$_GET['i']
            ))->fetch(PDO::FETCH_ASSOC);
            if ($user['role']=='ROLE_USER'){

                execute("UPDATE user SET role=:role WHERE id=:id",array(
                        ':role'=>'ROLE_ADMIN',
                    ':id'=>$_GET['i']
                ));
                            header('location:userList.php');
                            exit;
            }else{
                execute("UPDATE user 
                        SET role=:role 
                        WHERE id=:id",
                        array(
                            ':role'=>'ROLE_USER',
                            ':id'=>$_GET['i']
                    ));
            header('location:userList.php');
            exit;
            }
        }

        // mise en place de la suppression
        if (isset($_GET['a']) && $_GET['a']=='del'){
            execute("DELETE FROM user WHERE id=:id", array(
                ':id'=>$_GET['i']
            ));
            header('location:userList.php');
            exit;
        }
    }
        ?>


<table class="table table-dark table-striped">
        <thead>
        <tr>
                <th>#</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Photo</th>
                <th>Role</th>
                <th>Actions</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?=  $user['id_user']; ?></td>
            <td><?=  $user['email_user']; ?></td>
            <td>
                <a href="<?=  BASE_PATH.'back/editProfil.php?a=edit&i='.$user['id_user']; ?>" class="btn btn-success">Modifier</a>
                <a href="?a=del&i=<?=  $user['id_user']; ?>" class="btn btn-danger">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

        </tbody>
</table>


