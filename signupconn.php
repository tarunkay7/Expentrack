<?php require 'components/dbconnect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $dateofbirth = $_POST['dateofbirth'];
        $username = substr($firstname,0,2).substr($lastname,0,2).rand(20,1000);
        $checkemail = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($conn,$checkemail);
        $numRows = mysqli_num_rows($result);

        if($numRows > 0){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Email already exists.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }

        else{
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "Insert into `All_Users` values ('$firstname', '$lastname', '$dateofbirth', '$email', '$phonenumber','$hash',current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $showAlert = true;
                    header("Location: /ExpenTrack/Login.php");
                    exit();
        }
    }
}
?>