<?php
session_start();

$mysqli=new mysqli('localhost','root','','registration_form');

$fname=mysqli_real_escape_string($mysqli,$_POST['fname']);
$lname=mysqli_real_escape_string($mysqli,$_POST['lname']);
$email=mysqli_real_escape_string($mysqli,$_POST['email']);
$password=mysqli_real_escape_string($mysqli,$_POST['password']);

if(strlen($fname)<2){
    echo "fname";
}
else if(strlen($lname)<2){
    echo "lname";
}
else if(filter_var($email,FILTER_VALIDATE_EMAIL)===false){
    echo "eformat";
}
else if(strlen($password)<=4){
    echo "pshort";
}
else{
    $spassword=password_hash($password,PASSWORD_BCRYPT,array('cost=>12'));
    $query="select * from users where email='$email'";
    $result=mysqli_query($mysqli,$query) or die(mysqli_error());
    if(mysqli_num_rows($result)<1)
    {
        $insert_row=$mysqli->query("insert into users(fname,lname,email,password) values ('$fname','$lname','$email','$spassword')");
        if($insert_row)
        {
            $_SESSION['register']=$mysqli->insert_id;
            $_SESSION['fname']=$fname;
            $_SESSION['lname']=$lname;
    
            echo 'true';
        }
    }
    else{
        echo 'false';
    }
}
?>