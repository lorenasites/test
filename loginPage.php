<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="home.css"/>
        <title></title>
    </head>
    <body>
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
                $nameErr = "User Name is Required";
            } else{
               $name = test_input($_POST["name"]);
               
                if(!preg_match("/^[a-zA-Z-0-9]*$/", $_POST["name"])) {
                 $nameErr = "Only letters and numbers allowed";
            }
            }
            
            if(empty($_POST["pass"])){
                $priceErr = "Price is Required";
            } else {
               $pass = test_input($_POST["pass"]);
               if(!preg_match("/^[a-zA-Z-0-9]*$/", $_POST["pass"])) {
                 $nameErr = "Only letters and numbers allowed";
            }
            }
            
            if(empty($_POST["fname"])){
                $fnameErr = "User Name is Required";
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
        <div id='form'>
        <h3> Sign up: </h3>
        <h5>Enter all the details below to create an account</h5>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <p><span class="error">* Required Field</span></p>
                       
            User Name: <input type="text" name="name">
            <span class="error">*<?php echo $nameErr; ?></span>
            <br><br>
            Password: <input type="text" name="pass">
            <span class="error">*<?php echo $passErr; ?></span>
            <br><br>
            Full Name: <input type="text" name="fname">
            <span class="error">*<?php echo $fnameErr; ?></span>
            <br><br>
            E-Mail: <input type="text" name="email">
            <span class="error"><?php echo $emailErr; ?></span>
            <br><br>
            <input type="submit" name="check" value="Verify">
            <input type="submit" name="submit">
        </form>
        </div>
        
        <?php
       if (isset($_POST["submit"])) {     
        $name = $_POST["name"];
        $pass = $_POST["pass"];
        $fname = $_POST["fname"];
        $email = $_POST["email"];
        session_start();
        
        $servername = "localhost:3311";
        $username = "LorenaS";
        $password = "LorenaS";
        $dbname = 'social';
        $login = 0;
       
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
            $hashedpassword = hash("sha256", $_POST["pass"]);
            $sql = "INSERT INTO `users` (`ID`, `UserName`, `Password`, `Name`, `Email`) "
                . "VALUES (NULL, '$name', '$hashedpassword', '$fname', '$email')";
      
         $conn->exec($sql);
       
         echo "<h3>Thank you for signing up, continue to login page.</h3>";
         echo "<h3><a href='signinPage.php'>Login Here</a><h3>";
                  
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
        $conn = null;
                     
       } 
        ?>
        
    </body>
</html>
