
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

    <!-- Navbar Start -->
    <?php 
        include('assets/navbar.php');
        include('assets/config.php'); 
        function id(){
			if(isset($_GET['id'])){
				$id=$_GET['id'];
				
				return $id;
			}
		}   
    ?>
    <!-- Navbar End -->
    <?php
			
            $id=id();
			$result=$con->query("SELECT * FROM bottel WHERE id=$id") 
				or die($con->error);
			
		?>


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Item Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <?php if($row=$result->fetch_assoc()):?>
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="<?=$row['photo']?>" alt="Image">
                        </div>
                        
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3><?=$row['name']?></h3>
                    
                    <h3 class="font-weight-semi-bold mb-4"> Rs: <?=$row['Price']?></h3>
                    <p class="mb-4"><?=$row['detail']?></p>
                    
                    
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            
                            <form method='post' action="detail.php?id=<?=$row['id']?>&name=<?=$row['name']?>">
                                <div class="row">
                                    <div class="col-6"><input type="number" name="quantity" min=0 value=1 style="width:80%; height: 100%"></div>
                                    <div class="col-6"><input type="submit" class="btn btn-primary px-3" name='submit' value="Add To Cart" ></div>
                                </div>
                                
					            
                            </form>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
    <?php endif;?>
    <!-- Shop Detail End -->

<!-- php code of the crud in the insert the item data in a cart -->

<?php
			
				$result1=$con->query("SELECT count(*) as length FROM cart") 
					or die($con->error);
				$r1=$result1->fetch_assoc();
               
				if(isset($_POST['submit'])){
                   
					if($r1==null){
						$id=$_GET['id'];
						$Q=$_POST['quantity'];
					
						$con->query("INSERT INTO cart(id,itemId,quantity)
						VALUES(1,$id,$Q)") or die($con->error);
						 
					}else{
						try{
							$id=$_GET['id'];
							$Q=$_POST['quantity'];
                            $len=$r1['length']+1;
                            
							$con->query("INSERT INTO cart(id,itemId,quantity)
							VALUES($len,$id,$Q)") or die($con->error);
							
						}catch(mysqli_sql_exception $e){

							alert("duplicate enter");
						}

					}
				}
			?>




<!-- end to the code -->
    

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