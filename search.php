<?php
    mysql_connect("localhost", "root", "root") or die("Error connecting to database: ".mysql_error());
    /*
        localhost - it's location of the mysql server, usually localhost
        root - your username
        third is your password
         
        if connection fails it will stop loading the page and display an error
    */
     
    mysql_select_db("RFP") or die(mysql_error());
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<?php
    $product = $_GET['product']; 
    $topic = $_GET['topic']; 
    // gets value sent over search form
     

     
    if($product != "None"){ // if query length is more or equal minimum length then
         
        $product = htmlspecialchars($product); 
        $topic = htmlspecialchars($topic); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $topic = mysql_real_escape_string($topic);
        $product = mysql_real_escape_string($product);
        // makes sure nobody uses SQL injection
         
        //if both dropdown are selected
        $raw_results = mysql_query("SELECT * FROM QandA
            WHERE (`Topic` LIKE '%".$topic."%') OR (`Product` LIKE '%".$product."%')") or die(mysql_error());

         
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysql_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                echo "<p><h3>".$results['Question']."</h3>".$results['Answer']."</p>";
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
         
    }
    else{ // if query does not contain product
         
        $product = htmlspecialchars($product); 
        $topic = htmlspecialchars($topic); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $topic = mysql_real_escape_string($topic);
        $product = mysql_real_escape_string($product);
        // makes sure nobody uses SQL injection
         
        //if both dropdown are selected
        $raw_results = mysql_query("SELECT * FROM QandA
            WHERE `Topic` LIKE '%".$topic."%'") or die(mysql_error());
    }

    if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysql_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                echo "<p><h3>".$results['Question']."</h3>".$results['Answer']."</p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
?>
</body>
</html>