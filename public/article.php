<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

<?php confirm_logged_in(); ?>

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
         ?>
         <br />
         <span style="color: pink; font-family: helvetica; font-weight: normal;">Hi, Robby.</span>
         </time>
         <span class="compose"><a href="logout.php">Sign out</a></span>

         <span class="compose"><a href="new_article.php">Compose</a></span>
    </header>

    <?php echo message(); ?>

    <?php
    if (isset($_GET["article"])) {
      //SHOW PAGE whose id = id
      $current_article = find_selected_article();
      ?>
      <div id="first-article">
        <article id="<?php echo $current_article["id"]; ?>" class="post">
          <h2 class="entry-title">
            <a href="article.php?article=<?php echo urlencode($current_article["id"]); ?>" class="no-link" title="<?php echo $current_article["title"]; ?>">
            <?php echo $current_article["title"]; ?>
          </a>
          </h2>
        <ul class="manage">
          <li><a href="edit_article.php?article=<?php echo urlencode($current_article["id"]); ?>">Edit</a></li>
        </ul>

          <div class="entry-intro">
            <p><?php echo nl2br($current_article["intro"]); ?></p>
          </div> 

          <div class="entry-content">
            <p><?php echo nl2br($current_article["content"]); ?></p>
           </div> 
          </article>
      </div>
      <?php }else{
        article_nav();
        } ?>
    <nav class="pagination"><span class="gohome"><a href="article.php">Home</a></span></nav>
      </section>

    <?php include("./../includes/layouts/footer.php"); ?>