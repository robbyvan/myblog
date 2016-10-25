<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php 
    $current_article = find_article_by_id($_GET["article"]);
    if (!$current_article) {
      redirect_to("article.php");
    }

    $id = $current_article["id"];
    $title = mysql_prep($_POST["title"]);
    $intro = mysql_prep($_POST["intro"]);
    $content = mysql_prep($_POST["content"]);

    $query  = "DELETE FROM articles ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) >= 0) {
      // Success
      $_SESSION["message"] = "Article Deleted.";
      redirect_to("article.php");
    } else {
      // Failure
      $_SESSION["message"] = "Article deletion failed.";
      redirect_to("article.php?article={$id}");
  }

?>
<?php include("../includes/layouts/header.php"); ?>