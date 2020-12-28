<!DOCTYPE html>
<html>
  <head>
    <meta charset = "utf-8">
    <title>Thank You For Signing Up</title>
    <link rel = "stylesheet" type = "text/css" href = "register.css">
  </head>
  <body>
      <?php
      $info = array("first_name" => $_POST['first_name'],
      "last_name" => $_POST['last_name'],
      "birthday" => $_POST['birthday'],
      "sex" => $_POST['sex'],
      "email" => $_POST['email'],
      "phone" => $_POST['phone'],
      "street_address" => $_POST['street_address'],
      "city" => $_POST['city'],
      "state" => $_POST['state'],
      "zip_code" => $_POST['zip_code'],
      "jersey" => $_POST['jersey']
    );
    funB();
    funA($info);

    function funA($info)
    {
      $dbhost = "localhost";
      $dbuser = "root";
      $dbpass = "";
      $dbname = "csc355finalproject";
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
      $tbname = "registered";

      if( ! $conn )
      {
        print("Could not connect: " . mysqli_error() . "<br>");
      }

      mysqli_select_db( $conn, 'csc355finalproject');

      $sqli = "INSERT INTO $tbname (
        participant_id, first_name, last_name, birthday, sex, email, phone, street_address, city, state, zip_code, jersey, signup_date
      ) VALUES
      (DEFAULT, '{$info['first_name']}', '{$info['last_name']}',
        '{$info['birthday']}', '{$info['sex']}',
        '{$info['email']}', '{$info['phone']}',
        '{$info['street_address']}', '{$info['city']}',
        '{$info['state']}', '{$info['zip_code']}',
        '{$info['jersey']}', NOW());";

        $retval = mysqli_query( $conn, $sqli);

        if( ! $retval )
        {
          print("Could not add data in the table: " . mysqli_error($conn) . "<br>");
        }

        $sqli = "SELECT * FROM $tbname WHERE first_name = '{$info['first_name']}' AND last_name = '{$info['last_name']}'";
          $retval = mysqli_query($conn, $sqli);
          if( ! $retval)
          {
            print("Could nto retrieve data in the table: " . mysqli_error($conn) . "<br>");
          }
        echo("<h2><b>Participant Information</b></h2");
        while($row = mysqli_fetch_array($retval))
        {
          print
            "Participant ID: {$row['participant_id']} <br> ".
            "First Name: {$row['first_name']} <br> ".
            "Last Name: {$row['last_name']} <br> ".
            "Date of Birth: {$row['birthday']} <br> ".
            "Gender: {$row['sex']} <br> ".
            "Email: {$row['email']} <br> ".
            "Phone: {$row['phone']} <br> ".
            "Street Address: {$row['street_address']} <br> ".
            "City: {$row['city']} <br> ".
            "State: {$row['state']} <br> ".
            "Zip Code: {$row['zip_code']} <br> ".
            "Jersey: {$row['jersey']} <br> ".
            "Sign Up Date: {$row['signup_date']} <br> ";
        }
        print "<hr><h4>If you have any questions or comments, please <a href = 'aboutus.html'> contact us here!</a></h4>
        <br>
        <h4>To see all contestants participating in the competition, <a href = 'showtables.php'> click here </a></h4>";

        mysqli_close($conn);
    }
    function funB()
    {
      print("<h2 align = 'center'><b>Thank You For Signing Up!</b></h2>
            <h3 align = 'center'> Here is the information you have inputed...</h3>");
    }
       ?>
  </body>
</html>
