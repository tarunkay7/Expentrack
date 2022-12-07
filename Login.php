<?php
    $error = false;
    $success = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require 'components/dbconnect.php';
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `User_data` WHERE Email = '$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num==1)
        {
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($password,$row['Password'])){
                    $success = true;
                    session_start();

                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['username'] = $row['User Name'];
                    $_SESSION['name']  = $row['First Name']." ".$row['Last Name'];
                    header("location: Dashboard.php");
                }
                else{
                    $error = true;
                }
        }
    }
        else $error = true;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
<?php 
    if($error){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Invalid Credentials
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    ?>

<form action="Login.php" method="post">
                    <div class="container col-lg-9" id="cont">
                        <div class="col-md mb-4">
                            <center>
                                <h1 style="color:#121212; padding-top:10px;"><b>Log in</b></h1>
                            </center>
                        </div>
                        <div class="row g-2">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="ex@mail.com" name="email" required>
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                                <label for="floatingPassword">Password</label>

                            </div>
                            <center> <button type="submit" class="btn btn-success mb-2">Let's Go!</button>
                        </div>
                    </div>
</form>

</body>

</html>