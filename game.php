<html>
    <link rel="stylesheet" type="text/css" href="gameStyle.css">
    <body>
        <?php
            require 'common.php';
            
            if(!isset($_SESSION['loggedInUserId'])) {
                header('Location: index.php');
             }
             
            print '<div data-id = "'.$_GET['id'].'" id = "gameDiv">
                <table id = "gameTable"></table>
                <select></select> <br>
                <input id = "saveButton" type = "button" value = "Save game">
                <input id = "loadButton" type = "button" value = "Load saved state"> <br>
                <span></span> <br><br>
                <input id = "backButton" type = "button" value = "Back to task list">
            </div>

            <script src = "gameScript.js"></script>';
        ?>
    </body>
</html>