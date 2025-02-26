<html>
    <?php session_start()?>
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
    <body>
        <h3>Here is where you can see a list of all users, and friends</h3>
        <form id="uform" style="float:left;margin-left:100px;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            <h3>Click the button below to show a list of all users</h3>
        <input type='submit' name='users' value='Users' id='btn'>
        </form>
        <form style="float:right;margin-right:50px;" id="fform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            <h3>Click the button below to show a list of all Friends, Or potential Friends</h3>
        <input type='submit' name='friends' value='Friends' id='btn'>
        </form>
        
               
        <div id="div3" style="float:left;margin-left:5%;">
        <?php
        if(isset($_POST["users"])){
            $_SESSION["friend1"] = $_SESSION["username"];   
          echo "<h3 id='blue'>List of all users</h3>";
        
         $servername = "localhost:3311";
        $username = "LorenaS";
        $password = "LorenaS";
        $dbname = 'social';
        
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
         $sql2 = "SELECT * FROM users";
         $q = $conn->query($sql2);
       
           $users = $q->fetchAll(PDO::FETCH_ASSOC);
           static $a=0;
           foreach($users as $row){
               $a++;
               echo  "<h6 id='blue'> <br> User Name: " . $row["UserName"] . " <form method='POST' name='fr'><input type='submit' name='$a' value='Send Friend Request'></form> <br> </h6>";
             
           }
        
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
        }
        $conn = null;
       static $x =0;
        while($x<100){
            $x++;
        if(isset($_POST[strval($x)])){
                   $fid = strval($x);
                   echo "<h3 class='error'>Friend Request Sent! </h3><br>";
                   $_SESSION["friend2"] = $fid;
                   
               }
        }
        
         
        $cookieName = "friend";
       $cookieValue = $_SESSION["friend1"];
       setcookie($cookieName, $cookieValue, time()+846000, "/");
          
        ?> 
        </div>
        <div id="4" style="float:right;">
            <?php
           
        if(isset($_POST["friends"])){
           
            if ($_SESSION["friend2"] == $_SESSION["userid"]) {
           
       }
       if ($_SESSION["friend2"] == $_SESSION["userid"]) {
           echo "<h1 class='error'> ". $_COOKIE['friend'] . " Has sent you a friend request! You can accept or deny their request </h1>";
           
       ?>
         <form method='post' id=form1 style='margin-left:40%;'>
                <input type='submit' name="accept" Value='Accept!'>
                <input type='submit' name='deny' Value='Deny!'>
            </form> <?php
       }
       }

       $u1 = $_COOKIE['friend'];
       $u2 = $_SESSION["username"];
       
       if(isset($_POST["accept"])){
        
         $u1 = $_COOKIE['friend'];   
          $u2 = $_SESSION["username"]; 
          
         $servername = "localhost:3311";
        $username = "LorenaS";
        $password = "LorenaS";
        $dbname = 'social';
       
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           // echo "made the connection";
        
         $sql = "INSERT INTO `friend` (`ID`, `UserName1`, `UserName2`) "
                . "VALUES (NULL, '$u1', '$u2')";
      
         $conn->exec($sql);
       
         echo "<h3>You have accepted $u1 friend reqest. You are now friends!</h3>";
                        
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
       }
        $conn = null;
        
       if(isset($_POST["deny"])){
        
        $u1 = $_COOKIE['friend'];
       $u2 = $_SESSION["username"];
        echo "<h3 class='error' style='margin-right:5%;margin-left:-25%;'>You have denied $u1's friend reqest. You are not friends.</h3>";
       }
               
        ?>
            <?php
            if(isset($_POST["friends"])){
            echo "<form method='post' id='fform' style='margin-top:20px;'>
            <input type='submit' name='flist' Value='View Friend List' style='margin-left:155px;'>
            </form>";
            }
        if(isset($_POST["flist"])){
        header("Location: /PhTestpProject1/friend_r.php");
                   exit(); 
        }
    
            ?>
         </div>
            </div>
    </body>
</html>
