<?php
// Start the session
session_start();
// استدعاء ملف التوصيل بقاعدة البيانات
require 'config.php';


// التحقق من أن المستخدم قام بتسجيل الدخول
if(!isset($_SESSION['id_technical'])){ // اسم الجدول الى فى قاعده البيانات
    header("Location: login.php");  //   الصفحه دى فاضيه تماما علشان هو بيقول فى صفحه خاصه
    exit;
}

// الحصول على معرف المستخدم من الجلسة
$user_id = $_SESSION['id_technical'];   //اسم الجدول الى فى قاعده البيانات

// استعلام لجلب بيانات المستخدم من جدول المستخدمين
$sql = "SELECT * FROM technical_form WHERE id = '$id_technical'";
$result = mysqli_query($connection, $sql);

// التحقق من وجود نتائج للاستعلام
if(mysqli_num_rows($result) > 0){
    // عرض بيانات المستخدم في صفحة خاصة
    $row = mysqli_fetch_assoc($result);
    echo "Welcome " . $row['name'] . "!<br>";
    echo "Your email address is: " . $row['email']."!<br>";
    echo "Your phone address is: " . $row['phone']."!<br>";
    echo "Your user_type is: " . $row['user_type']."!<br>";
    echo "Your image is: " . $row['image']; /// الحاجات الى عايز اعرضها
} else {
    echo "User not found.";
}

// إغلاق الاتصال بقاعدة البيانات
mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>the page technical</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons
    ================================================== -->
<link rel="shortcut icon" href="img/fav.png" type="image/png">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css"  href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/nivo-lightbox/nivo-lightbox.css">
<link rel="stylesheet" type="text/css" href="css/nivo-lightbox/default.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/modernizr.custom.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation
    ==========================================-->
<nav id="menu" class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand page-scroll" href="#page-top"><i class="fa fa-play fa-code"></i> الفنى المتنوع</a> </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#page-top" class="page-scroll">Home</a></li>
        <li><a href="#about" class="page-scroll">About</a></li>
        <li><a href="#portfolio" class="page-scroll">Portfolio</a></li>
        <li><a href="#contact" class="page-scroll">Contact</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<!-- Header -->
<header id="header">
  <div class="intro">
    <div class="container">
      <div class="row">
        <div class="intro-text">
          <h1>الفنى المتنوع</h1>
          <p> page technical</p>
      </div>
    <div>
  </div>
</header>
</body>
</html>
