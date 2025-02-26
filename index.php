<?php session_start(); 
$name = $_SESSION["username"];

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet' href='home.css'/>
        <title></title>
    </head>
    <body>
         <header>
            
        <div class="navbar">
            <a style='text' href="home.php">Home</a><br><br><br><br>
            <a href="friend.php">Friends</a><br><br><br><br>
            <a href="image.php">Images</a><br><br><br><br>
            <a href="profile.php">Profile</a><br><br><br><br>
          
          </div>
            
      </header>
        <h2 id='nav'>What's Up SM?</h2> 
        
        <?php
        echo "<h1 id='blue'>Welcome $name To 'What's Up Social Media'! </h1> <br> <h3 id='blue'>View recent posts below</h3>";
          function displayImg(){
       $dirname = "uploads/";
        $images = scandir($dirname);
        $ignore = Array(".", "..");
        foreach($images as $curimg){
        if(!in_array($curimg, $ignore)) {
        echo "<img src='uploads/$curimg' /height='500' width='500' id='imgs' style='margin-left:26.5%;border: solid indigo;background:ghostwhite;'>";
    }
}
       
    }
    displayImg();
        ?>
    </body>
</html>
