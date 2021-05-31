<?php
    session_start();
    include ('navigation.php');
    $m='';
    $conn=connection();
    $id=$_SESSION['userid'];
    $sq="SELECT * FROM user_info WHERE id='$id'";
    $thisUser=mysqli_fetch_assoc($conn->query($sq));

    if(isset($_POST['submit'])){
        $pName= $_POST['pname'];
        $buy= $_POST['buy'];
        $img= $_FILES['pimage'];
        $iName= $img['name'];
        $tempName= $img['tmp_name'];
        $format= explode('.', $iName);
        $actualName= strtolower($format[0]);
        $actualFormat= strtolower($format[1]);
        $allowedFormats= ['jpg', 'png', 'jpeg', 'gif'];

        if(in_array($actualFormat, $allowedFormats)){
            $location= 'Uploads/'.$actualName.'.'.$actualFormat;
            $sql= "INSERT INTO products(name, bought, image, created_at) VALUES ('$pName', '$buy', '$location', current_timestamp())";
            if($conn->query($sql)===true){
                move_uploaded_file($tempName, $location);
                $m= "Product Inserted!";
            }
        }

    }
$sq= $id= $_SESSION['userid'];
$sq= "SELECT * FROM user_info WHERE id='$id'";
$thisUser= mysqli_fetch_assoc($conn->query($sq));
    $sql= "SELECT * from products";
    $res= $conn->query($sql);

    $sql= "SELECT COUNT(id) as total_products from products";
    $total_product= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(bought) as total_buy from products";
    $total_buy= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(sold) as total_sell from products";
    $total_sell= mysqli_fetch_assoc($conn->query($sql));


?>
<html>
    <head>
        <title> Products </title>
        <link rel="stylesheet" type="text/css" href="css/products.css">
    </head>
    <body>
        <div class="row" style="padding-top: 40px;">
            <div class="leftcolumn">
                <div class="row">
                    <section style="padding-left: 100px; padding-right: 100px;">
                        <div style="height:230px;background-color:green;text-align: center;margin-left:20px" class="col-sm-2" >
                            <div class="card card-green">
                                <h3>Total Products </h3>
                                <h2 style="color: #282828; text-align: center;"><?php echo $total_product?$total_product['total_products']: 'No Products available in stock'; ?></h2>
                            </div>
                        </div>
                        <div style="height:230px;background-color:#FF836B;text-align: center;margin-left: 20px" class="col-sm-2">
                            <div class="card card-yellow" >
                                <h3>Products Bought </h3>
                                <h2 style="color: #282828; text-align: center;"><?php echo $total_buy?$total_buy['total_buy']: 'You haven\'t bought anything yet'; ?></h2>
                            </div>
                        </div>
                        <div style="background-color:#00A9F0;height:230px; text-align: center;margin-left: 20px"  class="col-sm-2" >
                            <div class="card card-blue" >
                                <h3>Products Sold </h3>
                                <h2 style="color: #282828; text-align: center;"><?php echo $total_sell?$total_sell['total_sell']: 'You haven\'t sold anything yet'; ?></h2>
                            </div>
                        </div>
                        <div style="background-color:#FF3E3E;text-align: center;height:230px; margin-left: 20px" class="col-sm-2" >
                            <div class="card card-red" >
                                <h3>Available Stock </h3>
                                <h2 style="color: #282828; text-align: center;"><?php echo $total_buy?$total_buy['total_buy']-$total_sell['total_sell']: 'You haven\'t invested anything yet'; ?></h2>
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
                <div class="row">
                    <section>
                        <div class="card">
                            <div style="padding-top:30px" class="text-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProduct">
                                    Add New Product
                                </button>
                                <h2 style="color: #c6a109"><?php echo $m; ?></h2>
                                <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button style="background-color: #ffce00;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h2 style="color: #c6a109" class="modal-title" id="exampleModalScrollableTitle">Add New Product</h2>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="products.php" enctype="multipart/form-data">
                                                    <div class="form-group pt-20">
                                                        <div class="col-sm-4">
                                                            <label for="name" class="pr-10" style="color: #c6a109"> Product Name</label>
                                                        </div>
                                                        <div style="color: #c6a109" class="col-sm-8">
                                                            <input name="pname" type="text" class="login-input" placeholder="Product Name" id="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group pt-20">
                                                        <div class="col-sm-4">
                                                            <label for="buy" class="pr-10" style="color: #c6a109"> Buying Amount</label>
                                                        </div>
                                                        <div style="color: #c6a109" class="col-sm-8">
                                                            <input  name="buy" type="text" class="login-input" placeholder="Buying Amount" id="buy" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group pt-20">
                                                        <div style="color: #c6a109" class="col-sm-4">
                                                            <label for="pimage" class="pr-10" > Product Image</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input name="pimage" class="pl-20" type="file" id="pimage" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="text-align: center;">
                                                        <button type="submit" value="submit" name="submit" class="btn btn-success">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-left: 40px;background-color: #010001" class="col-sm-8">
                                <div class="table_container">
                                    <h1 style="text-align: center;color:#c6a109 ">Products Table</h1>
                                    <div class="table-responsive">
                                        <table class="table table-dark" id="table" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                            <thead class="thead-light">
                                            <tr style="color: #c6a109">
                                                <th data-field="name" data-filter-control="select" data-sortable="true">Product Name</th>
                                                <th data-field="bought" data-filter-control="select" data-sortable="true"> Bought</th>
                                                <th data-field="sold" data-sortable="true">Sold</th>
                                                <th data-field="stock" data-sortable="true">Available in Stock</th>
                                                <th data-field="actions" data-sortable="true"> Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(mysqli_num_rows($res)>0){
                                                while($row= mysqli_fetch_assoc($res)){
                                                    $stock= $row['bought']-$row['sold'];
                                                    echo "<tr>";
                                                    echo "<td>".$row['name']."</td>";

                                                    echo "<td>".$row['bought']."</td>";

                                                    echo "<td>".$row['sold']."</td>";

                                                    echo "<td>".$stock."</td>";

                                                    echo "<td><a href='viewProduct.php?id=".$row['id']."' class='btn btn-success btn-sm'>".
                                                        "<span class='glyphicon glyphicon-eye-open'></span> </a>";
                                                    echo "<a href='editProduct.php?id=".$row['id']."' class='btn btn-warning btn-sm'>".
                                                        "<span class='glyphicon glyphicon-pencil'></span> </a>";
                                                    if($thisUser['is_aamin']==1){
                                                        echo "<a href='deleteProduct.php?id=".$row['id']."' class='btn btn-danger btn-sm'>".
                                                            "<span class='glyphicon glyphicon-trash'></span> </a></td>";
                                                    }


                                                }
                                            } else{
                                                echo "No results found!";
                                            }

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                    </section>
            </div>
        </div>
        <?php include('footer.php')?>
</body>
</html>