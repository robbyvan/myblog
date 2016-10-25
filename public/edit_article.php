<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php find_selected_article(); ?>

<?php 
  if (!$current_article) {
    redirect_to("article.php");
  }
?>
<?php 
if (isset($_POST["submit"])) {

    $id = $current_article["id"];
    $title = mysql_prep($_POST["title"]);
    $intro = mysql_prep($_POST["intro"]);
    $content = mysql_prep($_POST["content"]);

    $query  = "UPDATE articles SET ";
    $query .= "title = '{$title}', ";
    $query .= "intro = '{$intro}', ";
    $query .= "content = '{$content}', ";
    $query .= "createdate = NOW() ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    var_dump($query);
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) >= 0) {
      // Success
      $_SESSION["message"] = "Article updated.";
      redirect_to("article.php");
    } else {
      // Failure
      $message = "Article Edit failed.";
  }
}else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))
?>
<?php include("../includes/layouts/header.php"); ?>

  <section id="robby" role="main">
    <header id="begin">
        <time datetime="2016-09-25" id="top_time"><?php 
        $current_article = find_selected_article();
        if (!$current_article) {
          echo date("D, F d");
        }else{
          $time = strtotime($current_article["createdate"]);
          echo date("D, F d H:i", $time);
        }
         ?></time>
    </header>
    
    <?php // $message is just a variable, doesn't use the SESSION
      if (!empty($message)) {
        echo "<div class=\"message\">" . htmlentities($message) . "</div>";
      }
    ?>

    <p>Edit this Page</p><br />
    <form action="edit_article.php?article=<?php echo urlencode($current_article["id"]); ?>" method="post">
      <p>Title: <br />
        <textarea rows="1" cols="50" type="text" name="title"><?php echo $current_article["title"]; ?></textarea>
      </p>

      <p>Introduction:<br />
        <textarea name="intro" rows="10" cols="50"><?php echo $current_article["intro"]; ?></textarea>
      </p>

      <p>Content: <br />
        <textarea name="content" rows="20" cols="80"><?php echo $current_article["content"]; ?></textarea>
      </p>
      <input type="submit" name="submit" value="Edit!">
    </form>
    <br />
    <a href="article.php">Cancel</a>
    <a href="delete_article.php?article=<?php echo urlencode($current_article["id"]); ?>" onclick="return confirm('Are you sure?')">Delete</a>

  </section>
    <?php include("./../includes/layouts/footer.php") ?>