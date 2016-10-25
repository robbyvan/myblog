<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>


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

    <?php echo message(); ?>

    <h2>Create Admin</h2>
    <form action="create_admin.php" method="post">
      <p>User name:
        <input type="text" name="username" value="" />
      </p>
      <p>Password:
        <input type="text" name="password" value="" />
      </p>
      <input type="submit" name="submit" value="Create Admin" />
    </form>
    <br />
    <a href="manage_admin.php">Cancel</a>

    

  </section>
    <?php include("./../includes/layouts/footer.php") ?>