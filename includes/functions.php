<?php 

  function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
  }
  function mysql_prep($string) {
    global $connection;
    
    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string;
  }
  function confirm_query($result_set){
    if (!$result_set){
        die("Database query failed.");
      }
  }
  //Return articleset by id DSC
  function find_all_articles(){ 
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM articles ";
    $query .= "ORDER BY id DESC";
    $article_set = mysqli_query($connection, $query);
    confirm_query($article_set);
    return $article_set;
  }
  function find_article_by_id($article_id){
    global $connection;

    $safe_article_id = mysqli_real_escape_string($connection, $article_id);

    $query  = "SELECT * ";
    $query .= "FROM articles ";
    $query .= "WHERE id = {$safe_article_id} ";
    $query .= "LIMIT 1";
    $article_set = mysqli_query($connection, $query);
    confirm_query($article_set);
    if ($article = mysqli_fetch_assoc($article_set)) {
      return $article;
    }else{
      return NULL;
    }
  }
  function find_selected_article(){
    global $current_article;

    if (isset($_GET["article"])) {
      $current_article = find_article_by_id($_GET["article"]);
    }else{
      $current_article = NULL;
      // echo "here";
    }
    return $current_article;
  }

  function find_selected_admin() {
    global $current_admin;

    if (isset($_GET["admin"])) {
      $current_admin = find_admin_by_id($_GET["admin"]);
    }else {
      $current_admin = null;
    }
  }

  function find_all_admins(){
    global $connection;
    
    $query  = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "ORDER BY username ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
  }

  function find_admin_by_id($admin_id){
    global $connection;
    
    $safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
    
    $query  = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE id = {$safe_admin_id} ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
      return $admin;
    } else {
      return null;
    }
  }

  function find_admin_by_username($admin_username){
    global $connection;

    $safe_admin_username = mysqli_real_escape_string($connection, $admin_username);
    

    $query  = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE username = '{$safe_admin_username}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);



    if($admin = mysqli_fetch_assoc($admin_set)) {
      return $admin;
    } else {
      return null;
    }
  }

  function article_nav(){
    $all_articles_set = find_all_articles();
    $rows_cnt = mysqli_num_rows($all_articles_set);
    while ($article = mysqli_fetch_assoc($all_articles_set)) {
      $output  = "<div id=\"first-article\">";
      $output .= "<article id=\"";
      $output .= $article["id"];
      $output .= "\" class=\"post\">";
      $output .= "<h2 class=\"entry-title\">";
      $output .= "<a href=\"article.php?article=";
      $output .= urlencode($article["id"]);
      $output .= "\" class=\"no-link\" title=\"";
      $output .= $article["title"];
      $output .= "\">";
      $output .= $article["title"];// need htmlentities()
      $output .= "</a></h2>";

      $output .= "<p class=\"createtime\">";
      $output .= "Last modified on: ";
      $time = strtotime($article["createdate"]);
      $output .= date("D, F d H:i", $time);
      $output .= "</p>";

      $output .= "<div class=\"entry-content\">";
      $output .= "<p>";
      $output .= nl2br($article["intro"]);
      $output .= "</p>";
      $output .= "<p><a href=\"article.php?article=";
      $output .= urlencode($article["id"]);
      $output .= "\" class=\"more-link\"";
      $output .= "<p>";
      $output .= "Continue reading";
      $output .= "<span class=\"meta-nav\">&rarr;";
      $output .= "</span></p></a></p>";
      $output .= "</div></article></div>";

      echo $output;
    }
  }
  function public_article_nav(){
    $all_articles_set = find_all_articles();
    $rows_cnt = mysqli_num_rows($all_articles_set);
    while ($article = mysqli_fetch_assoc($all_articles_set)) {
      $output  = "<div id=\"first-article\">";
      $output .= "<article id=\"";
      $output .= $article["id"];
      $output .= "\" class=\"post\">";
      $output .= "<h2 class=\"entry-title\">";
      $output .= "<a href=\"index.php?article=";
      $output .= urlencode($article["id"]);
      $output .= "\" class=\"no-link\" title=\"";
      $output .= $article["title"];
      $output .= "\">";
      $output .= $article["title"];// need htmlentities()
      $output .= "</a></h2>";

      $output .= "<p class=\"createtime\">";
      $output .= "Last modified on: ";
      $time = strtotime($article["createdate"]);
      $output .= date("D, F d H:i", $time);
      $output .= "</p>";

      $output .= "<div class=\"entry-content\">";
      $output .= "<p>";
      $output .= nl2br($article["intro"]);
      $output .= "</p>";
      $output .= "<p><a href=\"index.php?article=";
      $output .= urlencode($article["id"]);
      $output .= "\" class=\"more-link\"";
      $output .= "<p>";
      $output .= "Continue reading";
      $output .= "<span class=\"meta-nav\">&rarr;";
      $output .= "</span></p></a></p>";
      $output .= "</div></article></div>";

      echo $output;
    }
  }
  function admin_nav(){
    $output = "<ul class=\"admins\">";
    $admin_set = find_all_admins();
    while($admin = mysqli_fetch_assoc($admin_set)) {

      $output .= "<li>";
      
      $output .= "username: ";
      $output .= htmlentities($admin["username"]);
      $output .= "<br />";
      $output .= "password: ";
      $output .= htmlentities($admin["hashed_password"]);

      $output .= "<br />";
      $output .= "<a href = \"edit_admin.php?admin=";
      $output .= urlencode($admin["id"]);
      $output .= "\">";
      $output .= "Edit";
      $output .= "</a>";
      $output .= "<hr />";

      $output .= "</li>";
    }
    mysqli_free_result($admin_set);
    $output .= "</ul>";
    return $output;
  }
  function password_encrypt($password){
    $hash_format = "$2y$10$";
    $salt_length = 22;
    $salt = generate_salt($salt_length);
    $format_and_salt = $hash_format . $salt;

    $hash = crypt($password, $format_and_salt);
    return $hash;
  }
  function generate_salt($length){
    $unique_random_string = md5(uniqid(mt_rand(), true));

    $base64_string = base64_encode($unique_random_string);

    $modified_base64_string = str_replace('+', '.', $base64_string);

    $salt = substr($modified_base64_string, 0, $length);

    return $salt;
  }

  function password_check ($password, $existing_hash) {
    $hash = crypt($password, $existing_hash);
    if ($hash === $existing_hash) {
      return true;
    }else{
      return false;
    }
  }

  function attempt_login($username, $password){
    $admin = find_admin_by_username($username);
    if ($admin) {
      if (password_check($password, $admin["hashed_password"])) {
        return $admin;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

  function logged_in(){
    return isset($_SESSION['admin_id']);
  }
  function confirm_logged_in(){
    if (!logged_in()) {
      redirect_to("index.php");
    }
  }

 ?>