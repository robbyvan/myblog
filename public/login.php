<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php $layout_context = "admin"; ?>
<?php find_selected_admin(); ?>

<?php 
  $username = "";

  if (isset($_POST['submit'])) {
  // Process the form
  $username = mysql_prep($_POST["username"]);
  $password = $_POST["password"];
  $found_admin = attempt_login($username, $password);
  
  if ($found_admin) {
    // Success
    $_SESSION["admin_id"] = $found_admin["id"];
    $_SESSION["username"] = $found_admin["username"];
    redirect_to("article.php");

  } else {
    // Failure
    $_SESSION["message"] = "Sorry, username/password not found";
    // redirect_to("login.php");
  }
  
} else {
  // This is probably a GET request
  // redirect_to("new_admin.php");
}
 ?>
<head>
  <title>Sign in</title>
  <link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<div id="main">
  <div id="navigation">
  </div>
  <div id="page">
    <div class="accountmessage">
    <?php echo message(); ?>
    <?php if(!logged_in() && isset($_POST['submit'])){ 
      $output = "<p>Please try again, or <span><a href=\"index.php\">Click here</a></span> back to homepage</p>";
      echo $output;
      }?>
    
    </div>
    <h2>Sign in</h2>
    
    <form action="login.php" method="post">
      <p>Username:
        <input type="text" name="username" value="<?php echo htmlentities($username); ?>" />
      </p>
      <p>Password:
        <input type="password" name="password" value="" />
      </p>
      <input class="submit" type="submit" name="submit" value="Sign in" />
    </form>
    <br />
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
