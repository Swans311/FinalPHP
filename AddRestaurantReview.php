<?php 
    include(__DIR__.'/NavBar.php');
    include(__DIR__.'/model/ModelReview.php');

    if(isset($_GET['itemID']))
    {
        $item = getItemByID($_GET['itemID']);
        $restaurant = getRestaurantByID($item['Restaurant_ID']);
    }
    if(isset($_GET['restaurantID']))
    {
        $restaurant = getRestaurantByID($_GET['restaurantID']);
    }
    if(isset($_POST))
        var_dump($_POST);
    
    $numFoodReviews = isset($_POST['hidden']) ? $_POST['hidden'] : 1;
    session_start();
    if(!isset($_POST))
        $_SESSION['numFoodReviews'] = 1;
    else
        $_SESSION['numFoodReviews'] = $numFoodReviews;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmandize | Add Review</title>
    <script>
    var hiddenInput = document.getElementById("hidden")
    function addFoodReviewArea()
    {
        document.getElementById("hidden").value++;
    }
    function regenerateFoodReviewAreas()
    {
        var div = document.getElementById("inputs");
        /*
        div.innerHTML += <?php /*
            for($i = 2; $i < $_SESSION['numFoodReviews']; $i++)
            {
                `<div class="row border border-outline-white rounded m-2 p-2">`
                . `<div class="row mx-2 p-1">`
                    . `<div class="col form-group">`
                        . `<h2 class="display-5 mb-5">Food Item Review</h2>`
                        . `<label for="exampleFormControlFile`.$i.`">Upload Image Here:</label>`
                        . `<input type="file" class="form-control-file" id="exampleFormControlFile`.$i.`">`
                    . `</div>`
                    . `<div class="col">`
                        . `<div class="form-group mt-4">`
                            . `<input size="25"type="text" name="food`.$i.`" id="food`.$i.`" placeholder="Food" value=`.(isset($_POST['food'.$i])? $_POST['food'.$i]: '') . `"/>`
                            . `</div>`
                            . `<div class="form-group">`
                            . `<input size="25"type="text" name="foodCategories`.$i.`" id="foodCategories`.$i.`" placeholder="Categories"  value="`.(isset($_POST['foodCategories'.$i])? $_POST['foodCategories'.$i]: '').`"/>`
                            . `</div>`
                            . `<div class="form-group">`
                            . `<label for="foodRating`.$i.`">Star Rating:</label>`
                            . `<input type="number" name="foodRating`.$i.`" id="foodRating`.$i.`" min="0" max="5" step="0.1" value="`. (isset($_POST['foodRating'.$i])? $_POST['foodRating'.$i]: '') .`"/>`
                            . `</div>`
                            . `</div>`
                        . `<div class="col form-group">`
                        . `<div class="d-flex justify-content-end mb-2">`
                        . `<h2 class="text-white mr-auto" style="font-family: textFont">Review</h2>`
                            . `<button id="removeFoodButton`.$i.`" class="btn btn-outline-danger text-white border-white"type="submit">Remove Food Item</button>`
                        . `</div>`
                        . `<textarea class="form-control" name="foodReview1" rows="4">`. (isset($_POST['foodReview'.$i])? $_POST['foodReview'.$i]: '').`</textarea>`
                    . `</div></div></div>`;
            }
        
        */?>*/
        for(let x = 2; x <= <?=$_SESSION['numFoodReviews']?> ; x++)
        {
            console.log(x)
            div.innerHTML += `<div class="row border border-outline-white rounded m-2 p-2">`
            + `<div class="row mx-2 p-1">`
                + `<div class="col form-group">`
                    + `<h2 class="display-5 mb-5">Food Item Review</h2>`
                    + `<label for="exampleFormControlFile`+ x +`">Upload Image Here:</label>`
                    + `<input type="file" class="form-control-file" id="exampleFormControlFile`+ x +`">`
                + `</div>`
                + `<div class="col">`
                    + `<div class="form-group mt-4">`
                        + `<input size="25"type="text" name="food`+x+`" id="food`+x+`" placeholder="Food" />`
                        + `</div>`
                        + `<div class="form-group">`
                        + `<input size="25"type="text" name="foodCategories`+x+`" id="foodCategories`+x+`" placeholder="Categories" />`
                        + `</div>`
                        + `<div class="form-group">`
                        + `<label for="foodRating`+x+`">Star Rating:</label>`
                        + `<input type="number" name="foodRating`+x+`" id="foodRating`+x+`" min="0" max="5" step="0.1" />`
                        + `</div>`
                        + `</div>`
                    + `<div class="col form-group">`
                    + `<div class="d-flex justify-content-end mb-2">`
                    + `<h2 class="text-white mr-auto" style="font-family: textFont">Review</h2>`
                        + `<button id="removeFoodButton`+x+`" class="btn btn-outline-danger text-white border-white"type="submit">Remove Food Item</button>`
                    + `</div>`
                    + `<textarea class="form-control" name="foodReview1" rows="4"></textarea>`
                + `</div></div></div>`;
        }
    }
    window.addEventListener('load', regenerateFoodReviewAreas);
