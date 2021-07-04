<?php
   require 'common.php';

   $i = 0;
   while($i < count($users)) {
      if($users[$i]['username'] == $_POST['username']) {
         $_SESSION['registrationErrors'] .= 'The username is already taken<br>';
      }
      
      if($users[$i]['emailAddress'] == $_POST['emailAddress']) {
         $_SESSION['registrationErrors'] .= 'The email address is already in use<br>';
      }
      
      if($users[$i]['password'] == $_POST['password']) {
         $_SESSION['registrationErrors'] .= 'The password is already taken<br>';
      }

      ++$i;
   }
   
   if(strlen($_POST['username']) <  5){
      $_SESSION['registrationErrors'] .= 'The username is shorter than 5 characters<br>';
   }
   
   if(strlen($_POST['emailAddress']) == 0){
      $_SESSION['registrationErrors'] .= 'Email address is not given<br>';
   }
   else if (!filter_var($_POST['emailAddress'], FILTER_VALIDATE_EMAIL)) {
      $_SESSION['registrationErrors'] .= 'Email address is not valid<br>';
   }
   
   if(strlen($_POST['password']) < 4){
      $_SESSION['registrationErrors'] .= 'The password is shorter than 4 characters<br>';
   }

   if(strlen($_SESSION['registrationErrors']) > 0) {
      header('Location: registration.php');
      exit;
   }
   
   
   $user = [];
   $user['id'] = count($users);
   $user['username'] = str_replace('<', '&lt', $_POST['username']);
   $user['emailAddress'] = str_replace('<', '&lt', $_POST['emailAddress']);
   $user['password'] = str_replace('<', '&lt', $_POST['password']);
   $user['isAdmin'] = false;
   
   $users[] = $user;
   $usersString = json_encode($users);
   
   file_put_contents($usersFile, $usersString);
   
   header('Location: index.php');
?>
