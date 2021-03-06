<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <?php
include "panou/config.php";
$link = mysql_connect($server, $db_user, $db_pass) or die (mysql_error());
mysql_select_db($database) or die("Eroare conectare baza de date.");
$_REQUEST['p']="Stocklist";
if (!isset($_REQUEST['cat'])) {
	
}
else {
$_REQUEST['cat'] = strip_tags ($_REQUEST['cat']);
$_REQUEST['cat'] = htmlspecialchars($_REQUEST['cat'], ENT_QUOTES);
}
if (!isset($_REQUEST['l'])) {
	$_REQUEST['l'] = "en";
}
else {
$_REQUEST['l'] = strip_tags ($_REQUEST['l']);
$_REQUEST['l'] = htmlspecialchars($_REQUEST['l'], ENT_QUOTES);
}

$cat = $_REQUEST['cat'];
$lang = $_REQUEST['l'];
$page = $_REQUEST['page'];
$page_offset = 10 * ($page - 1);

if ($cat<>"all")
$result = mysql_query("select * from $tab_pagini where pagina_id='".$_REQUEST['cat']."'");
else
$result = mysql_query("select * from $tab_pagini where nume_en='Stocklist'");
$row=mysql_fetch_array($result);
echo "<title>".$row['pagina_title']."</title>\n";
echo "<meta name=\"keywords\" content=\"".$row['pagina_keywords']."\" />\n";
echo "<meta name=\"subject\" content=\"".$row['pagina_subject']."\" />\n";
echo "<meta name=\"description\" content=\"".$row['pagina_description']."\" />\n";
echo "<meta name=\"abstract\" content=\"".$row['pagina_abstract']."\" />\n";
echo "<meta name=\"copyright\" content=\"".$row['pagina_copyright']."\" />\n";
?>
  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

  <!-- Site Icons -->
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
  <link rel="apple-touch-icon" href="img/favicon.png">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cinzel:400,700,900&display=swap" rel="stylesheet">

  <!-- Css Styles -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/barfiller.css" type="text/css">
  <link rel="stylesheet" href="assets/css/magnific-popup.css" type="text/css">
  <link rel="stylesheet" href="assets/css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">

  <!-- Modernizer for Portfolio -->
  <script src="js/modernizer.js"></script>

</head>
<?php include "language.php" ?>
<?php include "header.php" ?>
<body class="is-preload">
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg spad" data-setbg="assets/img/top-image-old.jpg">
  <div style="width:100%;height:100%;background-color: rgba(0, 0, 0, 0.5);padding:100px 0;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-text">
            <h3 class="text-center"><?php echo $_REQUEST['p'];?></h3>
            <div class="bt-option">
              <a href="index.php">Home</a>
              <a href="#"><?php echo $_REQUEST['p'];?></a>
              <a href="products.php?cat=all&l=<?php echo $_REQUEST['l'] ?>&page=1">
                <?php $queryz = mysql_query( " SELECT * FROM $tab_produse ");
              ?>
                Stocklist (<?php echo mysql_num_rows($queryz) ?>) >
              </a>
              <?php if ($_REQUEST['cat']<>'all') { ?>
                <a href="#">
                  <?php $queryz = mysql_query( " SELECT * FROM $tab_produse where parinte='".$_REQUEST['cat']."'");
                ?>
                  <?php
                $queryz1 = mysql_query ( " SELECT * FROM $tab_pagini where pagina_id='".$_REQUEST['cat']."' ");
                $rowz1 = mysql_fetch_array($queryz1);
                $nume = "nume_".$_REQUEST['l'];
                echo $rowz1[$nume];
              ?>
                (<?php echo mysql_num_rows($queryz) ?>) >
              </a>
              <?php } ?>
                <a href="products.php?cat=all&l=<?php echo $_REQUEST['l'] ?>&page=1" style="float:right;">View all
                  MACHINES</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Categories Grid Section Begin -->
