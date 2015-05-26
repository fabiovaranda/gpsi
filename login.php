<?php
include('head.php');
?>

<?php
if(isset($_POST['Email'])){
    //estão a tentar fazer login    
    $email = $_POST['Email'];
    $password = $_POST['pwd'];
    
    include_once 'DataAccess.php';
    $da = new DataAccess();
    $res = $da->login($email, md5($password));
	 
    $row = mysqli_fetch_assoc($res);
    if($row['id'] != ""){
        session_start();
        $_SESSION['id'] = $row['id'];
		echo "<script>window.location='indexAdmin.php'</script>";
    }else{
       //email ou pwd errados
        echo "<script>alert('E-mail ou Palavra-Passe Errados')</script>";  
		echo "<script>window.location='indexAdmin.php'</script>";      
        
    }
}
?>