</script>
</head>
<body>
    <div class="container gz-div-glow">
        <div class="container gz-div-inner mx-auto text-left pt-4 pb-2 text-white" style="font-family: textFont;">
            <form method="post">
                <div id="inputs">
                    <div class="row border border-outline-white rounded mx-2 p-2">
                        <div class="row mx-2 p-1">
                            <div class="col form-group">
                                <h2 class="display-5 mb-5">Restaurant Review</h2>
                                <label for="exampleFormControlFile1">Upload Image Here:</label>
                                <!--TODO:: Make this stick around after a POST-->
                                <input type="file" class="form-control-file" name="restaurantImage" id="exampleFormControlFile1">
                                <div class="form-check mt-5">
                                    <input class="form-check-input" name="reviewAnonymous" type="checkbox" value="" id="reviewAnonymous" <?=isset($_POST['reviewAnonymous'])? "checked" : "" ?>>
                                    <label class="form-check-label" for="reviewAnonymous"> Review Anonymously</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input size="25"type="text" name="restaurantName" id="restaurantName" placeholder="Restaurant Name" value="<?=$restaurant['Restaurant_Name']?>"/>
                                </div>
                                <div class="form-group">
                                    <input size="25"type="text" name="restaurantAddress" id="restaurantAddress" placeholder="Address" value="<?=$restaurant['ResAddress']?>"/>
                                </div>
                                <div class="form-group">
                                    <input size="25"type="text" name="restaurantPhone" id="restaurantPhone" placeholder="Phone" value="<?=$restaurant['Phone']?>"/>
                                </div>
                                <div class="form-group">
                                    <input size="25"type="text" name="restaurantURL" placeholder="URL" value="<?=$restaurant['Restaurant_URL']?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="restaurantRating">Star Rating:</label>
                                    <input type="number" name="restaurantRating" id="restaurantRating" min="0" max="5" step="0.1" value="<?=isset($_POST['restaurantRating'])? $_POST['restaurantRating']: '' ?>"/>
                                </div>
                            </div>
                            <div class="col form-group">
                                <h2 class="text-white" style="font-family: textFont">Review</h2>
                                <textarea name="restaurantReview" class="form-control" rows="6"><?= isset($_POST['restaurantReview'])? $_POST['restaurantReview']: ''?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row border border-outline-white rounded m-2 p-2">
                        <div class="row mx-2 p-1">
                            <div class="col form-group">
                                <h2 class="display-5 mb-5">Food Item Review</h2>
                                <label for="exampleFormControlFile1">Upload Image Here:</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                
                            </div>
                            <div class="col">
                                <div class="form-group mt-4">
                                    <input size="25"type="text" name="food1" id="food1" placeholder="Food" value="<?=isset($_POST['food1'])? $_POST['food1']: (isset($item) ? $item['ItemName'] : '') ?>"/>
                                </div>
                                <div class="form-group">
                                    <input size="25"type="text" name="foodCategories1" id="foodCategories1" placeholder="Categories"  value="<?=isset($_POST['foodCategories1'])? $_POST['foodCategories1']: '' ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="foodRating1">Star Rating:</label>
                                    <input type="number" name="foodRating1" id="foodRating1" min="0" max="5" step="0.1" value="<?=isset($_POST['foodRating1'])? $_POST['foodRating1']: '' ?>"/>
                                </div>
                            </div>
                            <div class="col form-group">
                                <div class="d-flex justify-content-end mb-2">
                                    <h2 class="text-white mr-auto" style="font-family: textFont">Review</h2>
                                    <!--<button id="removeFoodButton" class="btn btn-outline-danger text-white border-white"type="submit">Remove Food Item</button>-->
                                </div>
                                <textarea class="form-control" name="foodReview1" rows="4"><?= isset($_POST['foodReview1'])? $_POST['foodReview1']: ''?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group m-3 d-flex justify-content-end">
                    <input name="hidden" id="hidden" type="number" min="1" step="1" value="<?= isset($_POST['hidden'])? $_POST['hidden']: '1'?>" hidden>
                    <button id="addFoodButton" class="btn btn-outline-success mx-3 text-white border-white"type="submit" onclick = addFoodReviewArea()>Add Food Item</button>
                    <button id="submitButton" class="btn btn-outline-light mx-3" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>