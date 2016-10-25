<?php include("./../includes/functions.php") ?>
<?php include("./../includes/db_connection.php") ?>
<?php include("./../includes/layouts/header.php") ?>
<a href="write_article">Write</a>
         <a href="edit_article">Edit</a>
         <a href="delete_article">Delete</a>
<?php error_reporting(E_ALL); ?>
  <section id="robby" role="main">
    <header id="begin">
        <time datetime="<?php echo date('Y-m-d'); ?>" id="top_time"><?php 
        if ($current_article)
          $current_article = find_selected_article();
          echo $current_article["createdate"];
         ?></time>
    </header>

    <?php
    if (isset($_GET["article"])) {
      //SHOW PAGE whose id = id
      $current_article = find_selected_article();
      ?>
      <div id="first-article">
        <article id="<?php echo $current_article["id"]; ?>" class="post">
          <h2 class="entry-title">
            <a href="article.php?article="<?php echo urlencode($current_article["id"]); ?>" class="no-link" title="<?php echo $current_article["title"]; ?>">
            <?php echo htmlentities($current_article["title"]); ?>
          </a>
          </h2>

          <div class="entry-content">
            <p><?php echo $current_article["content"]; ?></p>
           </div> 
          </article>
      </div>
      <?php }else{
        article_nav();
        } ?>

    <nav class="pagination"><span class="gohome"><a href="index.php">Home</a></span></nav>
      </section>

    <?php include("./../includes/layouts/footer.php"); ?>