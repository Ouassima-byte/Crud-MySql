<?php
session_start();
if($_SESSION['valid'] === '' )
{  
    header('location: login.php');
    exit();
}
if(isset($_POST['logOut'])){
    $_SESSION['valid']='';
    header('location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php require_once 'process.php' ;?>
    <?php  if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
    </div>
    <?php endif ?>
    <div class="container">
        <?php 
         $mysqli=new  mysqli('localhost','root','','souqStock') or die(mysqli_error($mysqli));
        if(isset($_POST['filter'])){
            $result=$mysqli->query("SELECT * FROM produit WHERE quantite_en_stock<quantite_minimale")or die ($mysqli->error);
        }else{
            $result=$mysqli->query("SELECT * FROM Produit")or die ($mysqli->error);
        }
           
            
        ?>
        <form method="POST">
        <button class="btn bg-success float-right ml-5 mt-3 text-light" name="logOut">logOut</button>
        </form>
        <div class="row justify-content-center">
        
            <table class="table">
                <thead>
                    <tr>
                        <th>Ref</th>
                        <th>lib</th>
                        <th>Q-m</th>
                        <th>Q-s</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <?php 
                    while($row=$result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['reference']?></td>
                    <td><?php echo $row['libelle']?></td>
                    <td><?php echo $row['quantite_minimale']?></td>
                    <td><?php echo $row['quantite_en_stock']?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['reference']; ?>"
                         class="btn btn-success">Edit</a>
                        <a href="index.php?delete=<?php echo $row['reference']; ?>" 
                        class="btn btn-dark">delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <div class="row justify-content-center">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Ref :</label>
                    <input type="text" class="form-control" name="Ref" value="<?php echo $reff;?>">
                </div>
                <div class="form-group">
                    <label for="">libelle :</label>
                    <input type="text" name="lib"class="form-control"
                    value="<?php echo $libb;?>">
                </div>
                <div class="form-group">
                    <label for="">q-m :</label>
                    <input type="text" name="qM" class="form-control"value="<?php echo $QMm;?>">
                </div>
                <div class="form-group">
                    <label for="">q-S :</label>
                    <input type="text" name="qS" class="form-control"value="<?php echo $QSs;?>">
                </div>
                <div class="form-group">
                <?php if($update ==true): ?>
                    <button type="submit" class="btn btn-info"name="update">Update</button>
                <?php else:?>
                    <button type="submit" class="btn btn-primary"name="save">Save</button>
                    <?php endif;?>
                </div>
                <button type="submit" class="btn btn-dark justify-content-center"name="filter">Filter</button>
            </form>
        </div>
    </div>
</body>
</html>
