<?php
print <<<PAGE
<html lang="en">
<head>
  <meta charset="utf-8">
</head>
<body>
  <h1> Cartoon Newswork </h1>

  <h3> Today's Toons </h3>
  <ul style="list-style-type:none">
    <li><a href="?link=1">Rick and Morty</a></li>
    <li><a href="?link=2">Family Guy</a></li>
    <li><a href="?link=3">South Park</a></li>
    <li><a href="?link=4">Spongebob</a></li>
    <li><a href="?link=5">Big Mouth</a></li>
  </ul>
</body>
</html>
PAGE;

// if a link is clicked, check if there is a cookie set.
// if there is, show the page requested. if there isnt, show the login page
if (isset($_GET['link'])) {
  $link = $_GET['link'];

  if (isset ($_COOKIE['loggedIn'])) {
    // good to go... show the correct page
    if ($link == 1) {
      header("Location: ./rickMorty.html");
    }
    if ($link == 2) {
      header("Location: ./familyGuy.html");
    }
    if ($link == 3) {
      header("Location: ./southPark.html");
    }
    if ($link == 4) {
      header("Location: ./spongebob.html");
    }
    if ($link == 5) {
      header("Location: ./bigMouth.html");
    }
  }

  else {
    // no cookie set... go to the login page
    login();
  }
}


function login() {
  print <<<LOGIN
  <html>
  <body>
  <form id = "login" method="POST" action="hwk13.php">
  <span>Username: <input type="text" name="username"></span>
  <span>Password: <input type="text" name="password"></span>
  <input type = "submit" name="submit" value="Submit"><br><br>

  <span>Username: <input type="text" name="newUser"></span>
  <span>Password: <input type="text" name="newPass"></span>
  <input type = "submit" name="newUser" value="Register">
  </form>
  </body>
  </html>
LOGIN;

  if (isset($_POST['newUser'])) {
    // extract the username and password
    $newUser = $_POST['newUser'];
    $newPass = $_POST['newPass'];
    // check to see if the username has already been taken
    $read = fopen("./password.txt", "r");
    $users = array();
    while (! feof($read)) {
      $row = fgets($read);
      $values = explode(":", $row);
      $users[$values[0]] = $values[1];
    }
    fclose($read);

    foreach($values as $user => $password) {
      if ($newPass == $password) {
        print("Password already exists. Try again.");
      }
    }
      // add the username and password to the file
    $string = $newUser . ":" . $newPass;
    $add = fopen("./password.txt", "a");
    fwrite($add, $string);
    fclose($add);
    setcookie("loggedIn", "$newUser", time() + 120);
    header("Location: ./hwk14.php");

}


  if (isset($_POST['submit'])) {
    // extract the username and password
    $currUser = $_POST['username'];
    $pass = $_POST['password'];

    // check to make sure that the username and password exist
    $read2 = fopen("./password.txt", "r");
    $users2 = array();
    while (! feof($read2)) {
      $row2 = fgets($read2);
      $values2 = explode(":", $row2);
      $users2[$values2[0]] = $values2[1];
    }
    fclose($read2);

    foreach($values2 as $user2 => $password2) {
      if ($currUser == $user2 && $pass == $password) {
        // user exists... set a cookie and send back to home page
        setcookie("loggedIn", "$currUser", time() + 120);
        header("Location: ./hwk14.php");
      }
    }
    // if we got here, no match was found
    print("User does not exist");
  }
}
?>
