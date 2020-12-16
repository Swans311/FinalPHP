<?php
    include (__DIR__ . '/db.php');

    function addUser($username, $email, $hashedPass, $first, $last, $imageFilePath)
    {
        global $db;
        $results = 'Data NOT Added';
        $stmt = $db->prepare("INSERT INTO rusers SET Username = :username, User_Password = :hashedPass, User_Email = :email, FName = :fname, LName = :lname");

        $stmt -> bindValue(':username', $username);
        $stmt -> bindValue(':hashedpass', $hashedPass);
        $stmt -> bindValue(':email', $email);
        $stmt -> bindValue(':fname', $first);
        $stmt -> bindValue(':lname', $last);
        

        if ($stmt->execute() && $stmt->rowCount() > 0) 
        {
            $results = 'Data Added';
        }
        
        return ($results);
    }
    function checkLogin($username, $hashedPass)
    {
        global $db;
        $stmt = $db->prepare("SELECT User_ID FROM rusers WHERE Username =:username AND User_Password = :pass");

        $stmt->bindValue(':userName', $username);
        $stmt->bindValue(':pass', $hashedPass);
        
        $stmt->execute ();
    
        return( $stmt->rowCount() > 0);
    }
    function delUser($userID)
    {
        global $db;
        $stmt = $db->query("DELETE FROM rusers WHERE User_ID = :userID;");

        $stmt->bindValue(':userID', $userID);

        $stmt->execute ();

        return( $stmt->rowCount() > 0);
    }
    function modifyUser($userID, $username, $email, $hashedPass, $first, $last, $imageFilePath)
    {
        global $db;
        $results = 'Data NOT Updated';
        $stmt = $db->prepare("Update rusers SET Username = :username, Password = :hashedPass, User_Email = :email, FName = :fname, LName = :lname WHERE User_ID = :id");

        $stmt -> bindValue(':username', $username);
        $stmt -> bindValue(':hashedpass', $hashedPass);
        $stmt -> bindValue(':email', $email);
        $stmt -> bindValue(':fname', $first);
        $stmt -> bindValue(':lname', $last);
        $stmt -> bindValue(':id', $userID);
        

        if ($stmt->execute() && $stmt->rowCount() > 0) 
        {
            $results = 'Data Updated';
        }
        
        return ($results);
    }
    function getUsername($userID)
    {
        global $db;
        $stmt = $db->prepare("SELECT Username FROM rusers WHERE User_ID =:userID");

        $stmt->bindValue(':userID', $userID);

        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results['Username'];
    }
    function getUserByID($userID)
    {
        global $db;
        $stmt = $db->prepare("SELECT * FROM rusers WHERE User_ID =:userID");

        $stmt->bindValue(':userID', $userID);

        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results;
    }
    function addItemReview($restaurantID, $userID, $itemID, $resReviewID, $dateTime, $rating, $review, $anonymous, $imageFilePath)
    {
        global $db;
        $results = 'Data NOT Added';
        $stmt = $db->prepare("INSERT INTO review SET Restaurant_ID = :restaurantID, User_ID = :userID, Item_ID = :itemID, Review = :review, Star_lvl = :rating, Username = :username, Uname_Visible = :visible, Review_Date = :date, ResReview_ID = :resRevID");

        $stmt->bindValue(':restaurantID', $restaurantID);
        $stmt->bindValue(':userID', $userID);
        $stmt->bindValue(':itemID', $itemID);
        $stmt->bindValue(':review', $review);
        $stmt->bindValue(':rating', $rating);
        $stmt->bindValue(':username', getUsername($userID));
        $stmt->bindValue(':visible', !$anonymous);
        $stmt->bindValue(':date', $dateTime);
        $stmt->bindValue(':resRevID', $resReviewID);

        $stmt->execute ();

        return( $stmt->rowCount() > 0);
    }
    function addRestaurantReview($restaurantID, $userID, $retaurantReview, $rating,  $anonymous, $imageFilePath, $itemReview2DList)
    {
        global $db;
        $results = 'Data NOT Added';
        $stmt = $db->prepare("INSERT INTO review SET Restaurant_ID = :restaurantID, User_ID = :userID, Review = :review, Star_lvl = :rating, Username = :username, ReviewDate = :revDate, Visible = :visible");
        $stmt->bindValue(':restaurantID', $restaurantID);
        $stmt->bindValue(':userID', $userID);
        $stmt->bindValue(':review', $retaurantReview);
        $stmt->bindValue(':rating', $rating);
        $stmt->bindValue(':username', getUsername($userID));
        $stmt->bindValue(':visible', $anonymous);

        $time = date('Y-m-d H:i:s');

        $stmt->bindValue(':revDate', $time);

        $stmt->execute ();

        $success = $stmt->rowCount() > 0;

        //get resReviewID by searching table for match on restaurantID, userID, date
        $stmt = $db->prepare("SELECT TOP 1 ResReview_ID WHERE Restaurant_ID = :resID AND User_ID = :userID AND ReviewDate = :revDate");
        $stmt->bindValue(':resID', $restaurantID);
        $stmt->bindValue(':userID', $userID);
        $stmt->bindValue(':revDate', $time);

        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $resRevID = $results['ResReview_ID'];

        //loop throught list and call addItemReview()
        foreach($itemReview2DList as $itemReviewList)
        {
            addItemReview($restaurantID, $userID, $itemReviewList['itemID'], $resRevID, $time, $itemReviewList['rating'], $itemReviewList['review'], $anonymous, ''/*$itemReviewList['imageFilePath']*/);
        }
    }
    function searchByRestaurant($name, $category)
    {
        global $db;
       
       $binds = array();
       $sql = "SELECT Restaurant_ID, Restaurant_Name, Address, Phone, Restaurant_URL, Category FROM restaurant WHERE 0=0 ";
       if ($name != "") {
            $sql .= " AND Restaurant_Name LIKE :name";
            $binds['name'] = '%'.$name.'%';
       }
       if ($category != "")
       {
            $sql .= " AND Category LIKE :category";
            $binds['category'] = '%'.$category.'%';
       }
       
       $sql .= " ORDER BY Restaurant_Name DESC";

       $stmt = $db->prepare($sql);
      
        $results = array();
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return ($results);
    }
    function searchByItem($name, $category)
    {
        global $db;
       
       $binds = array();
       $sql = "SELECT Item_ID, Restaurant_ID, ItemName, Category FROM menuitem WHERE 0=0 ";
       if ($name != "") {
            $sql .= " AND ItemName LIKE :name";
            $binds['name'] = '%'.$name.'%';
       }
       if ($category != "")
       {
            $sql .= " AND Category LIKE :category";
            $binds['category'] = '%'.$category.'%';
       }
       
       $sql .= " ORDER BY ItemName DESC";

       $stmt = $db->prepare($sql);
      
        $results = array();
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return ($results);
    }
    function deleteRestaurantReview($resReviewID)
    {
        global $db;
        $stmt = $db->prepare("DELETE FROM restaurantreview WHERE ResReview_ID = :ID;");

        $stmt->bindValue(':ID', $resReviewID);

        $stmt->execute ();

        return( $stmt->rowCount() > 0);
    }
    function deleteRestaurantReviewAndItems($resReviewID)
    {
        $resDeleteSuccess = deleteRestaurantReview($resReviewID);

        global $db;
        //LoopThrough connected ItemReviews
        $stmt = $db->prepare("SELECT Review_ID, COUNT(*) AS reviewCount FROM review WHERE ResReview_ID = :ID;");
        $stmt->bindValue(':ID', $resReviewID);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);   
        
        $reviewCount = $results['reviewCount'];//Number
        $reviewIDs = $results['Review_ID'];//Array
        $itemsDeleteSuccess = true;

        foreach($reviewIDs as $reviewID)
        {
            $temp = deleteItemReview($reviewID);
            $itemsDeleteSuccess = $itemsDeleteSuccess ? $temp : false;
        }
        return $resDeleteSuccess && $itemsDeleteSuccess;
    }
    function deleteItemReview($itemReviewID)
    {
        global $db;
        $stmt = $db->prepare("DELETE FROM review WHERE Review_ID = :ID;");

        $stmt->bindValue(':ID', $itemReviewID);

        $stmt->execute ();

        return( $stmt->rowCount() > 0);
    }
    function addRestaurant($name, $address, $phone, $url, $categories)
    {
        global $db;
        $results = 'Data NOT Added';
        $stmt = $db->prepare("INSERT INTO restaurant SET Restaurant_Name = :resName, ResAddress = :resAddress, Phone = :phone, Restaurant_URL = :resURL, Category = :categories");

        $stmt -> bindValue(':resName', $name);
        $stmt -> bindValue(':resAddress', $address);
        $stmt -> bindValue(':phone', $phone);
        $stmt -> bindValue(':resURL', $url);
        $stmt -> bindValue(':categories', $categories);
        
        if ($stmt->execute() && $stmt->rowCount() > 0) 
        {
            $results = 'Data Added';
        }
        
        return ($results);
    }
    function getRestaurantReview($resReviewID)
    {
        global $db;
        $stmt = $db->prepare("SELECT * FROM restaurantreview WHERE ResReview_ID =:ID");

        $stmt->bindValue(':ID', $resReviewID);

        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results;
    }
    function getItemReview($reviewID)
    {
        global $db;
        $stmt = $db->prepare("SELECT * FROM review WHERE Review_ID =:ID;");

        $stmt->bindValue(':ID', $reviewID);
        
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results;
    }
    function getItemsInRestaurantReview($resReviewID)
    {
        global $db;
        //get connected ItemReviews
        $stmt = $db->prepare("SELECT Review_ID FROM review WHERE ResReview_ID = :ID;");
        $stmt->bindValue(':ID', $resReviewID);

        $stmt->execute();
        $results = $stmt->fetchALL(PDO::FETCH_ASSOC);   

        $itemReviewList = array();
        //loop through and append to list
        foreach($results as $result)
        {
            $reviewID = $result['Review_ID'];
            array_push($itemReviewList, getItemReview($reviewID));
        }
        return $itemReviewList;
    }
    function getAllReviewsForRestaurant($restaurantID)
    {
        global $db;
        //get connected ItemReviews
        $stmt = $db->prepare("SELECT ResReview_ID FROM restaurantreview WHERE Restaurant_ID = :ID;");
        $stmt->bindValue(':ID', $restaurantID);

        $stmt->execute();
        $results = $stmt->fetchALL(PDO::FETCH_ASSOC);   

        $resReviewList = array();
        //loop through and append to list
        foreach($results as $result)
        {
            $resReviewID = $result['ResReview_ID'];
            array_push($resReviewList, getRestaurantReview($resReviewID));
        }
        return $resReviewList;
    }
    function getAllReviewsForItem($itemID)
    {
        global $db;
        //get connected ItemReviews
        $stmt = $db->prepare("SELECT Review_ID FROM review WHERE Item_ID = :ID;");
        $stmt->bindValue(':ID', $itemID);

        $stmt->execute();
        $results = $stmt->fetchALL(PDO::FETCH_ASSOC);   

        $itemReviewList = array();
        //loop through and append to list
        foreach($results as $result)
        {
            $reviewID = $result['Review_ID'];
            array_push($itemReviewList, getItemReview($reviewID));
        }
        return $itemReviewList;
    }
    function getAllResReviewsByUser($userID)
    {
        global $db;
        //get connected ItemReviews
        $stmt = $db->prepare("SELECT ResReview_ID FROM restaurantreview WHERE User_ID = :ID;");
        $stmt->bindValue(':ID', $userID);

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);   

        $resReviewList = array();
        //loop through and append to list
        foreach($results as $result)
        {
            $reviewID = $result['ResReview_ID'];
            array_push($resReviewList, getRestaurantReview($reviewID));
        }
        return $resReviewList;
    }
    function searchUser($username, $email, $first, $last)
    {
        global $db;
       
        $binds = array();
        $sql = "SELECT * FROM rusers WHERE 0=0 ";
        if ($username != "") {
             $sql .= " AND Username LIKE :name";
             $binds['name'] = '%'.$username.'%';
        }
        if ($email != "")
        {
             $sql .= " AND User_Email LIKE :email";
             $binds['email'] = '%'.$email.'%';
        }
        if ($first != "")
        {
             $sql .= " AND FName LIKE :fname";
             $binds['fname'] = '%'.$first.'%';
        }
        if ($email != "")
        {
             $sql .= " AND LName LIKE :lname";
             $binds['lname'] = '%'.$last.'%';
        }

        $sql .= " ORDER BY Username DESC";
 
        $stmt = $db->prepare($sql);
       
         $results = array();
         if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
         }
         return ($results);
    }
    function editItemReview($reviewID, $rating, $anonymous, $categories, $review, $imageFilePath)
    {
        global $db;

        $results = "Data NOT Updated";
        
        $stmt = $db->prepare("UPDATE reviews SET Star_lvl = :rating, Uname_Visible = :anon, Category = :categories, Review = :review WHERE Review_ID=:id");
        
        $stmt->bindValue(':rating', $rating);
        $stmt->bindValue(':anon', $anonymous);
        $stmt->bindValue(':categories', $categories);
        $stmt->bindValue(':review', $review);
        $stmt->bindValue(':id', $reviewID);

      
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = 'Data Updated';
        }
        
        return ($results);
    }
    function editRestaurantReview( $resReviewID, $review, $rating, $anonymous, $imageFilePath)
    {
        global $db;

        $results = "Data NOT Updated";
        
        $stmt = $db->prepare("UPDATE reviews SET Star_lvl = :rating, Uname_Visible = :anon, Review = :review WHERE Review_ID=:id");
        
        $stmt->bindValue(':rating', $rating);
        $stmt->bindValue(':anon', $anonymous);
        $stmt->bindValue(':review', $review);
        $stmt->bindValue(':id', $resReviewID);

        if ($stmt->execute() && $stmt->rowCount() > 0) 
        {
            $results = 'Data Updated';
        }
        
        return ($results);
    }
    function editRestaurant( $restaurantID, $name, $address, $phone, $url, $categories)
    {
        global $db;

        $results = "Data NOT Updated";
        
        $stmt = $db->prepare("UPDATE restaurant SET Restaurant_Name = :resName, ResAddress = :addr, Phone = :phone, Restaurant_URL = :resURL, Category = :categories WHERE Review_ID=:id");
        
        $stmt->bindValue(':resName', $name);
        $stmt->bindValue(':addr', $address);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':resURL', $url);
        $stmt->bindValue(':categories', $categories);
        $stmt->bindValue(':id', $restaurantID);

        if ($stmt->execute() && $stmt->rowCount() > 0) 
        {
            $results = 'Data Updated';
        }
        
        return ($results);
    }