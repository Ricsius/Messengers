<html>
<body>
    <?php
    require 'common.php';

    $i = 0;

    while($users[$i]['id'] != $_SESSION['loggedInUserId']) {
      ++$i;
   }

    if(!isset($_SESSION['loggedInUserId']) || !$users[$i]['isAdmin']) {
        header('Location: index.php');
     }

    print '<form method = "post" action = "uploadTask.php">
        <div>
        <label for = "taskName"> Name </label> <br>
        <input type = "text" id = "taskName" name = "taskName" required>
        </div>

        <div>
        Difficulty <br>
        <input type = "radio" name = "taskDifficulty" value = "1"> 1 <br>
        <input type = "radio" name = "taskDifficulty" value = "2"> 2 <br>
        <input type = "radio" name = "taskDifficulty" value = "3"> 3 <br>
        <input type = "radio" name = "taskDifficulty" value = "4"> 4
        </div>

        <div>
            Layout <br>
            <textarea name = "taskLayout" placeholder = "JSON array of arrays here" required ></textarea>
        </div>

        <div>
            <input type = "submit" value = "Submit task">
        </div>
    </form>

    <a href = "taskList.php"> Back to task list </a> <br> <br>';

        if(!isSet($_SESSION['taskUploadError'])) {
            $_SESSION['taskUploadError'] = '';
         }

         if($_SESSION['taskUploadError'] != ''){ 
            print $_SESSION['taskUploadError'].'<br><br>';
            $_SESSION['taskUploadError'] = '';
         }

    print '<b>Rules</b>
            
    <ul>
        <li> A name must be given
        <li> A difficulty must be given
        <li> A layout must be given
        <li> The layout has to be given in a JSON array of arrays format
        <li> The numbers in the layout has to be between 1 and 11
    </ul>';
    ?>
</body>
</html>