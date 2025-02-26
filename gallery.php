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
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        //check is image is real or fake
        if (isset($_POST["submit"])){
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false ){
                //echo "File is an image " . $check["mime"] . ".";
                $uploadOk=1;
            } else {
                echo "file is not an image";
                $uploadOk=0;
            }
        }
        
        //Check if ile already existes
        if(file_exists($target_file)){
            echo "Sorry, file already exists.";
            $uploadOk=0;
        }
        
        //check file size
        if($_FILES["fileToUpload"]["size"] > 500000){
            echo "File too big";
            $uploadOk=0;
        }
        
        //Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "File type not allowed";
            $uploadOk=0;
        }
        
        //Check is uploadOk is set to 0 by error
        if ($uploadOk == 0){
            echo "File was not uploaded";
            //if everything else is ok, try to upload the file
        } else {
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                //echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . "Has been uploaded";
            } else{
               echo "could not upload";
            }
        }
        
    $image = imagecreatefromjpeg($target_file);

    $rotate = imagerotate($image, 00, 00);

    imagejpeg($rotate, "rotatedimg.jpg");

    
    
    function displayImg($image){
       $dirname = "uploads/";
        $images = scandir($dirname);
        $ignore = Array(".", "..");
        foreach($images as $curimg){
        if(!in_array($curimg, $ignore)) {
        echo "<img src='uploads/$curimg' /height='200' width='200' id='imgs'style='margin-left:6.5%;'>";
    }
}
       
    }
    
    displayImg($image);
    imagedestroy($image);
        ?>
       
        
    </body>
</html>