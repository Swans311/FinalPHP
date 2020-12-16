<?php
    require "../../model/ModelReview.php";

    //Returns -1 if no results
    function calculateItemStarRating($itemID)
    {
        $itemReviews = getAllReviewsForItem($itemID);
        
        $count = 0;
        $star = 0;

        foreach($itemReviews as $itemReview)
        {
            $count++;
            $star += $itemReview['Star_lvl'];
        }
        if($count == 0)
            return -1;
        else
        {
            $star /= $count;
            return $star;
        }
    }
    //Returns -1 if no results
    function calculateRestaurantStarRating($restaurantID)
    {
        $resReviews = getAllReviewsForRestaurant($restaurantID);
        
        $count = 0;
        $star = 0;

        foreach($resReviews as $resReview)
        {
            $count++;
            $star += $resReview['Star_lvl'];
        }
        if($count == 0)
            return -1;
        else
        {
            $star /= $count;
            return $star;
        }
    }
    function calculateAvgStarRatingFromUser($userID)
    {
        $resReviews = getAllResReviewsByUser($userID);
        $itemReviews = [];

        $count = 0;
        $star = 0;

        foreach($resReviews as $resReview)
        {
            $count++;
            $star += $resReview['Star_lvl'];
            $temp = getItemsInRestaurantReview($resReview['ResReview_ID']);
            foreach($temp as $itemReview)
                array_push($itemReviews, $itemReview);
        }
        foreach($itemReviews as $itemReview)
        {
            $count++;
            $star += $itemReview['Star_lvl'];
        }
        $star /= $count;
        return $star;
    }
