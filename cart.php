<?php
  include('assets/config.php');
if(isset($_POST['submit'])){
			
    $id=$_POST['id'];
    $Q=$_POST['quantity'];
        
    $con->query("UPDATE cart SET quantity=$Q WHERE itemId=$id")
         or die($con->error);
    
                        
    $id=null;		
}


if(isset($_POST['Submit'])){
			
    $id=$_POST['id'];

        
    $con->query("DELETE FROM cart WHERE itemId=$id")
         or die($con->error);
    				
    $id=null;		
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>



    <?php 
        include('assets/navbar.php');
      
    ?>



    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <?php 
        $result=$con->query("
        select itemId as id,name,quantity,price as unitprice,(quantity*price) as price from drink.cart as c,drink.bottel as b where b.id=c.itemId        ")or die($con->error);

        $subtotal=$con->query("
        select sum(quantity*price) as subtotal from drink.cart as c,drink.bottel as b where b.id=c.itemId;
        ")or die($con->error);
        $st=$subtotal->fetch_assoc();
    ?>


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price(Rs)</th>
                            <th>Quantity</th>
                            <th>Total(Rs)</th>
                            <th>Remove</th>
                        </tr>
                    </thead>

                    <tbody class="align-middle">
                    <?php while($row=$result->fetch_assoc()):?>
                        <tr>
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;"> <?=$row['name']?></td>
                            <td class="align-middle"><?=$row['unitprice']?></td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                <form method='post' action="cart.php">
                                <div class="row">
                                    <input type="hidden" name="id" min=0 value=<?=$row['id']?>>
                                    <div class="col-6"><input type="number" name="quantity" min=0 value=<?=$row['quantity']?> style="width:100%; height: 100%"></div>
                                    <div class="col-6"><input type="submit" class="btn btn-primary px-2" name='submit' value="submit" ></div>
                                </div>
                                
					            
                            </form>
                                </div>
                            </td>
                            <td class="align-middle"><?=$row['price']?></td>
                            
                            <td class="align-middle">
                            
                            <form method='post' action="cart.php">
                               
                                    <input type="hidden" name="id" min=0 value=<?=$row['id']?>>
                                    
                                    <input type="submit" class="btn btn-sm btn-danger" name='Submit' value='X'>
                                
                                
					            
                            </form>
                            </td>
                        </tr>
                        
                    <?php endwhile;?>    
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal(Rs)</h6>
                            <h6><?=$st['subtotal']?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping(Rs)</h6>
                            <h6 class="font-weight-medium">500</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total(Rs)</h5>
                            <h5><?=$st['subtotal']-500?></h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


    <!-- Footer Start -->
    <?php include('assets/footer.php');?>

    <!-- Footer End -->
    


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

