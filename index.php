<?php $error = false;
require 'components/dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dateofbirth = $_POST['dob'];
    $username = substr($firstname, 0, 2) . substr($lastname, 0, 2) . rand(20, 1000);
    $checkemail = "SELECT * FROM `All_Users` WHERE `Email` = '$email'";
    $result = mysqli_query($conn, $checkemail);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0) {
        $error = true;
    } else {

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "Insert into `User_data` values ('$firstname', '$lastname', '$dateofbirth', '$email','$hash',current_timestamp(),'$username')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
            header("Location: Login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>

<body>





    <div class="row">
        <div class="col-6 this">
            <div class="leftside">
                <center>


                    <img src="final.png " alt="" style="height : 250px; width:500px;margin-bottom:0px">


                    <div class="row">
                        <div class="col mb-5">
                            <div class="card" style="width: 16rem;height:16rem; border-radius : 30px;">
                                <center><img src="portfolio.png" class="card-img-top" alt="..." style="height:150px;width : 150px;margin-top:25px"></center>
                                <div class="card-body">
                                    <p class="card-text">Visualise Your Expenditures</p>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="card" style="width: 16rem; border-radius : 30px;height:16rem;">
                                <center><img src="savings.png" class="card-img-top" alt="..." style="height: 150px;width : 150px; margin-top:25px"></center>
                                <div class="card-body">
                                    <p class="card-text">Take Control of Your<br> Money</p>
                                </div>
                            </div>
                </center>


            </div>
        </div>


        <div class="col col-ryt">
            <div class="rightside">
                <? if ($error) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                ?>
                <div class="lon"><a href="Login.php"><button type="button" class="btn btn-warning" style = "margin-top:10px;margin-left:550px">Log in</button></a></center></div>


                <form action="index.php" method="post">
                    <div class="container col-lg-9" id="cont">
                        <div class="col-md mb-4">
                            <center>
                                <h1 style="color:#121212; padding-top:10px;"><b>Sign Up</b></h1>
                            </center>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInputGrid" placeholder="tarke" name="firstname" required>
                                    <label for="floatingInputGrid">First Name</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInputGrid" placeholder="Last name" name="lastname" required>
                                    <label for="floatingInputGrid">Last Name</label>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="ex@mail.com" name="email" required>
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="floatingInput" name="dob" required>
                                <label for="floatingInput">Date of Birth</label>
                            </div>

                        <center> <button type="submit" class="btn btn-success mb-2">Let's Go!</button>
                        
                       
                    </div>

                </form>
               


            </div>

        </div>



    </div>

    </div>

</body>

</html>