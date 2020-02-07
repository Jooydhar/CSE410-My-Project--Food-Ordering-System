<?php
 function _AdminLogin()
    {
     $error=0;
        if( !empty( $_POST['username'] ) && !empty($_POST['password']) ){
            $userName = $_POST['username'];
            $password = $_POST['password'];

            $query = mysqli_query( mysqli_connect("localhost","root","","fooddata") , "SELECT * FROM ADMIN_LOGIN");

            while( $row = mysqli_fetch_array( $query ) )
            {
                $user = $row['username'];
                $pass = $row['password'];

                if( $user == $userName && $pass == $password )
                {
                    // Login Successfull
                    $_SESSION['admin_id'] = $row['admin_id'];    
                    $error=-1;
                    header("Location: dash.php");
                    
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

    if( isset( $_POST['adminLoginButton'] ) )
    {
        _AdminLogin();
    }

?>
<html>

<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            margin: 200px 200px;
            background: #AA076B;
            /*background: -webkit-linear-gradient(to right, #61045F, #AA076B);
        background: linear-gradient(to right, #61045F, #AA076B);*/
        }

        .login-box {
            background: #AA076B;
            /*background: -webkit-linear-gradient(to right, #61045F, #AA076B);
            background: linear-gradient(to right, #61045F, #AA076B);*/
            color: white;
            border-radius: 5px;
            " 

        }

        .input-box {
            margin-top: 20px;
            padding: 20px 15px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center login-box">
                <h3>Admin Panel</h3>

                <div class="col-sm-8 col-sm-offset-2">
                    <hr>
                    <form method="post" action="">
                        <div class="form-group">
                            <input type="text" class="form-control input-box" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control input-box" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-success" name="adminLoginButton">Login</button>
                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>
</body>

</html>
