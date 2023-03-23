<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>S-CAR RENTALS</title>
    <link rel="stylesheet" href="slick.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fixed.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body  data-spy="scroll" data-target="#navbarResponsive">

<style>
/* Set background and text colors */
body {
  background-color: black;
  color: white;
}

/* Style table headers */
.content-table th {
  background-color: white;
  color: black;
}

/* Style table rows */
.content-table td {
  background-color: black;
  color: white;
}

/* Style active table rows */
.content-table .active-row td {
  background-color: #333333;
}

/* Style button */

.but {
  background-color: white;
  color: blueviolet;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
}

/* Style header */
.header {
  font-size: 36px;
  text-align: center;
  margin-top: 70px;
  color: white;
}

.companyname, .licenseno {
  font-size: 20px;
  color: white;
  margin-top: 10px;
  text-align: center;
}

.content {
  display: flex;
  flex-direction: column;
  align-items: center;
}


/* Style add button */
.add {
  background-color: crimson;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  margin-bottom: 20px;
  float: right;
}

/* Style link in add button */
.add a {
  color: white;
  text-decoration: none;
}

* Style table */
.content-table {
  border-collapse: collapse;
  width: 100%;
}

/* Style table cell padding and border */
.content-table td, .content-table th {
  border: 1px solid white;
  padding: 8px;
}

/* Style first column of table */
.content-table td:first-child, .content-table th:first-child {
  width: 10%;
  text-align: center;
}

/* Style second column of table */
.content-table td:nth-child(2), .content-table th:nth-child(2) {
  width: 20%;
}

/* Style third column of table */
.content-table td:nth-child(3), .content-table th:nth-child(3) {
  width: 10%;
}

/* Style fourth column of table */
.content-table td:nth-child(4), .content-table th:nth-child(4) {
  width: 10%;
  text-align: center;
}

/* Style fifth column of table */
.content-table td:nth-child(5), .content-table th:nth-child(5) {
  width: 10%;
  text-align: center;
}

/* Style sixth column of table */
.content-table td:nth-child(6), .content-table th:nth-child(6) {
  width: 20%;
}

/* Style seventh column of table */
.content-table td:nth-child(7), .content-table th:nth-child(7) {
  width: 10%;
  text-align: center;
}

/* Style eighth column of table */
.content-table td:nth-child(8), .content-table th:nth-child(8) {
  width: 10%;
  text-align: center;
}


</style>

<?php

require_once('connection.php');

session_start();

$value = $_SESSION['email'];
$_SESSION['email'] = $value;

$sql="select * from company where EMAIL='$value'";
$name = mysqli_query($con,$sql);
$rows=mysqli_fetch_assoc($name);


$query="SELECT *from cars WHERE cname='$rows[cname]'";    
$queryy=mysqli_query($con,$query);
$num=mysqli_num_rows($queryy);





?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="companydash.php">
            <h2>COMPANY DASHBOARD</h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="companydash.php">CAR MANAGEMENT</a>
                </li>
                <li  class="nav-item">
                    <a class="nav-link"  href="companybooking.php">BOOKING REQUESTS</a>
                </li>
                <li  class="nav-item">
                    <a class="nav-link"  href="index.php">LOG OUT</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="content">
                <h2 class="header">YOUR CARS</h2>
                <p class="companyname">Company Name: &nbsp;<a id="pname"> <?php echo $rows['cname']?></a></p>
                <p class="licenseno">License No: &nbsp;<a id="pname"> <?php echo $rows['lic_num']?></a></p>
                <button class="add"><a href="companyaddcar.php">+ ADD CARS</a></button>
                <div>
                    <div>
                        <table class="content-table">
                    <thead>
                        <tr>
                            
                            <th>CAR ID</th>
                            <th>CAR NAME</th>
                            <th>FUEL TYPE</th>
                            <th>CAPACITY</th>
                            <th>PRICE</th>
                            <th>COMPANY</th>
                            <th>AVAILABLE</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    
                while ($res = mysqli_fetch_array($queryy)){
                    
                    
                    ?>
                    <tr  class="active-row">
                        
                        <td><?php echo $res['CAR_ID'];?></php></td>
                        <td><?php echo $res['CAR_NAME'];?></php></td>
                        <td><?php echo $res['FUEL_TYPE'];?></php></td>
                        <td><?php echo $res['CAPACITY'];?></php></td>
                        <td><?php echo $res['PRICE'];?></php></td>
                        <td><?php echo $res['cname'];?></php></td>
                        <td><?php  
                        if($res['AVAILABLE']=='Y')
                        {
                            echo 'YES';
                        }
                        else{
                            echo 'NO';
                        }                     
                    ?>
                    </php></td>
                        <td><button type="submit" class="but" name="approve"><a href="companyeditcar.php?id=<?php echo $res['CAR_ID']?>">EDIT</a></button></td>
                        <td><button type="submit" class="but" name="approve" onclick="return confirm('Are you sure you want to delete this car?')">DELETE CAR</button></td>


                    </tr>
                <?php } ?>
                    </tbody>
                    </table>
                    
                    </div>
                </div>
          </div>
      </div>





 <!--- Script Source Files -->

    
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
 <!--- End of Script Source Files -->



</body>

</html>
