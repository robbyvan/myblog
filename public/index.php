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
         <span class="compose"><a href="login.php">Sign in</a></span>
    </header>
    <?php
    if (isset($_GET["article"])) {
      //SHOW PAGE whose id = id
      $current_article = find_selected_article();
      ?>
      <div id="first-article">
        <article id="<?php echo $current_article["id"]; ?>" class="post">
          <h2 class="entry-title">
            <a href="index.php?article=<?php echo urlencode($current_article["id"]); ?>" class="no-link" title="<?php echo $current_article["title"]; ?>">
            <?php echo $current_article["title"]; ?>
          </a>
          </h2>

          <div class="entry-intro">
            <p><?php echo nl2br($current_article["intro"]); ?></p>
          </div> 

          <div class="entry-content">
            <p><?php echo nl2br($current_article["content"]); ?></p>
           </div> 
          </article>
      </div>
      <?php }else{
        public_article_nav();
        } ?>
    <nav class="pagination"><span class="gohome"><a href="index.php">Home</a></span></nav>
      </section>

    <?php include("./../includes/layouts/footer.php"); ?>