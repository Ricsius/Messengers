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
               Hajnal Rich??rd<br>
               CI2E94<br>
               Webprogramoz??s K??ld??nc??k<br>
               2020.01.12<br>
               Ezt a megold??st Hajnal Rich??rd, CI2E94 k??ldte be ??s k??sz??tette a Webprogramoz??s kurzus K??ld??nc??k feladat??hoz.<br>
               Kijelentem, hogy ez a megold??s a saj??t munk??m.<br>
               Nem m??soltam vagy haszn??ltam harmadik f??lt??l sz??rmaz?? megold??sokat.<br>
               Nem tov??bb??tottam megold??st hallgat??t??rsaimnak, ??s nem is tettem k??zz??.<br>
               Az E??tv??s Lor??nd Tudom??nyegyetem Hallgat??i K??vetelm??nyrendszere (ELTE szervezeti ??s m??k??d??si szab??lyzata, II. K??tet, 74/C. ??) kimondja, <br>
               hogy mindaddig, am??g egy hallgat?? egy m??sik hallgat?? munk??j??t - vagy legal??bbis annak jelent??s r??sz??t - saj??t munk??jak??nt mutatja be, <br>
               az fegyelmi v??ts??gnek sz??m??t. A fegyelmi v??ts??g legs??lyosabb k??vetkezm??nye a hallgat?? elbocs??t??sa az egyetemr??l.<br>
            </span>
        </div>

        <script src = "demoScript.js"></script>
    </body>
</html>
