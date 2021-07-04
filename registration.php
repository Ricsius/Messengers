<html>
<body>
   <form action = 'registrationScript.php' method = 'post'>
      <label for = 'username'>Username</label> <br>
      <input type = 'text' name = 'username' required> <br>

      <label for = 'emailAddress'>Email Address</label> <br>
      <input type = 'text' name = 'emailAddress' required> <br>

      <label for = 'password'>Password</label> <br>
      <input type = 'password' name = 'password' required> <br>
   
      <input type = 'submit' value = 'Submit'>
   </form>

   <a href = 'index.php'>Back to main page</a> <br>
   
   <?php
      require 'common.php';
      
      if(!isset($_SESSION['registrationErrors'])) {
         $_SESSION['registrationErrors'] = '';
      }

      print $_SESSION['registrationErrors'];
      $_SESSION['registrationErrors'] = '';
   ?>
</body>
</html>
