<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <title>JAMONG</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/static/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>static/css/common.css" rel="stylesheet">
    <link href="/static/lib/animation/animate.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>

    <?php
    $total_url = $_SERVER['PHP_SELF'];
    $arr_splitted_url = explode('/', $total_url);

    if ($arr_splitted_url[count($arr_splitted_url) - 1] === "") {
        unset($arr_splitted_url[count($arr_splitted_url) - 1]);
    }

    $ctrl_name = $arr_splitted_url[count($arr_splitted_url) - 2];
    $view_name = $arr_splitted_url[count($arr_splitted_url) - 1];
    $filename = "";

    if ($ctrl_name == 'index.php') {
        $filename = 'static/css/' . strtolower($view_name) . '/index.css';
    } else {
        $filename = 'static/css/' . strtolower($ctrl_name) . '/' . strtolower($view_name) . '.css';
    }

    if (file_exists($filename)) {
        ?>
        <link href="/JAMONG/<?php echo $filename; ?>" rel="stylesheet">
        <?php
    }
    if (strpos($filename, 'index.php')) {
        ?>
        <link href="/JAMONG/static/css/home/index.css" rel="stylesheet">
        <?php
    }?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="body-container">
    <?php
    $flashdata = $this->session->flashdata('message');
    if ($flashdata != null) {
        ?>

        <script type="text/javascript">
            alert('<?=$this->session->flashdata('message')?>');
        </script>
        <?php
    }
    ?>
    <header class="main-header">
        <div class="container">
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="<?= site_url('/home/index') ?>" class="logo">
                    <img src="/JAMONG/static/img/header_logo.png" alt="">
                </a>

                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <div class="nav navbar-nav">
                        <div class="inline-block">
                            <form class="nav-search" action="<?=site_url('search/result')?>" method="get">
                                <input id="jm-search" name="search_query" type="text" placeholder="검색어를 입력해주세요.">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </form>
                        </div>
                        <div class="inline-block">
                            <img class="user" src="https://yt3.ggpht.com/-AqUnCKz6LSA/AAAAAAAAAAI/AAAAAAAAAAA/KkG5qB5y0ac/s88-c-k-no-rj-c0xffffff/photo.jpg" alt="">
                        </div>
                    </div>
                </div>
            </nav>
        </div>

    </header>
