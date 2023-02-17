<html>
  <meta charset="UTF-8">
  <head>
    <title>AWS Boarding Pass Workshop</title>
    <link href="style.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="wrapper">
      <?php
        include 'menu.php';
      
        //This is a simple Login example for testing with WAF
      
        include('rds.conf.php');
      
        // Connect to the RDS database
        $connect = mysqli_connect($RDS_URL, $RDS_user, $RDS_pwd, $RDS_DB) or die(mysqli_connect_error()); 
      
        // If table doesn't exist, create it
        $result = mysqli_query($connect, "SHOW TABLES FROM `awsboardingpassdb` LIKE 'user';")
                  or die(mysqli_error($connect));
        if ($result->num_rows == 0) {
          $queries = file_get_contents("sql/users.sql");
          mysqli_multi_query($connect, $queries);
          while (mysqli_next_result($connect));
          }
        
        // Define Variables
        $username = $_POST['username'];
        $password = $_POST['password'];
      
        // Username and Password validation
        $data = mysqli_query($connect, "SELECT email FROM users where username='$username' AND password='{$password}'")
          or die(mysqli_error($connect)); 
        
          if (mysqli_num_rows($data) == 0) {
            Print '<h2>SQL Injection Test</h2>';
            Print 'Username or Password is incorrect. Please try again. <br/>';
            Print '<a href="waf.php">Return to Login Page</a>';
            exit;
          }
          
          while ($row = mysqli_fetch_assoc($data)) {
            Print '<h2>SQL Injection Test</h2>';
            print('Welcome! Here is your email address: '.$row['email']);
            print('<br/>');
            Print '<a href="waf.php">Return to Login Page</a>';
        }
      
      mysqli_close($connect);

      
      ?>
    </div>
  </body>
</html>