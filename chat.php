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
        session_start();
         $servername = "localhost:3311";
        $username = "LorenaS";
        $password = "LorenaS";
        $dbname = 'social';
       
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
         // echo "Made connection";  
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
        $usernamef = $_SESSION["username"];
        $sql = "SELECT * FROM friend WHERE UserName2 ='$usernamef' OR UserName1='$usernamef'";
         $q = $conn->query($sql);
         
         $users = $q->fetchAll(PDO::FETCH_ASSOC);
           static $b=0;
           foreach($users as $row){
            
            $me = $row["UserName2"];
            $you = $row["UserName1"];
            $cid = $row["ID"];
             //echo $me;
             //echo $you;
            $_SESSION["me"] = $me;
            $_SESSION["you"] = $you;
            $_SESSION["chatID"] = $cid;
            //echo $_SESSION["chatID"];
            //echo $_SESSION["you"];
            
        }
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
       
        $conn = null;
        
           echo "<h3 id='blue'> Chat with ". $_SESSION["you"] . " and " . $_SESSION["me"]."  </h3>";
            ?>
        <div class="chat" style="width:50%;margin-left: 25%;background:ghostwhite;border:solid indigo; border-radius:10px;padding:5px; text-align: center; min-height:50%;">
            <form id="chatform" method="post" style="margin-top:3%;">
                <textarea id="box" name="box" rows="4" cols="50">
                </textarea>
                <input type="submit" name="send" value="Send">
            </form>
             
        <form class="chat" method="post" enctype="multipart/form-data"style="width:50%;margin-left:20%;background:ghostwhite;border:solid indigo; border-radius:10px;padding:5px; text-align: center;" >
            <h3 id="blue"> Select Image(s) to Upload: </h3><br>
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" multiple>
            <br>
            <input type="submit" value="Upload Image(s)" name="submit1" id="btn1" style="margin-left:5%" >    
        </form>
      <?php
      if(isset($_POST["submit1"])){
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
       
        echo "<h3> Click on image to download <br> </h3>";
        echo "<a href='rotatedimg.jpg' download='rotatedimg.jpg'><img src='rotatedimg.jpg' alt='img' width='200' height='200'>
        </a>";
        
        $fileToDownload = 'rotatedimg.gif';
        
          if(isset($_POST["down"])){
       echo "<a href='download' download='rotatedimg.jpg'>";
    }
        
    }
        
    displayImg($image);
    imagedestroy($image);
      }
 
        if(isset($_POST["send"])){
        $servername = "localhost:3311";
        $username = "LorenaS";
        $password = "LorenaS";
        $dbname = 'social';
       
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           // echo "made the connection";
          $f1 = $_SESSION["you"];
          $f2 = $_SESSION["me"];
          $txt = $_POST["box"];
          
         $sql = "INSERT INTO `chat` (`Friend1`, `Friend2`, `Message`) "
                . "VALUES ('$f1', '$f2', '$txt')";
      
         $conn->exec($sql);
         
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
       }
        $conn = null;
        
          
        $servername = "localhost:3311";
        $username = "LorenaS";
        $password = "LorenaS";
        $dbname = 'social';
       
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
          //echo "Made connection";  
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $f1 = $_SESSION["you"];
          $f2 = $_SESSION["me"];
          
         $sql = "SELECT * FROM chat WHERE Friend1 ='$f1' AND Friend2='$f2' OR Friend1 ='$f2' AND Friend2='$f1'";
         $q = $conn->query($sql);
         $q->setFetchMode(PDO::FETCH_ASSOC);
          
        
         while($row = $q->fetch()){
                        
            echo  "<h3 id='blue'> <br> " . $row["Message"] . " "
                    . " <br> </h3>";
        }
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
       
        $conn = null;     
        
        
        ?>
        </div>
      
        
    </body>
</html>
