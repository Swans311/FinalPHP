<?php 
    include(__DIR__.'/NavBar.php');
    include(__DIR__.'/model/ModelReview.php');
    
    $restaurantInfo = getRestaurantByID($_GET['id']);
    $restaurantReviews = getMostRecentReviewsByRestaurant($_GET['id'], 3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmandize | Restaurant</title>
</head>
<body>
    <div class="container gz-div-glow">
        <div class="container gz-div-inner mx-auto text-left py-5 text-white" style="font-family: textFont;">
            <div class="media mr-auto mb-5">
                <img class="mr-3 align-self-center" style="height: 300px; width: auto;" src="misc\images\Restaurant_Test.jpg" alt="img">
                <div class="media-body">
                    <?php
                        echo '<h1 class="display-4"style="font-family: titleFont;">'.$restaurantInfo['Restaurant_Name'].'</h1>';
                        echo '<h1 class="display-4">'.round(calculateRestaurantStarRating($restaurantInfo['Restaurant_ID']),2).' Stars</h1>';
                        echo '<h1 class="display-5">'.$restaurantInfo['ResAddress'].'</h1>';
                        echo '<h1 class="display-5">'.$restaurantInfo['Phone'].'</h1>';
                        echo '<h1 class="display-5"><a href = "'.$restaurantInfo['Restaurant_URL'].'" target="_blank">'.$restaurantInfo['Restaurant_URL'].'</a></h1>';
                    ?>
                </div>
            </div>
            <?php
                if(isset($_GET['id']))
                    foreach($restaurantReviews as $resRev)
                    {
                        echo '<div class="row border border-white rounded m-2" style="background-image: radial-gradient(ellipse at center, #448a9a,#e1b10f66)">';
                            echo '<div class="media mx-3" style="padding-top: 15px; padding-bottom: 15px;">';
                                echo '<img class="mr-3 align-self-top" style="height: auto; width: 25%;" src="misc\images\Restaurant_Test.jpg" alt="img">';
                                    echo '<div class="media-body">';
                                        echo '<div>';
                                            echo $resRev['Visible']?'<h3>'.$resRev['UserName'].'</h3>':'<h3>Anonymous</h3>';
                                            echo '<h3>'.$resRev['Star_lvl'].' Stars</h3>';
                                            echo '<p style="min-height: 110px">'.$resRev['Review'].'</p>';
                                        echo '</div>';
                                        foreach(getItemsInRestaurantReview($resRev['ResReview_ID']) as $itemRev)
                                        {
                                            echo '<hr style="width:100%!important; border-top:2px solid white;"/>';
                                            echo '<div class="media my-3">';
                                                echo '<img class="mr-3 align-self-center" style="height: auto; width: 25%;" src="misc\images\Fries_Test.jpeg" alt="img">';
                                                echo '<div class="media-body">';
                                                    echo '<div>';
                                                        echo '<h3>'.getItemName($itemRev['Item_ID']).'</h3>';
                                                        echo '<h3>'.$itemRev['Star_lvl'].' Stars</h3>';
                                                        echo '<p>'.$itemRev['Review'].'</p>';
                                                    echo '</div></div></div>';
                                        }
                                        echo '</div></div></div>';

                    }
            ?>
        </div>
    </div>
</body>
</html>