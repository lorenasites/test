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
         <h3 id="blue"> View Your Image Gallery Below </h3>   
        <?php
        function displayImg(){
       $dirname = "uploads/";
        $images = scandir($dirname);
        $ignore = Array(".", "..");
        foreach($images as $curimg){
        if(!in_array($curimg, $ignore)) {
        echo "<img src='uploads/$curimg' /height='200' width='200' id='imgs' style='margin-left:6.5%;'>";
    }
}
       
    }
    displayImg();
    
        ?>
    </body>
</html>
