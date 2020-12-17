<?php 
    include(__DIR__.'/NavBar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmandize | Search</title>
</head>
<body>
    <div class="container gz-div-glow">
        <div class="container gz-div-inner mx-auto text-left py-5 text-white" style="font-family: textFont;">
            <div class="container d-flex justify-content-center mx-auto text-left">
                <form method="post">
                    <h2 class="text-white display-4" style="font-family: textFont">Filter</h2>
                    <hr style="width:100%!important; border-top:2px solid white;"/>
                    <div class="form-group m-3"style="float:left;">
                        <h2 class="text-white display-5" style="font-family: textFont">Name</h2>
                        <input size="30"type="text"/>
                    </div>
                    <div class="form-group m-3" style="float:left;">
                        <h2 class="text-white display-5" style="font-family: textFont">Minimum Stars</h2>
                        <input type="number" min="0" max="5" step="0.1"/>
                    </div>
                    <div style="clear: both;">
                    <hr style="width:100%!important; border-top:2px solid white;"/>
                    </div>
                    <div class="form-group m-3" style="float:left;">
                        <h2 class="text-white display-5" style="font-family: textFont">Categories</h2>
                        <input size="30"type="text"/>
                    </div>
                    <div class="form-group m-3" style="float:left;">
                        <h2 class="text-white display-5" style="font-family: textFont">Type</h2>
                        <input type="radio" id="restaurantRadio" name="type" value="restaurant"/>
                        <label for="restaurantRadio" >Restaurant</label>
                        <input type="radio" id="foodRadio" name="type" value="food"/>
                        <label for="foodRadio">Food</label>
                    </div>
                    <div style="clear: both;">
                    <hr style="width:100%!important; border-top:2px solid white;"/>
                    </div>
                    <div class="form-group m-auto text-center">
                    <button id="submitButton" class="btn btn-outline-light"type="submit">Search</button>
                    </div>
                </form>
            </div>    
        
            <!--A Loop Start (Each restaurant matching search) -->
            <div class="row border border-white rounded m-2" style="background-image: radial-gradient(ellipse at center, #448a9a,#e1b10f66)">
                <div class="media mx-3 " style="padding-top: 15px; padding-bottom: 15px;">
                    <!-- Adjust image source-->
                    <img class="mr-3 align-self-top" style="height: auto; width: 25%;" src="misc\images\Restaurant_Test.jpg" alt="img">
                    <div class="media-body">
                        <div class="row">
                            <div class="col">
                                <h3>Restaurants Name</h3>
                                <h3>Stars</h3>
                                <h5>Address</h5>
                                <h5>Phone</h5>
                                <h5>Website URL</h5>
                            </div>
                            <div class="col d-flex align-content-center flex-wrap">
                                <button class="btn btn-outline-light m-3">View Reviews</button>
                                <button class="btn btn-outline-light m-3">Add Review</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--A loop end -->
            <!--B Loop Start (Each Food matching search) -->
            <div class="row border border-white rounded m-2" style="background-image: radial-gradient(ellipse at center, #448a9a,#e1b10f66)">
                <div class="media mx-3 " style="padding-top: 15px; padding-bottom: 15px;">
                    <!-- Adjust image source-->
                    <img class="mr-3 align-self-top" style="height: auto; width: 25%;" src="misc\images\Fries_Test.jpeg" alt="img">
                    <div class="media-body">
                        <div class="row">
                            <div class="col">
                                <h3>Foods Name</h3>
                                <h3>Restaurants Name</h3>
                                <h3>Stars</h3>
                                <h5>Categories</h5>
                            </div>
                            <div class="col d-flex align-content-center flex-wrap">
                                <button class="btn btn-outline-light m-3">View Reviews</button>
                                <button class="btn btn-outline-light m-3">Add Review</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--B loop end -->
        </div>
    </div>
</body>
</html>