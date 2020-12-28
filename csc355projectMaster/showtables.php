<!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8">
  <title>Thank You for Signing Up</title>
  <link rel = "stylesheet" type = "text/css" href ="">
</head>
<body>
  <?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "csc355finalproject";
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $tbname = "registered";
    if ( ! $conn )
    {
      print("Could not connect: " . mysqli_error(). "<br>");
    }

    mysqli_select_db($conn, 'csc355finalproject');
    print "<h2><b>People Signed Up</b></h2>";
    print "<table margin-left: auto margin-right: auto; padding:10; font-size:18 px;><tr><th>Name</th></tr>";
    $sqli = "Select first_name, last_name FROM $tbname";
      $retval = mysqli_query( $conn, $sqli);
      if ( ! $retval )
     {
       print("Could not retrieve data from the table: " . mysqli_error($conn) . "<br>");
     }
     while ($row = mysqli_fetch_array($retval))
     {
       print "<tr><td>{$row['first_name']}</td><td>{$row['last_name']}</td></tr>";
     }
     print"</table>";
     mysqli_close($conn);
     print "<hr><h4>If you have any questions or comments, please <a href = 'aboutus.html'> contact us here!</a></h4>"
   ?>
</body>
</html>
