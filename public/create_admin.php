<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>


<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  $username = mysql_prep($_POST["username"]);
  $password = password_encrypt($_POST["password"]);
  
  if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    redirect_to("new_subject.php");
  }
  
  $query  = "INSERT INTO admins (";
  $query .= "  username, hashed_password ";
  $query .= ") VALUES (";
  $query .= "  '{$username}', '{$password}' ";
  $query .= ")";
  $result = mysqli_query($connection, $query);

  if ($result) {
    // Success
    $_SESSION["message"] = "Admin created.";
    redirect_to("manage_admin.php");
  } else {
    // Failure
    $_SESSION["message"] = "Admin creation failed.";
    redirect_to("new_admin.php");
  }
  
} else {
  // This is probably a GET request
  redirect_to("new_admin.php");
}

?>


<?php
  if (isset($connection)) { mysqli_close($connection); }
?>
