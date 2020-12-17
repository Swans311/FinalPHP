<?php 
    include(__DIR__.'/NavBar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmandize | Add Review</title>
</head>
<body>
    <div class="container gz-div-glow">
        <div class="container gz-div-inner mx-auto text-left pt-4 pb-2 text-white" style="font-family: textFont;">
            <form method="post">
                <div class="row border border-outline-white rounded mx-2 p-2">
                    <div class="row mx-2 p-1">
                        <div class="col form-group">
                            <h2 class="display-5 mb-5">Restaurant Review</h2>
                            <label for="exampleFormControlFile1">Upload Image Here:</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                            <div class="form-check mt-5">
                                <input class="form-check-input" type="checkbox" value="" id="reviewAnonymous">
                                <label class="form-check-label" for="reviewAnonymous"> Review Anonymously</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input size="25"type="text" id="restaurantName" placeholder="Restaurant Name"/>
                            </div>
                            <div class="form-group">
                                <input size="25"type="text" id="restaurantAddress" placeholder="Address"/>
                            </div>
                            <div class="form-group">
                                <input size="25"type="text" id="restaurantPhone" placeholder="Phone"/>
                            </div>
                            <div class="form-group">
                                <input size="25"type="text" id="restaurantURL" placeholder="URL"/>
                            </div>
                            <div class="form-group">
                                <label for="restaurantRating">Star Rating:</label>
                                <input type="number" id="restaurantRating" min="0" max="5" step="0.1"/>
                            </div>
                        </div>
                        <div class="col form-group">
                            <h2 class="text-white" style="font-family: textFont">Review</h2>
                            <textarea class="form-control" rows="6"></textarea>
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
                                <input size="25"type="text" id="food" placeholder="Food"/>
                            </div>
                            <div class="form-group">
                                <input size="25"type="text" id="foodCategories" placeholder="Categories"/>
                            </div>
                            <div class="form-group">
                                <label for="restaurantRating">Star Rating:</label>
                                <input type="number" id="restaurantRating" min="0" max="5" step="0.1"/>
                            </div>
                        </div>
                        <div class="col form-group">
                            <div class="d-flex justify-content-end mb-2">
                                <h2 class="text-white mr-auto" style="font-family: textFont">Review</h2>
                                <button id="removeFoodButton" class="btn btn-outline-danger text-white border-white"type="submit">Remove Food Item</button>
                            </div>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group m-3 d-flex justify-content-end">
                    <button id="addFoodButton" class="btn btn-outline-success mx-3 text-white border-white"type="submit">Add Food Item</button>
                    <button id="submitButton" class="btn btn-outline-light mx-3" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>