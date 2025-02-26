
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
            
      }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }   
    ?>
     <header>
            
        <div class="navbar">
            
          </div>
            
      </header>
        <h2 id='nav'>What's Up SM?</h2> 
    <body>
        <div id='form'>
        <h3> Sign in: </h3>
       
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <p><span class="error">* Required Field</span></p>
                       
            User Name: <input type="text" name="name">
            <span class="error">*<?php echo $nameErr; ?></span>
            <br><br>
            Password: <input type="text" name="pass">
            <span class="error">*<?php echo $passErr; ?></span>
            <br><br>
        
            <input type="submit" name="submit" id='btn1'>
           
        </form>
        </div>
        
        <?php
             
        
       if (isset($_POST["submit"])) {
        //echo" <h2> Inserting into DataBase:</h2>";
         
        $name = $_POST["name"];
        $pass = $_POST["pass"];
        
        
        
        $servername = "localhost:3311";
        $username = "LorenaS";
        $password = "LorenaS";
        $dbname = 'dads';
        $login = 0;
        
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Made the connection";
            
            //hashing the PW
            $hashedpassword = ($_POST["pass"]);
            
            $sql1 = "SELECT * FROM users WHERE UserName='$name' AND Password='$hashedpassword'";
            $login = 0;
            $q1 = $conn->query($sql1);
            
            $q1->SetFetchMode(PDO::FETCH_ASSOC);
            
            while($row = $q1->fetch()){
                $login = 0;
               // echo "User Name: " . $row["UserName"] . "<br>";
                  if(count($row)>0){
                echo "<h1>Login Successful, Hello $name </h1>";
                
                $login = 1;
                 session_start();
                 //Setting Session Variables
              
                 
                 $uid = $row["ID"];
        
                 $_SESSION["username"] = "$name";
                 $_SESSION["password"] = "$pass";
                 
                 } 
            }
            
            if((isset($_POST["submit"]) && $login == 0)){
                echo "<h1 class='error'>invalid username or password, please try again</h1>";
            }
            
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
        $conn = null;
                     
       } 
        ?>
    </body>
</html>
