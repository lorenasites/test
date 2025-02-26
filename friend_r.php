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
         //$q->setFetchMode(PDO::FETCH_ASSOC);
          
         // displaying the data
         $users = $q->fetchAll(PDO::FETCH_ASSOC);
           static $b=0;
           foreach($users as $row){
            $b++;             
            echo  "<h3 id='blue' style='text-align:center; margin-left:50px;'> <br> Friend: " . $row["UserName1"] . " "
                    . "<form method='POST'><input type='submit' name='$b' value='Message Friend' id='btn1' style='margin-left:0%'></form> <br> </h3>";
            
            $me = $row["UserName2"];
            $you = $row["UserName1"];
            $cid = $row["ID"];
             //echo $me;
            // echo $you;
            $_SESSION["you"] = $you;
            $_SESSION["chatID"] = $cid;
            //echo $_SESSION["chatID"];
            
            
        }
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
       
        $conn = null;
        
         static $t =0;
        while($t<100){
            $t++;
        if(isset($_POST[strval($t)])){
        $servername = "localhost:3311";
        $username = "LorenaS";
        $password = "LorenaS";
        $dbname = 'social';
       
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
         // echo "Made connection";  
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
        $cid1 = $_SESSION["chatID"];
        $sql = "SELECT * FROM friend WHERE ID=$cid1";
         $q = $conn->query($sql);
         //$q->setFetchMode(PDO::FETCH_ASSOC);
          
         // displaying the data
         $users = $q->fetchAll(PDO::FETCH_ASSOC);
           static $b=0;
           foreach($users as $row){
            $b++; 
            $me = $row["UserName2"];
            $you = $row["UserName1"];
            
             
            $_SESSION["you"] = $you;
            $_SESSION["me"] = $me;
                       
            
        }
        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
       
        $conn = null;
                   header("Location: /PhTestpProject1/chat.php");
                   exit(); 
               }
        }
        ?>
    </body>
</html>
