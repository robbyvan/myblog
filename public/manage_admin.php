<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

<?php error_reporting(E_ALL); ?>
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

    <?php echo message(); ?>

      <div id="first-article">
        <?php echo admin_nav(); ?>
        <a href="new_admin.php">Add new admin</a>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
      </section>

    <?php include("./../includes/layouts/footer.php"); ?>