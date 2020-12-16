<?php
    include (__DIR__.'/NavBar.php');
    include (__DIR__. '/Model/db.php');


    function getCategory()
    {
        global $db;
        $stmt = $db->prepare("SELECT * FROM Review ORDER BY Item_ID");

        $category = array();
        if ($stmt->execute() && $stmt-> rowCount()>0){
            $category=$stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return($category);
    }


    function MostPopCat()
    {
        global $db;
        $stmt = $db->prepare("SELECT Category, COUNT(*) AS CatCount FROM Review  GROUP BY Category ORDER BY Item_ID LIMIT 10");
        $result=array();

        if ($stmt->execute() && $stmt->rowCount()>0){
           $result=$stmt->fetchAll(PDO::FETCH_ASSOC); 
        }
        return ($result);
    }


    $category=getCategory();

    $results=array();
    $results[0]=array();

    foreach($category as $cc){
        array_push($results[0], $cc['Category']);
    }

    $Cat=MostPopCat();
    $cat1=array();
    $cat1[0]=array();

    foreach($Cat as $CC){
        array_push($cat1[0], $CC['Category']);
    }



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmandize | Sign Up</title>
</head>
<body>
    <div class="container gz-div-glow">
        <div class="container gz-div-inner d-flex justify-content-center mx-auto text-center py-5">
            <div class="py-3">
                <h1 class="glow text-white display-4" style="font-family: logoFont;">Gourmandize</h1>
                <hr/>
                <p>Gourmandize was created by three friends who all have a passion for eating. They always thought that something was missing when they went to look for food and only saw reviews for the restaurant as a whole. One day while Casey Viens (Chairman) ordered subpar French Fries, he knew that this would be the straw the broke the camel's back. A mere few weeks later is when he got together with his two vice-chairs, Joe and Dave they came up with Gourmandize&trade; to never have this kind of experience again. </p>
                <h4 class="text-center">Local Cuisine</h4>
                <hr/>
                <table class="table-borderless">
                    <?php 
                    $cc=MostPopCat();
                    for($i=0; $i<1; $i++)
                    {
                        echo "<tr>";
                        foreach($Cat as $cc):
                            echo "<td>";
                            echo "<input type='button' value='Find ". $cc['Category'] ." Nearby'/>";
                            echo "</td>";  
                        endforeach;
                        echo "</tr>";
                    }
                    ?>
                </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>