<?php
session_start();
include ('navigation.php');

$date= date('Y-m-d', strtotime('-7 days'));
//die ($date);
$conn=connection();
$id= $_SESSION['userid'];
$sq= "SELECT * FROM user_info WHERE id='$id'";
$thisUser= mysqli_fetch_assoc($conn->query($sq));

$sql= "SELECT * from products WHERE updated_at>'$date'";
$prod= $conn->query($sql);

$sql= "SELECT COUNT(*) as products FROM products";
$total_products= mysqli_fetch_assoc($conn->query($sql));

$sql= "SELECT SUM(bought) as total_bought FROM products";
$total_bought= mysqli_fetch_assoc($conn->query($sql));

$sql= "SELECT SUM(sold) as total_sold FROM products";
$total_sold= mysqli_fetch_assoc($conn->query($sql));

$stock_available= $total_bought['total_bought']-$total_sold['total_sold'];
?>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>
<div class="row" style="padding-top: 40px;">
    <div class="leftcolumn">
        <div class="row">
            <section style="padding-left: 50px; padding-right: 40px;">
                <div style="height:230px;background-color:green;text-align: center;margin-left:20px" class="col-sm-2">
                    <div class="card card-green">
                        <h3>Total Products </h3>
                        <h2><?php echo $total_products['products'] ?></h2>
                    </div>
                </div>
                <div style="height:230px;background-color:#FF836B;text-align: center;margin-left: 20px" class="col-sm-2">
                    <div class="card card-yellow" >
                        <h3>Products Bought </h3>
                        <h2 style="color: #282828; text-align: center;"><?php echo $total_bought['total_bought'] ?></h2>
                    </div>
                </div>
                <div style="background-color:#00A9F0;height:230px; text-align: center;margin-left: 20px"  class="col-sm-2" >
                    <div class="card card-blue" >
                        <h3>Products Sold </h3>
                        <h2 style="color: #282828; text-align: center;"><?php echo $total_sold['total_sold'] ?></h2>
                    </div>
                </div>
                <div style="background-color:#FF3E3E;text-align: center;height:230px; margin-left: 20px" class="col-sm-2" >
                    <div class="card card-red" >
                        <h3>Available Stock </h3>
                        <h2 style="color: #282828; text-align: center;"><?php echo $stock_available ?></h2>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div style=" background-color: #010001;text-align: center;color: #c6a109;height: 190px" class="card ">
                        <h2 style="padding-top:10px">Owners Info</h2>
                        <p style="padding-top: 40px">Some text..</p>
                    </div>
                </div>

            </section>
        </div>
    </div>

<?php //include('footer.php')?>
</body>
</html>