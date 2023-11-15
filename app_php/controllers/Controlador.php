<?php 
session_start();
include('../models/Database.php');
$database = new Database();
$conn = $database->connect('mariadb',"root","rootpwd","app");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['login'])) {
        $log = $database->login($_POST['email'],$_POST['password'],$conn);
        $_SESSION['id_user'] = $log[0]['id_user'];
        header("Location:../index.php");
        unset($_POST['login']);
    }

    if(isset($_POST['logOut'])) {
        session_destroy();
        header("Location:../index.php"); 
        unset($_POST['logOut']);
    }

    if ($_GET['action'] == 'signup') {
        $datos = $database->retrieve($conn, "users");
        $emailDuplicado = false;
    
        foreach ($datos as $usuario) {
            $email = $usuario['email'];
    
            if ($email == $_POST['email']) {
                $emailDuplicado = true;
            }
        }
    
        if ($emailDuplicado) {
            header("Location:../views/emailUsado.php");
        } else {
            $database->insert($conn, $_POST['email'], $_POST['pass']);
            header("Location:../views/registroResponse.php");
        }
    }

    if($_GET['action'] == 'update'){
        if(!empty($_SESSION['id_user'])){
            $database->update($conn,$_POST['nom'],$_POST['cognoms'],$_POST['adreça'],$_POST['ciutat'],$_POST['codipostal'],$_POST['telefon'],$_SESSION['id_user']);
            header("Location:../views/payment.php"); 
        }
        
    }
}
?>
