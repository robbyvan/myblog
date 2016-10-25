<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

<?php confirm_logged_in(); ?>

  <section id="robby" role="main">
    <header id="begin">
        <time datetime="2016-09-25" id="top_time"><?php 
        $current_article = find_selected_article();
        if (!$current_article) {
          echo date("D, F d");
        }else{
          $time = strtotime($current_article["createdate"]);
          echo date("D, F d", $time);
        }
         ?></time>
    </header>
    
    <form action="create_article.php" method="post" class="create">
      <p>Title: <br />
        <textarea rows="1" cols="50" type="text" name="title" value=""></textarea>
      </p>

      <p>Introduction:<br />
        <textarea name="intro" rows="10" cols="50"></textarea>
      </p>

      <p>Content: <br />
        <textarea name="content" rows="20" cols="80"></textarea>
      </p>
      <input type="submit" name="submit" value="Done!">
    </form>
    <br />
    <a href="article.php">Cancel</a>

    

  </section>
    <?php include("./../includes/layouts/footer.php") ?>