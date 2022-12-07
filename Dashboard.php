<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location:Login.php");
  exit;
 
}

require 'components/dbconnect.php';
$username = $_SESSION['username'];
$sql = "Select SUM(Expense) from Expenses where Username = '$username'";
$result = mysqli_query($conn, $sql);
$totalExpense = 0;
if($result){
  $row = mysqli_fetch_assoc($result);
  $totalExpense = $row['SUM(Expense)'];
  if($totalExpense == null){
    $totalExpense = 0;
    
  }
$sql2 = "Select SUM(Income) from Income where Username = '$username' ";
$result2 = mysqli_query($conn, $sql2);
$totalIncome = 0;
if($result2){
  $row2 = mysqli_fetch_assoc($result2);
  $totalIncome = $row2['SUM(Income)'];
  if($totalIncome == null){
    $totalIncome = 0;
  }
}
}
else{
  echo "Error";
}


?> 

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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="dashboard.css">

 
 
  <title>Document</title>
</head> 

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
      <img src="https://img.icons8.com/ios/50/000000/menu.png" width="35" height="35" class="d-inline-block align-top" alt="">
</a>
    
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-brand">
       <h2>Dashboard</h2>
      </div>
    </div>
    <span class="navbar-text"> 
      <a href="Logout.php" class="btn btn-outline-warning">Logout</a>
      
      </span>
  </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h3 class="offcanvas-title" id="offcanvasExampleLabel"><?= "Hello,"." ".ucwords($_SESSION['name'])?> </h3>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="AddExpenseIncome.php">Add Expense/Income</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Logout.php">Logout</a>
      </li>
    </ul>
    
  </div>
</div>

<div class="container" style="margin-top:30px">
  <section class="1">
  <div class="row"style="margin-bottom:30px">
    <div class="col-6 col-md-4 " style= "border-style:solid;border-width:2px">Income: Rupees <?=$totalIncome?></div>
    <div class="col-6 col-md-4"style= "border-style:solid;border-width:2px" >Expenses: <?=$totalExpense?></div>
    <div class="col-6 col-md-4"style= "border-style:solid;border-width:2px" >Savings: <?=$totalIncome-$totalExpense?></div>

  </div>

  <div class="row"style="margin-bottom:30px">
    <div class="col-md-4"style= "border-style:solid;border-color:green;border-width:2px"><canvas id="myChart"></canvas></div>
    <div class="col-6 col-md-8"style= "border-style:solid;border-color:green;border-width:2px"><canvas id="Monthly Expense"></div>
  </div>
  </section>
  <section class="2">

 

 
  <div class="row">
    <div class="col-6"style= "border-style:solid;border-color:blue">Recent Transactions
    <table class="table table-striped">
  <thead>
    <tr>
     <th scope="col">S.No</th>
      <th scope="col">Amount</th>
      <th scope="col">Category</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sno=0;
    $sql3 = "Select * from Expenses where Username = '$username' LIMIT 10 ";
    $result3 = mysqli_query($conn, $sql3);
    if($result3){
      while($row3 = mysqli_fetch_assoc($result3)){
        $timestamp = strtotime($row3['Date_Time']);
        $date = date('d-m-Y', $timestamp);
        echo "<tr>";
        echo "<td>".++$sno."</td>";
        echo '<td>'.$row3['Expense'].'</td>';
        echo '<td>'.$row3['Category'].'</td>';
        echo '<td>'.$date.'</td>';
        echo'</tr>';
      }
    }
?>
 </tbody>
    </div>
  </div>   
  






<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
$sql4 = "Select sum(Expense) as Expense,Category from Expenses where Username = '$username' group by Category";
$result = mysqli_query($conn, $sql4);
if($result){
  while($row = mysqli_fetch_assoc($result)){
    $categories[] = $row['Category'];
    $data[] = $row['Expense'];
  }
}
else{
    echo "Error";
  }

  $sql5 = "Select sum(Expense) as Expense,Monthname(Date_Time) as Month from Expenses where Username = '$username' group by Month(Date_Time)";
  $result2 = mysqli_query($conn, $sql5);
  if($result2){
    while($row2 = mysqli_fetch_assoc($result2)){
      $months[] = $row2['Month'];
      $data2[] = $row2['Expense'];
    }
  }
  else{
      echo "Error";
    }

  //find sum of income monthly
  $sql6 = "Select sum(Income) as Income,Monthname(Date_Time) as Month from Income where Username = '$username' group by Month(Date_Time)";
  $result3 = mysqli_query($conn, $sql6);
  if($result3){
    while($row3 = mysqli_fetch_assoc($result3)){
      $months2[] = $row3['Month'];
      $data3[] = $row3['Income'];
    }
  }
  else{
      echo "Error";
    }
  
  ?>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($categories); ?>,
        datasets: [{
            label: 'Expense',
            data: <?php echo json_encode($data); ?>,
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(54, 162, 35)',
                'rgba(255, 206, 86)',
                'rgba(75, 192, 192)',
                'rgba(153, 102, 255 )',
                'rgba(255, 159, 64)'

                
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            
        }
    }
});



var ctx2 = document.getElementById('Monthly Expense').getContext('2d');
var monthex = new Chart(ctx2, {
  type: 'line',
    data: {
      labels: <?php echo json_encode($months); ?>,
      datasets: [{
        label: 'Expense',
        data: <?php echo json_encode($data2); ?>,
        backgroundColor: [
          
          'rgba(255, 206, 86)',
          'rgba(75, 192, 192)',
          'rgba(153, 102, 255 )',
          'rgba(255, 159, 64)',
          'rgba(255, 99, 132)',
          'rgba(54, 162, 235)',
          'rgba(255, 206, 86)',
          'rgba(75, 192, 192)',
          'rgba(153, 102, 255)',
          'rgba(255, 159, 64)',
          'rgba(255, 99, 132)',
          'rgba(54, 162, 235)'

          
      ],
      borderColor: [
          
          'rgba(210, 132, 245)',
          

          
      ],
      pointHitRadius:2,
      pointBorderWidth: 0.5,
      borderWidth: 2.5,
      tension: 0.3,
      }]
    },
    options: {
      scales: {

        
      }
    }
});




</script>




</body>
</html>

