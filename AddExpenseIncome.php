<?php
session_start();
if (!isset($_SESSION['loggedin'])|| $_SESSION['loggedin'] != true) {
  header("location:Dashboard.php");
  exit;
}
require 'components/dbconnect.php';
if (isset($_POST['btnPostMe1'])) {
 
  $amount = $_POST['expense'];
  $category = $_POST['expenselect'];
  $username = $_SESSION['username'];
  if($category != "Choose Category of Expense"){
  
  $sql = "Insert into `Expenses` values ('$username','$amount','$category',current_timestamp())";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert' >
    <strong>Success!</strong> Success! Your expense has been added.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  } else {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' >
    <strong>Error!</strong> Sorry, Could not add your expense.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
}
else{echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Error!</strong> Your Please enter Category
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";}

}
if (isset($_POST['btnPostMe2'])) {
  $amount = $_POST['income'];
  $category = $_POST['incomeselect'];
  $username = $_SESSION['username'];
  if($category != "Choose Category of Expense"){
  
  $sql = "Insert into `Income` values ('$username','$amount','$category',current_timestamp())";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert' >
    <strong>Success!</strong> Your income has been added.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  } else {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' >
    <strong>Error!</strong> Sorry, Could not add your income.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
  }
  else{echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Error!</strong> Your Please enter Category
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";}

 
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="Addexpense.css">
  <title>Document</title>


</head>

<body>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Expense Tracker</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="Dashboard.php">Dashboard</a>
          <a class="nav-link" href="components/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </nav>
  </div>


  <script type="text/javascript">
    function DescribeExpense (val) {
      var element = document.getElementById('expensedescription');
      if (val == 'Other') {
        element.style.display = 'block';

      } else
        element.style.display = 'none';

    }

    function DescribeIncome(val) {
      var element = document.getElementById('incomedescription');
      if (val == 'Other') {
        element.style.display = 'block';

      } else
        element.style.display = 'none';

    }
  </script>

  <div class="container">

    <div class="row justify-content-center">

      <div class="col">

        <form method="post" action="AddExpenseIncome.php" onsubmit="return true">

          <input type="number" name="expense" id="expenses">
          <select class="form-select" aria-label="Default select" name="expenselect" onchange='DescribeExpense(this.value);'>
            <option selected>Choose Category of Expense</option>
            <option value="Travel">Travel</option>
            <option value="Dining Out">Dining Out</option>
            <option value="Food">Food</option>
            <option value="Shopping">Shopping</option>
            <option value="Entertainment">Entertainment</option>
            <option value="Health">Health</option>
            <option value="Education">Education</option>
            <option value="Bills">Bills</option>
            <option value="Transfers">Transfers</option>
            <option value="Other">Other</option>
          </select>
          <input type="text" name="description" id="expensedescription" style='display:none;' placeholder="Description" />


          <button type="submit" name="btnPostMe1" id="ex"> Add Expense</button>


      </div>


      <div class="col">

        <input type="text" name="income" id="incomestream" onsubmit="return true">
        <select class="form-select" aria-label="Default select example" name="incomeselect" onchange='DescribeIncome(this.value);'>
          <option selected>Choose Category of Income</option>
          <option value="Salary">Salary</option>
          <option value="Investment">Investment</option>
          <option value="Transfers">Transfers</option>
          <option value="Other">Other</option>



        </select>
        <input type="text" name="description" id="incomedescription" style='display:none;' placeholder="Description" />

        <button type="submit" name="btnPostMe2" value="Confirm"> Add Income</button>


        </form>
      </div>
    </div>


  </div>



</body>

</html>