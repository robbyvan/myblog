<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

<?php 
  if (isset($_POST["submit"])) {
    //process the form

    $title = $_POST["title"];
    $intro = $_POST["intro"];
    $content = $_POST["content"];

    // print_r($_POST);

    //validations USE JS

    $query  = "INSERT INTO articles (";
    $query .= " title, intro, content, createdate";
    $query .= ") VALUES (";
    $query .= " '{$title}', '{$intro}', '{$content}', NOW() ";
    $query .= ")";
    var_dump($query);
    $result = mysqli_query($connection, $query);

    // var_dump($result);

    if ($result) {
      $_SESSION["message"] = "You just created a new article! :P";
      redirect_to("article.php");
    }else{
      var_dump("u r here2");
      $_SESSION["message"] = "Cant create the article";
      // redirect_to("new_article.php");
    }

  }else{
    //this is probably a GET request
    var_dump("u r here3");
    // redirect_to("new_article.php");
  }


 ?>

<?php
  if (isset($connection)) { mysqli_close($connection); }
?>