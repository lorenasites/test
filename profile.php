<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel='stylesheet' href='home.css'/>
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
        echo "<h3 id='blue'>Your Current Profile Info</h3>";
        
        ?>
        
        <div id='div1'>
            <h3>Profile Info: </h3>
            <p> User Name: </p>
            <p> Password: </p>
            <p> Full Name: </p> 
            <p> Email: </p>
            
        </div>
        <div id='div2'>
             <h3> Your Profile Data: </h3>
            <?php
        echo $_SESSION["username"] . "<br>";
        echo "<br>";
        echo $_SESSION["password"]. "<br>";
        echo "<br>";
        echo $_SESSION["fullname"]. "<br>";
        echo "<br>";
        echo $_SESSION["email"]. "<br>";
         ?>
             <?php
     global $nameErr;
     $nameErr = "";
     global $passErr;
     $passErr = "";
     global $fname;
     $fnameErr ="";
     global $emailErr;
     $emailErr = "";
   
     global $name, $pass, $email, $fname;
     
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["name"])){
                $nameErr = "";
            } else{
               $name = test_input($_POST["name"]);
               
                if(!preg_match("/^[a-zA-Z-0-9]*$/", $_POST["name"])) {
                 $nameErr = "Only letters and numbers allowed";
            }
            }
            
            if(empty($_POST["pass"])){
                $passErr = "";
            } else {
               $pass = test_input($_POST["pass"]);
               if(!preg_match("/^[a-zA-Z-0-9]*$/", $_POST["pass"])) {
                 $nameErr = "Only letters and numbers allowed";
            }
            }
            
            if(empty($_POST["fname"])){
                $fnameErr = "";
            } else{
               $fname = test_input($_POST["fname"]);
               
                if(!preg_match("/^[a-zA-Z-' ]*$/", $_POST["fname"])) {
                 $fnameErr = "Only letters and whitespaces allowed";
            }
            }
            
            if (empty($_POST["email"])) {
                $emailErr = "";
            } else {
                $email = test_input($_POST["email"]);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid Format";
                }
            }
      }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }  
    ?>
        </div>
        <div id='edit'>
            <h2> Edit your Profile Data </h2>
            <p>Fill out the respective forms below with the data you wish to update</p>
           
            <h3> To Edit Your User Name: </h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                  
            User Name: <input type="text" name="name">
            <span class="error"><?php echo $nameErr; ?></span>
            <br><br>
             <input type="submit" name="submit1">
            </form>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h3> To Edit Your Password: </h3>
            Password: <input type="text" name="pass">
            <span class="error"><?php echo $passErr; ?></span>
            <br><br>
             <input type="submit" name="submit2">
            </form>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h3> To Edit Your Full Name on File: </h3>
            Full Name: <input type="text" name="fname">
            <span class="error"><?php echo $fnameErr; ?></span>
            <br><br>
            <input type="submit" name="submit3">
            </form>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h3> To Edit Your Email on File: </h3>
            E-Mail: <input type="text" name="email">
            <span class="error"><?php echo $emailErr; ?></span>
            <br><br>
            <input type="submit" name="submit4">
        </form>
        </div>
          <?php
       if (isset($_POST["submit1"])) {
        $newName = $_POST["name"];
        $servername = "localhost:3311";
        $username = "LorenaS";
        $password = "LorenaS";
        $dbname = 'social';
        $login = 0;
        $oldEmail = $_SESSION["email"];
       
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Made the connection";
            
            //hashing the PW
            //$hashedpassword = hash("sha256", $_POST["pass"]);
            $sql = "UPDATE users SET UserName = '$newName' WHERE Email='$oldEmail'";
      
         $conn->exec($sql);
       
         echo "<h3>Updated Successfully.</h3>";
         echo "<h3>New User Name: $newName<h3>";
         
         $_SESSION["username"] = $newName;
                  
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
        $conn = null;
                     
       } 
       
       if (isset($_POST["submit2"])) {
        $newPass = $_POST["pass"];
        $servername = "localhost:3311";
        $username = "LorenaS";
        $password = "LorenaS";
        $dbname = 'social';
        $login = 0;
        $oldEmail = $_SESSION["email"];
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Made the connection";
            
            //hashing the PW
            $hashedNewPassword = hash("sha256", $_POST["pass"]);
            $sql = "UPDATE users SET Password = '$hashedNewPassword' WHERE Email='$oldEmail'";
      
         $conn->exec($sql);
       
         echo "<h3>Updated Successfully.</h3>";
         echo "<h3>New Password: $newPass<h3>";
         
         $_SESSION["pasword"] = $newPass;
                  
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
        $conn = null;
                     
       } 
       if (isset($_POST["submit3"])) {
              
        $newFname = $_POST["fname"];
        
        
        $servername = "localhost:3311";
        $username = "LorenaS";
        $password = "LorenaS";
        $dbname = 'social';
        $login = 0;
        $oldEmail = $_SESSION["email"];
       
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "UPDATE users SET Name = '$newFname' WHERE Email='$oldEmail'";
      
         $conn->exec($sql);
       
         echo "<h3>Updated Successfully.</h3>";
         echo "<h3>New Name: $newFname<h3>";
         
         $cookie_name = "fullname";
        $cookie_value = "$newFname";
        //setcookie($cookie_name, $cookie_value, time()+846000, "/");
        $_SESSION["fullname"] = $newFname;
                  
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
        $conn = null;
                     
       } 
       
       if (isset($_POST["submit4"])) {
              
        $newEmail = $_POST["email"];
        $servername = "localhost:3311";
        $username = "LorenaS";
        $password = "LorenaS";
        $dbname = 'social';
        $login = 0;
        $oldName = $_SESSION["username"];
       
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "UPDATE users SET Email = '$newEmail' WHERE Email='$oldName'";
      
         $conn->exec($sql);
       
         echo "<h3>Updated Successfully.</h3>";
         echo "<h3>New Email: $newEmail<h3>";
         
         $cookie_name = "email";
        $cookie_value = "$newEmail";
        //setcookie($cookie_name, $cookie_value, time()+846000, "/");
        $_SESSION["email"] = $newEmail;
                  
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
        $conn = null;
                     
       } 
        ?>
    </body>
</html>
