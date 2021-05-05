<?php 
// session_start();
$mysqli=new  mysqli('localhost','root','','souqStock') or die(mysqli_error($mysqli));
$update=false;
$reff='';
$libb='';
$QSs='';
$QMm='';
$ID='';

if(isset($_POST['save'])){
  $Ref=$_POST['Ref'];
  $Lib=$_POST['lib'];
  $Qm=$_POST['qM'];
  $Qs=$_POST['qS'];
  if($Ref==''|| $Lib=='' || $Qs=='' ||$Qm==""){
    echo "errror";
  }
  else{
    $mysqli -> query("INSERT INTO Produit (reference,libelle,quantite_minimale,quantite_en_stock) VALUES ('$Ref','$Lib','$Qm','$Qs')")or die($mysqli->error);
    $_SESSION['message']="Record has been SAVED !";
    $_SESSION['msg_type']="success";
    header("location: index.php");
    exit();
  }
}
if(isset($_GET['delete'])){
  $ref=$_GET['delete'];
  if($mysqli -> query("DELETE FROM produit WHERE reference ='$ref'")){
    $_SESSION['message']="Record has been DELETED !";
    $_SESSION['msg_type']="danger";
    header("location: index.php");
    exit();
  }
  else
  echo "ERROR";
}
if(isset($_GET['edit'])){
  $r=$_GET['edit'];
  $update=true;
  $result =$mysqli->query("SELECT * FROM produit WHERE reference ='$r'");
  $row=$result->fetch_array();
  $ID=$row['reference'];
  $reff=$row['reference'];
  $libb=$row['libelle'];
  $QSs=$row['quantite_en_stock'];
  $QMm=$row['quantite_minimale'];
}
if(isset($_POST['update'])){
  $Ref=$_POST['Ref'];
  $Lib=$_POST['lib'];
  $Qm=$_POST['qM'];
  $Qs=$_POST['qS'];
  $mysqli->query("UPDATE produit SET reference='$Ref',libelle='$Lib',quantite_minimale='$Qm', quantite_en_stock='$Qs' WHERE reference='$ID'")or die($mysqli->error);
  $_SESSION['message']="Record has been UPDATED !";
  $_SESSION['msg_type']="warning";
  header("location: index.php");
  exit();
}


?>