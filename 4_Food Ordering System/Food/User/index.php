<?php
    // $dbCon = mysqli_connect("localhost","root","","fooddata");
    
    session_start();
    $error = 0;
    $server_id = "";
    $first_name = "";
    $last_name = "";
    $email = "";
    $contact = "";

    function _userInformationFetch()
    {
        $server_id = $_GET['userid'];
        $query = mysqli_query( mysqli_connect("localhost","root","","fooddata") , "select * from user_info as ui , user_login as ul where ui.server_id = '$server_id'");
        $row = mysqli_fetch_array( $query );

        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['contact'] = $row['contact_no'];
        $_SESSION['email'] = $row['email'];
    }

    if( $_GET['userid'] != null ){
        $server_id = $_GET['userid'];

        _userInformationFetch();
    }

    function _CustomerLogin()
    {
        if( !empty( $_POST['username'] ) && !empty($_POST['password']) ){
            $userName = $_POST['username'];
            $password = $_POST['password'];

            $query = mysqli_query( mysqli_connect("localhost","root","","fooddata") , "SELECT * FROM USER_LOGIN");

            while( $row = mysqli_fetch_array( $query ) )
            {
                $user = $row['username'];
                $pass = $row['user_password'];

                if( $user == $userName && $pass == $password )
                {
                    // Login Successfull
                    $server_id = $row['server_id'];
                    $error = -1;
                    _userInformationFetch();
                    header("Location: index.php?userid=".$server_id."");
                    die();
                }
            }
            if( $error ==  0 )
            {
                // Login Failed
                $error = 1; // username password doesn't matched
                $message = "invalid username or password";
                echo "<script type='text/javascript'>alert('$message');</script>";
                
            }
        }
        else
        {
            $message = "one or more fields are empty";
            echo "<script type='text/javascript'>alert('$message');</script>";
            $error = 2; // empty textbox
        }
    }

    if( isset( $_POST['login_btn'] ) )
    {
        _CustomerLogin();
    }

    if( isset( $_POST['clear_btn'] ) )
    {
        $temp = $_GET['userid'];
        $user_query = mysqli_query(mysqli_connect('localhost','root','','fooddata'),"delete from cart where id = '$temp'");
    }

    
    if( isset($_POST['signup_btn']) ){

        $a = $_POST['firstName'];
        $b = $_POST['lastName'];
        $c = $_POST['email'];
        $d = $_POST['contactNo'];
        
        $e = $_POST['userName'];
        $f = $_POST['password'];
        $g = $_POST['address'];

    $server_id = 0;

    $user_query = mysqli_query(mysqli_connect('localhost','root','','fooddata'),"select * from user_info order by server_id asc");
    while( $row = mysqli_fetch_array($user_query) )
    {
            $server_id = $row['server_id'];
    }

    $server_id = $server_id + 1;

   if( !empty($_POST['firstName']) && !empty($_POST['lastName']) &&  !empty($_POST['email']) && !empty($_POST['userName']) &&  !empty($_POST['password']) && !empty($_POST['address']) && !empty($_POST['contactNo'])  )
    {
            // All OK

       $query = "INSERT INTO user_info(server_id,first_name,last_name,contact_no , address) values ($server_id,'$a','$b', '$d','$g')";
		mysqli_query(mysqli_connect('localhost','root','','fooddata'),$query);

    $query = "INSERT INTO user_login(server_id,username,user_password,email) values ($server_id,'$e','$f','$c')";
 mysqli_query(mysqli_connect('localhost','root','','fooddata'),$query);

       $message = "Registration Successful login to continue";
            echo "<script type='text/javascript'>alert('$message');</script>";

    }
    else
    {
        // field empty
       $message = "one or more fields are empty";
            echo "<script type='text/javascript'>alert('$message');</script>";
    }
    }
?>
<html>