<section class="categories-grid-section spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 p-0">
        <div class="row">
          <?php
            if ($_REQUEST['cat']<>'all') { 
              $queryp = mysql_query ( " SELECT * FROM $tab_produse where parinte = '".$_REQUEST['cat']."' LIMIT ".$page_offset.", 10");
              while ( $rowp = mysql_fetch_array($queryp) ) { 
                $query2 = mysql_query ( " SELECT * FROM $tab_fisiere where tip = '".$rowp['id']."' ");
                $row2 = mysql_fetch_array($query2);
                $while_cat = $_REQUEST['cat'];
                $while_id = $rowp['id'];
                $while_l = $_REQUEST['l'];
          ?>
            <div class='col-lg-6'>
              <div class='cg-item'>
                <div class='cg-pic set-bg' data-setbg="upload/<?php echo $row2['numefisier'] ?>">
                    <div class='label'><span><?php echo $rowp['model'] ?></span></div>
                </div>
                <div class='cg-text'>
                    <h5><a href='product.php?cat=<?php echo $cat; ?>&id=<?php echo $while_id ?>&l=<?php echo $while_l; ?>'><?php echo $rowp['nume_en']; ?></a></h5>
                    <ul>
                      <li>by <span><?php echo $rowp['make'] ?></span></li>
                      <li><i class='fa fa-money'></i><?php echo $rowp['price'] ?> &pound;</li>
                      <li><i class='fa fa-calendar-o'></i><?php echo $rowp['year'] ?></li>
                    </ul>
                </div>
              </div>
            </div>
          <?php } 
          } else {
            $queryp = mysql_query ( " SELECT * FROM $tab_produse ORDER BY id LIMIT ".$page_offset.", 10");
            while ( $rowp = mysql_fetch_array($queryp) ) {
              $query2 = mysql_query ( " SELECT * FROM $tab_fisiere where tip = '".$rowp['id']."' ");
              $row2 = mysql_fetch_array($query2);
              $while_cat = $_REQUEST['cat'];
              $while_id = $rowp['id'];
              $while_l = $_REQUEST['l'];
          ?>
            <div class='col-lg-6'>
              <div class='cg-item'>
                <div class='cg-pic set-bg' data-setbg="upload/<?php echo $row2['numefisier'] ?>">
                    <div class='label'><span><?php echo $rowp['model'] ?></span></div>
                </div>
                <div class='cg-text'>
                    <h5><a href='product.php?cat=<?php echo $cat; ?>&id=<?php echo $while_id ?>&l=<?php echo $while_l; ?>'><?php echo $rowp['nume_en']; ?></a></h5>
                    <ul>
                      <li>by <span><?php echo $rowp['make'] ?></span></li>
                      <li><i class='fa fa-money'></i><?php echo $rowp['price'] ?> &pound;</li>
                      <li><i class='fa fa-calendar-o'></i><?php echo $rowp['year'] ?></li>
                    </ul>
                </div>
              </div>
            </div>
          <?php }
          }	
          ?>
        </div>
        <div class="pagination-item" style="float:right;">
          <?php
            if($page == 1) {
              echo "<a href='#'>Previous</a>";
            } else {
              $j = $page - 1;
              echo '<a href="products.php?cat='.$_REQUEST['cat'].'&l='.$_REQUEST['l'].'&page='.$j.'">Previous</a>';
            }
            if($_REQUEST['cat'] <> 'all') {
              $page_query = mysql_query("SELECT COUNT(id) AS count FROM ".$tab_produse." WHERE parinte='".$_REQUEST['cat']."'");
            } else {
              $page_query = mysql_query("SELECT COUNT(id) AS count FROM ".$tab_produse);
            }
            $total_num = mysql_fetch_array($page_query);
            $total_page = floor($total_num['count'] / 10) + 1;
            for($i = 1; $i <= $total_page; $i++){
              echo '<a href="products.php?cat='.$_REQUEST['cat'].'&l='.$_REQUEST['l'].'&page='.$i.'">'.$i.'</a>';
            }
            if($total_page == $page) {
              echo "<a href='#'>Next</a>";
            } else {
              $j = $page + 1;
              echo '<a href="products.php?cat='.$_REQUEST['cat'].'&l='.$_REQUEST['l'].'&page='.$j.'">Next</a>';
            }
          ?>
        </div>
      </div>
      <div class="col-lg-4 col-md-7 p-0">
        <div class="sidebar-option">
          <div class="social-media">
            <div class="section-title">
              <h5>Social media</h5>
            </div>
            <ul>
              <li>
                <div class="sm-icon"><i class="fa fa-facebook"></i></div>
                <span>Facebook</span>
                <div class="follow">1,2k Follow</div>
              </li>
              <li>
                <div class="sm-icon"><i class="fa fa-twitter"></i></div>
                <span>Twitter</span>
                <div class="follow">1,2k Follow</div>
              </li>
              <li>
                <div class="sm-icon"><i class="fa fa-youtube-play"></i></div>
                <span>Youtube</span>
                <div class="follow">2,3k Subs</div>
              </li>
              <li>
                <div class="sm-icon"><i class="fa fa-instagram"></i></div>
                <span>Instagram</span>
                <div class="follow">2,6k Follow</div>
              </li>
            </ul>
          </div>
          <div class="best-of-post">
            <div class="section-title">
              <h5>Best of</h5>
            </div>
            <?php 
            $rating = 100;
            $queryp = mysql_query ( " SELECT * FROM $tab_produse ORDER BY id LIMIT 0, 5");
            while ( $rowp = mysql_fetch_array($queryp) ) {
              $query2 = mysql_query ( " SELECT * FROM $tab_fisiere where tip = '".$rowp['id']."' ");
              $row2 = mysql_fetch_array($query2);
              $while_cat = $_REQUEST['cat'];
              $while_id = $rowp['id'];
              $while_l = $_REQUEST['l'];
              $rating = $rating - 3;
              $show_rating = rand($rating, $rating + 3);
              $pshow_rating = $show_rating / 10;
            ?>
              <div class="bp-item">
                <div class="bp-loader">
                  <div class="loader-circle-wrap">
                    <div class="loader-circle">
                      <span class="circle-progress-1" data-cpid="id-1" data-cpvalue="<?php echo $show_rating;?>" data-cpcolor="#c20000"></span>
                      <div class="review-point"><?php echo $pshow_rating;?></div>
                    </div>
                  </div>
                </div>
                <div class="bp-text">
                  <h6><a href="product.php?cat=<?php echo $cat; ?>&id=<?php echo $while_id ?>&l=<?php echo $while_l; ?>"><?php echo $rowp['nume_en']; ?></a></h6>
                  <ul>
                    <li>by <span><?php echo $rowp['make'] ?></span></li>
                    <li><i class='fa fa-money'></i><?php echo $rowp['price'] ?> &pound;</li>
                    <li><i class='fa fa-calendar-o'></i><?php echo $rowp['year'] ?></li>
                  </ul>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Categories Grid Section End -->

  <?php include "page-footer.php";?>

  <!-- Sign Up Section Begin -->
  <div class="signup-section">
    <div class="signup-close"><i class="fa fa-close"></i></div>
    <div class="signup-text">
      <div class="container">
        <div class="signup-title">
          <h2>Sign up</h2>
          <p>Fill out the form below to recieve a free and confidential</p>
        </div>
        <form action="#" class="signup-form">
          <div class="sf-input-list">
            <input type="text" class="input-value" placeholder="User Name*">
            <input type="text" class="input-value" placeholder="Password">
            <input type="text" class="input-value" placeholder="Confirm Password">
            <input type="text" class="input-value" placeholder="Email Address">
            <input type="text" class="input-value" placeholder="Full Name">
          </div>
          <div class="radio-check">
            <label for="rc-agree">I agree with the term & conditions
              <input type="checkbox" id="rc-agree">
              <span class="checkbox"></span>
            </label>
          </div>
          <button type="submit"><span>REGISTER NOW</span></button>
        </form>
      </div>
    </div>
  </div>
  <!-- Sign Up Section End -->

  <!-- Search model Begin -->
  <div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
      <div class="search-close-switch">+</div>
      <form id="search" method="post" action="index.php?p=search&l=<?php echo $_REQUEST['l'] ?>"
        enctype="multipart/form-data" class="search-model-form">
        <input type="text" id="search-input" name="search" placeholder="<?php echo $word['search_'.$lang];?>...">
      </form>
    </div>
  </div>
  <!-- Search model end -->


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <?php include "footer.php"; ?>