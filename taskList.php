<html>
   <link rel="stylesheet" type="text/css" href="taskListStyle.css">
   <body>
      <?php
         require 'common.php';

         if(!isset($_SESSION['loggedInUserId'])) {
            header('Location: index.php');
         }

         $userId = $_SESSION['loggedInUserId'];
         $name;

         $userIndex = 0;
         while($users[$userIndex]['id'] != $userId){
            ++$userIndex;
         }

         $name = $users[$userIndex]['username'];

         print '<div>
         Welcome '.$name.'! <br><br>

         <a href = "logout.php"> <input type = "button" value="Log out"> </a>';

         if($users[$userIndex]['isAdmin']) {
            print '<a href = "newTask.php"> <input type = "button" value="Create new task"> </a>';
         }

         print '<br> <br>';

         print '</div>';

         print '<span> Click on the task name to begin </span> <br> <br>';

         print '<table>';

         print '<tr>';

         print '<th> Task Name </th>
         <th> Difficulty </th>
         <th> Users who completed it </th>
         <th> Have you completed it </th>';

         if($users[$userIndex]['isAdmin']) {
            print '<th> Delete button </th>';
         }

         print '</tr>';

         for($i = 0; $i < count($tasks); ++$i) {
            $taskId = $tasks[$i]['id'];
            $taskName = $tasks[$i]['name'];
            $taskDifficulty = $tasks[$i]['difficulty'];
            $completionCount = 0;
            $isCompletedByUser = 'No';

            for($j = 0; $j < count($completions); ++$j) {
               if($completions[$j]['taskId'] == $taskId) {
                  if($completions[$j]['userId'] == $userId) {
                     $isCompletedByUser = 'Yes';
                  }
                  ++$completionCount;
               }
            }

            print '<tr>';
            print '<td> <a href = "game.php?id='.$taskId.'">'.$taskName.'</a> </td>
            <td>'.$taskDifficulty.'</td>
            <td>'.$completionCount.'</td>
            <td>'.$isCompletedByUser.'</td>';

            if($users[$userIndex]['isAdmin']) {
               print '<td> <a href = "deleteTask.php?id='.$taskId.'"> <input type="button" value = "Delete"> </a> </td>';
            }

            print '</tr>';
         }

         print '</table>';
      ?>
   </body>
</html>
