<html>
    <link rel="stylesheet" type="text/css" href="demoStyle.css">
    <body>
         <?php
            require 'common.php';

            print '<h1> Messengers </h1>
            <img src = "messengerLogo.png">';

            if(!isset($_SESSION['loggedInUserId'])) {
               print '<div id = "loginForm">
               <form action = "loginScript.php" method = "post">
               <label for = "emailAddress">Email address</label> <br>
               <input type = "text" name = "emailAddress" required> <br>
      
               <label for = "password">Password</label> <br>
               <input type = "password" name = "password" required> <br>
      
               <input type = "submit" value = "login">
            </form>';
            
            
      
            if(!isSet($_SESSION['loginError'])) {
               $_SESSION['loginError'] = '';
            }

            if($_SESSION['loginError'] != ''){ 
               print $_SESSION['loginError'].'<br><br>';
               $_SESSION['loginError'] = '';
            }

            print '<a href = "registration.php">Create a new account</a> <br>';
         }
         else {
            print '<a href = "taskList.php">Back to the task list</a> <br>';
         }
         ?>
      </div>
        
        <div id = "gameDiv">
           <h2> Demo </h2>

         <div id = 'decriptionDiv'>
            In this game your goal is to connect the numbers with their equals without crossing other lines in the process. <br>
            Bellow you can play a demo game.
         </div>

            <span id = "msg0"> Select a task, then click the button. <br> </span>
            <select id = "taskSelect">
                <option value="0">Easy</option>
                <option value="1">Medium</option>
                <option value="2">Hard</option>
            </select>

            <input id = "taskLoaderButton" type = "button" value = "Load task">

            <table id = "gameTable"></table>

            <span id = "elteMsg">
               <br>
               Hajnal Richárd<br>
               CI2E94<br>
               Webprogramozás Küldöncök<br>
               2020.01.12<br>
               Ezt a megoldást Hajnal Richárd, CI2E94 küldte be és készítette a Webprogramozás kurzus Küldöncök feladatához.<br>
               Kijelentem, hogy ez a megoldás a saját munkám.<br>
               Nem másoltam vagy használtam harmadik féltől származó megoldásokat.<br>
               Nem továbbítottam megoldást hallgatótársaimnak, és nem is tettem közzé.<br>
               Az Eötvös Loránd Tudományegyetem Hallgatói Követelményrendszere (ELTE szervezeti és működési szabályzata, II. Kötet, 74/C. §) kimondja, <br>
               hogy mindaddig, amíg egy hallgató egy másik hallgató munkáját - vagy legalábbis annak jelentős részét - saját munkájaként mutatja be, <br>
               az fegyelmi vétségnek számít. A fegyelmi vétség legsúlyosabb következménye a hallgató elbocsátása az egyetemről.<br>
            </span>
        </div>

        <script src = "demoScript.js"></script>
    </body>
</html>
