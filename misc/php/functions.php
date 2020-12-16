<?php
    require "../../model/ModelReview.php";
    
    echo calculateItemStarRating(2);

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
