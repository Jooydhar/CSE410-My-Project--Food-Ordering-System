<?php
    if( isset( $_POST['addFoodButton' ] ) )
    {
        $foodName = "";
        $foodDescription = "";
        $price = 0;
        $catagory = "";
        $tag = "";
        $photo = "";

        if( !empty( $_POST[ 'foodName' ] ) && !empty( $_POST[ 'foodDescription' ] ) && !empty( $_POST[ 'foodPrice' ] ) && !empty( $_POST[ 'foodCatagory' ] ) && !empty( $_POST[ 'foodTag' ] ) )
        {
            $foodName = $_POST[ 'foodName' ];
            $foodDescription = $_POST[ 'foodDescription' ];
            $catagory = $_POST[ 'foodCatagory' ];
            $price = $_POST[ 'foodPrice' ];
            $tag = $_POST[ 'foodTag' ];

            $food_id = 0;

            $query1 = mysqli_query( mysqli_connect('localhost' , 'root' , '' , 'fooddata' ) , "select * from food order by food_id asc" );

            while( $row = mysqli_fetch_array( $query1 ) )
            {
                if( $row[ 'food_id' ] != $food_id + 1 )
                {
                break;
                }
                $food_id  = $row['food_id'];
            }

            $food_id = $food_id + 1;
            
            $food_image = $_FILES['foodImage']['name'];
            $food_image_tmp = $_FILES['foodImage']['tmp_name'];
            move_uploaded_file($food_image_tmp,"foodimg/$food_image");

            $query2 = mysqli_query( mysqli_connect('localhost' , 'root' , '' , 'fooddata' ) , "Insert into food(food_id	,food_name,	food_description,	food_price	,food_catagory	,url
) values ( '$food_id' , '$foodName' , '$foodDescription' , '$price' , '$catagory' , '$food_image'  )" );

            
            $tagArray = array();
            $token = strtok($tag, ",");

            while ($token !== false)
            {
                array_push( $tagArray , $token );
                $token = strtok(",");
            }

            $len = sizeof( $tagArray );

            for( $i = 0; $i < $len ; $i++ )
            {
                $temp = $tagArray[ $i ];
                $query4 = mysqli_query( mysqli_connect('localhost' , 'root' , '' , 'fooddata' ) , "Insert into tag (id , tag ) values ( '$food_id' , '$temp')" );
            }

            
            if( $query2 )
            {
                echo "<script type='text/javascript'>alert('Product Added Successfully');</script>";
            }
            else
            {
                echo "<script type='text/javascript'>alert('Error! Adding Product');</script>";
            }

            
        }
    }
?>
<html>

<head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            margin: 0px;
            background: #56CCF2;

            color: white;
        }

        .left-side {

            background: #000046;

            color: white;
        }

        .nav-pills li a {
            color: white;
            font-size: 18px;
            letter-spacing: 1px;
        }

        .nav-pills li a:hover {
            background-color: #337ab7;

        }

    </style>
</head>

<body>
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-pills">
                    <li><a data-toggle="pill" href="#addproduct">Add Food</a></li>

                </ul>
                <hr style="margin-top: 0px;">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="tab-content">

                    <div id="addproduct" class="tab-pane fade in active">
                        <!-- Add Product -->
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4 text-center">
                                <h4 style="letter-spacing: 2px;border-left: 2px solid white;border-right: 2px solid white; padding: 10px 0px; border-radius: 5px;"><strong><em>Add Food</em></strong></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group">

                                        <input type="text" class="form-control input-box" name="foodName" placeholder="Food Name">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="15" name="foodDescription" placeholder="Food Description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control input-box" name="foodPrice" placeholder="Price">
                                    </div>


                                    <div class="form-group">
                                        <label for="foodCatagory" style="color: white;">Select Catagory</label>
                                        <select class="form-control" name="foodCatagory">
                                            <?php
                                                $user_query = mysqli_query( mysqli_connect('localhost' , 'root' , '' , 'fooddata') , "select * from catagory" );
                                                while( $row = mysqli_fetch_array( $user_query ) )
                                                {
                                                    echo '<option>'.$row['catagory'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <input type="text" class="form-control input-box" name="foodTag" placeholder="Food Tag">
                                        <h5><em>Multiple product tag seperated by coma</em></h5>
                                    </div>

                                    <div class="file btn btn-warning" name="uploadImageBtn" style="position: relative;overflow: hidden;">
                                        Upload Product Image
                                        <input type="file" name="foodImage" style="position: absolute;font-size: 50px;opacity: 0;right: 0;top: 0;" />
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-sm-2 col-sm-offset-5 text-center">
                                            <button type="submit" class="btn btn-success" name="addFoodButton">Add Food</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</body>

</html>