<head>
    <title>Online Food</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="Assets/CSS/custom.css">
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#myPage">Home</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#services">About Us</a></li>
                    
                    <?php
                        echo '<li><a href="menu.php?userid='.$server_id.'&catid=0">Food Menu</a></li>';
                        if( $_GET['userid'] == "" )
                        {
                            echo '<li><a data-toggle="modal" data-target="#signup"><span class="glyphicon glyphicon-send"></span>Sign Up</a></li>
                        <li><a data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>';
                            
                        }
                        else{
                            echo '<li><a href="profile.php?userid='.$server_id.'">Hello '.$_SESSION['first_name'].'</a></li>';
                            echo '<li><a href="index.php?userid=">Logout</a></li>';
                            echo '<li><a data-toggle="modal" data-target="#cart"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>';
                            echo '<li><a data-toggle="modal" data-target="#history"><span class="glyphicon glyphicon-list-alt"></span>Order History</a></li>';
                        }
                    ?>

                </ul>
            </div>
        </div>
    </nav>

    <div class="jumbotron text-center">
        <h1>Online Food Order</h1>
        <p>Food at your doorstep</p>
    </div>

    <!-- Container (Services Section) -->
    <div id="services" class="container-fluid text-center">
        <h2>SERVICES</h2>
        <h4>What we offer</h4>
        <br>
        <div class="row slideanim">
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-off logo-small"></span>
                <h4>Fast Food</h4>

            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-heart logo-small"></span>
                <h4>Healthy Food</h4>

            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-lock logo-small"></span>
                <h4>Cash on Delivery</h4>

            </div>
        </div>
        <br><br>
        <div class="row slideanim">
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-leaf logo-small"></span>
                <h4>Fresh Food</h4>

            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-certificate logo-small"></span>
                <h4>Tasty Dish</h4>

            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-wrench logo-small"></span>
                <h4 style="color:#303030;">Best Chef</h4>

            </div>
        </div>
    </div>
    <div id="portfolio" class="container-fluid text-center bg-grey">
        <h2>Customer's Opinion</h2>
        <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <h4>"This company is the best. I am so happy with the result!"<br><span>Michael Roe, Vice President, Comment Box</span></h4>
                </div>
                <div class="item">
                    <h4>"One word... WOW!!"<br><span>John Doe, Salesman, Rep Inc</span></h4>
                </div>
                <div class="item">
                    <h4>"Could I... BE any more happy with this company?"<br><span>Chandler Bing, Actor, FriendsAlot</span></h4>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- Login -->
    <div class="modal fade" id="login" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body text-center">
                    <form method="post" action="">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Email or Username">
                        </div>
                        <div class="form-group ">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary" name="login_btn">Login</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
    <!-- Sign UP -->
    <div class="modal fade" id="signup" role="dialog" style="margin-top: 10%;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sign Up</h4>
                </div>
                <div class="modal-body text-center">
                    <form method="post" action="">

                        <div class="form-group">
                            <input type="text" class="form-control" name="firstName" placeholder="Firstname">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="lastName" placeholder="Lastname">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="contactNo" placeholder="Contact No">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="Delivery Address">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="userName" placeholder="Username">
                        </div>
                        <div class="form-group ">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary" name="signup_btn">Login</button>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <div class="modal fade" id="cart" role="dialog" style="margin-top: 10%;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="glyphicon glyphicon-shopping-cart"></span>     Your Cart</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <?php 
                            $temp = $_GET['userid'];
                            $sum = 0;
                            $query = mysqli_query(mysqli_connect('localhost','root','','fooddata') , "select * from cart as c , food as f where c.fid = f.food_id and c.id = '$temp'");
                            while( $row = mysqli_fetch_array( $query ) )
                            {
                                echo '<h5><span><img src = "../Admin/foodimg/'.$row['url'].'" style = "width : 20px; height : 20px;"</span> '.$row['food_name'].' - '.$row['food_price'].' TK</h5><hr>';
                                $sum = $sum + $row['food_price'];
                            }
                            echo '<h4>Total Amount To Pay : '.$sum.' TK</h4>';
                        ?>
                        <button type="submit" class="btn btn-primary" name="order_btn">Place Order</button>
                        <button type="submit" class="btn btn-primary" name="clear_btn">Clear Cart</button>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <div class="modal fade" id="history" role="dialog" style="margin-top: 10%;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="glyphicon glyphicon-shopping-cart"></span>     Order History</h4>
                </div>
                <div class="modal-body">
                    
                        <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Order Id</th>
                            <th>Food</th>
                            <th>Price</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $p = -1;
                            $temp = $_GET['userid'];
                            $sum = 0;
                            $query = mysqli_query(mysqli_connect('localhost','root','','fooddata') , "select * from food_order as fo , food as f where fo.fid = f.food_id and fo.id = '$temp' order by fo.orderid desc");
                            while( $row = mysqli_fetch_array( $query ) )
                            {
                                if( $row['orderid'] != $p )
                                {
                                    if( $sum != 0 )
                                    {
                                        echo '<tr style="background-color : #333; color: white;">
                                        <td></td>
                                        <td>Total - </td>
                                        <td>'.$sum.' TK</td>
                                      </tr>';
                                      $sum = 0;
                                    }
                                    echo '<tr>
                                        <td>'.$row['orderid'].'</td>
                                        <td><span><img src = "../Admin/foodimg/'.$row['url'].'" style = "width : 20px; height : 20px;"</span>'.$row['food_name'].'</td>
                                        <td>'.$row['food_price'].' TK</td>
                                      </tr>';
                                }
                                else
                                {
                                    echo '<tr>
                                        <td></td>
                                        <td><span><img src = "../Admin/foodimg/'.$row['url'].'" style = "width : 20px; height : 20px;"</span>'.$row['food_name'].'</td>
                                        <td>'.$row['food_price'].' TK</td>
                                      </tr>';
                                }
                                $sum = $sum + $row['food_price'];
                                $p = $row['orderid'];
                            }
                            if( $sum != 0 )
                                    {
                                        echo '<tr style="background-color : #333; color: white;">
                                        <td></td>
                                        <td>Total - </td>
                                        <td>'.$sum.' TK</td>
                                      </tr>';
                                      $sum = 0;
                                    }
                        ?>
                        </tbody>
                        </table>
                </div>

            </div>

        </div>
    </div>


    <footer class="container-fluid text-center" style="background-color: #333;">
        <a href="#myPage" title="To Top">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
        <p>Copyright Online Food</p>
    </footer>

    <script>
        $(document).ready(function() {
            // Add smooth scrolling to all links in navbar + footer link
            $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 900, function() {

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });

            $(window).scroll(function() {
                $(".slideanim").each(function() {
                    var pos = $(this).offset().top;

                    var winTop = $(window).scrollTop();
                    if (pos < winTop + 600) {
                        $(this).addClass("slide");
                    }
                });
            });
        })

    </script>

</body>

</html>
