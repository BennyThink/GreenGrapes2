<!doctype html>
<!--Nothing will ever compare.-->
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php if (!empty($this->options->MemorialDay)&&
        strpos($this->options->MemorialDay, date('m-d', time()))): ?>
    <meta name="theme-color" content="#808080">
    <style type="text/css">
        <!--
        html {
            filter: progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);
            -webkit-filter: grayscale(100%);
        }
        -->
    </style>
<?php else: ?>
    <meta name="theme-color" content="#299981">
<?php endif; ?>
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <link href="<?php $this->options->themeUrl('favicon.ico'); ?>" rel="shortcut icon"  type="image/x-icon">
    <?php if ($this->is('post')): ?><link rel="canonical" href="<?php $this->permalink() ?>" />
    <?php endif; ?>
    <!-- css -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/main.css'); ?>">
	<link rel="stylesheet" href="<?php $this->options->themeUrl('css/loading.css'); ?>">
    <script src = "<?php $this->options->themeUrl('js/jquery.min.js'); ?>"></script>
    <!-- custom theme color suggested by kito-->
    <?php
    if ( $this->options->themeColor == 'red' ) {
	    $color1 = '#e26153';$color2='#E74C3C';$color3='#d16d62';$quote='#FF4500';$hover='#FFB6C1';
	    $this->options->color1=$color1;
    } elseif ( $this->options->themeColor == 'blue' ) {
	    $color1 = '#0f3e9b';$color2='#003399';$color3='#214999';$quote='#00BFFF';$hover='#0b445b';
	    $this->options->color1=$color1;
    } elseif ( $this->options->themeColor == 'dark' ) {
	    $color1 = '#4f4b4b';$color2='#616161';$color3='#474040';$quote='#778899';$hover='#0b445b';
	    $this->options->color1=$color1;
    } elseif ( $this->options->themeColor == 'purple' ) {
	    $color1 = '#a248ce';$color2='#9932CC';$color3='#a15ac4';$quote='#9370DB';$hover='#0b445b';
	    $this->options->color1=$color1;
    } elseif ( $this->options->themeColor == 'yellow' ) {
	    $color1 = '#efdd28';$color2='#f5e011';$color3='#e2d43f';$quote='#eff446';$hover='#0b445b';
	    $this->options->color1=$color1;
    } elseif ( $this->options->themeColor == 'light' ) {
	    $color1 = '#1aabed';$color2='#03A9F4';$color3='#32ade5';$quote='#87CEEB';$hover='#0b445b';
	    $this->options->color1=$color1;
    } elseif ( $this->options->themeColor == 'green' ) {
	    $color1='#16a085';$color2='#009a61';$color3='#299982';$quote='#7AD03A';$hover='#0b445b';
	    $this->options->color1=$color1;
    } elseif ( $this->options->themeColor == 'custom' ) {
	    $color1 = $this->options->color1;$color2=$this->options->color2;$color3=$this->options->color3;
	    $quote=$this->options->quote;
    }

    ?>
    <?php if ($this->options->themeColor != 'green'):?>
    <style type="text/css">
        sup {
            color: <?php echo $color3?>;
        }

        blockquote {
            border-left: 4px solid <?php echo $quote?>;
        }

        .btn-success {
            background-color: <?php echo $quote?>;
            border-color: <?php echo $quote?>;
        }

        .category-cloud a {
            background-color: <?php echo $color1?>;
        }

        .widget-sets .panel-heading {
            border-bottom: 2px solid <?php echo $color1?>;
        }
        .widget-sets .nav-pills {
            border-bottom: 2px solid <?php echo $color1?>;
        }

        .panel.panel-green .panel-heading {
            background-color: <?php echo $color1?>;
        }

        .category a:hover {
            background-color: <?php echo $hover?>;
        }

        .btn-green {
            border: 1px solid <?php echo $color1?> !important;
            color: <?php echo $color1?>;
        }

        .btn.btn-green:hover {
            background-color: <?php echo $color1?>;
        }

        .nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
            background-color: <?php echo $color1?>;
        }

        .label-green {
            background-color: <?php echo $color1?>;
        }

        .article-copyright a, .article-content a {
            color: <?php echo $color2?>;
        }

        .article-copyright a:hover, .article-content a:hover {
            color: <?php echo $color2?>;
        }

        .hdbg2 {
            background: <?php echo $color3?>;
        }

        .m-nav .nav li li a:hover, .m-nav .nav li li.current-menu-item a {
            background-color: <?php echo $color3?>
        }

        .post-article .title a:hover {
            color: <?php echo $color1?>;
        }

        .post-article .previous-image a {
            background: <?php echo $color3?>;
        }

        .post-like a, .cbl-logo-like a {
            background: <?php echo $color3?>;
        }

        aside section h2 {
            background: <?php echo $color3?>;
        }

        #back-to-top:hover {
            border: <?php echo $color3?> 1px solid;
        }

        #back-to-top.red:hover #point-up path {
            fill: <?php echo $color3?>;
        }

        .m-header {
            background: <?php echo $color1?>;
        }

    </style>
    <?php endif;?>
<?php if (!empty($this->options->switch) && in_array('EnableNotice', $this->options->switch)): ?>
	<script src="<?php $this->options->themeUrl('js/notice.js'); ?>"></script>
<?php endif; ?>
<?php if ( 'CDNEmmotions' == $this->options->Emotions || 'LocalEmotions' == $this->options->Emotions ): ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl( 'css/OwO.min.css' ); ?>">
    <script src="<?php $this->options->themeUrl( 'js/OwO.min.js' ); ?>"></script>
<?php endif; ?>
<?php if('ShowAll'==$this->options->Snow or 'ShowPC'==$this->options->Snow):?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/Snow.css'); ?>">
<?php endif;?>
 <?php
    if('Close'!=$this->options->SHTheme){
    $settings = $this->options->SHTheme;
    $currentPath = $this->options->themeUrl.'/extra/SyntaxHighlighter/';
    echo '<script type="text/javascript" src="' . $currentPath . 'scripts/shCore.min.js"></script>' . "\n";
    echo '<script type="text/javascript" src="' . $currentPath . 'scripts/shAutoloader.js"></script>' . "\n";
    echo '<link rel="stylesheet" type="text/css" href="' . $currentPath . 'styles/shCore' . $settings . '.css" />' . "\n";
    }
?>
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
	<?php if($this->is('post')||$this->is('page')): ?>
        <meta property="og:type" content="blog"/>
        <meta property="og:image" content="<?php  echo thumb($this->cid)?>"/>
        <meta property="og:release_date" content="<?php $this->date('Y-m-j'); ?>"/>
        <meta property="og:title" content="<?php $this->options->title(); ?>"/>
        <meta property="og:description" content="<?php $this->description() ?>" />
        <meta property="og:author" content="<?php $this->author(); ?>"/>
	<?php endif; ?>
    <!--cursor-->
    <?php if('cursor1'==$this->options->cursor && !isMobile()):?>
<style type="text/css">
    html {  cursor: url(<?php $this->options->themeUrl('extra/cursor/default1.cur'); ?>), default;  }
    a {  cursor: url(<?php $this->options->themeUrl('extra/cursor/pointer1.cur'); ?>), pointer;  }
    .btn,.icon-share {  cursor: url(<?php $this->options->themeUrl('extra/cursor/pointer1.cur'); ?>), pointer;  }
</style>
    <?php elseif ('cursor2'==$this->options->cursor && !isMobile()):?>
 <style type="text/css">
     html {  cursor: url(<?php $this->options->themeUrl('extra/cursor/default2.cur'); ?>), default;  }
     a {  cursor: url(<?php $this->options->themeUrl('extra/cursor/pointer2.cur'); ?>), pointer;  }
     .btn,.icon-share {  cursor: url(<?php $this->options->themeUrl('extra/cursor/pointer2.cur'); ?>), pointer;  }
</style>
    <?php endif;?>
	<!--统计代码-->
	<?php if (!$this->user->hasLogin()): ?>
    <?php $this->options->tongJi();
    echo "\n"; ?>
	<?php endif ?>
</head>
<body>
<div id="loading">
<div id="loading-one"></div>
<div class="spinner">
  <div class="dot1"></div>
  <div class="dot2"></div>
</div>
</div>
<header id="l-header" class="l-header" style="background-image:url(<?php $this->options->bgImg(); ?>">
    <div class="hdbg"></div>
    <div class="hdbg2"></div>
    <div class="m-about">
        <div id="logo">
            <a href="<?php $this->options->siteUrl(); ?>"><img src="<?php $this->options->headerIcon(); ?>" alt=""></a>
        </div>
        <h1 class="tit"><a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a></h1>
        <div class="about"><?php $this->options->description(); ?></div>
    </div>
    <div id="header-canvas" style="width: 100%;height: 100%"></div>
</header>
<div id="m-nav" class="m-nav">
    <div class="m-nav-all">
        <div class="m-logo-url">
            <img src="<?php $this->options->headerIcon(); ?>">
            <h3><?php $this->options->sideName(); ?></h3>
        </div>
        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
        <ul class="nav">
            <li <?php if($this->is('index')): ?> class="active"<?php endif; ?>>
                <a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
            </li>
            <?php while($pages->next()): ?>
                <li <?php if($this->is('page', $pages->slug)): ?> class="active"<?php endif; ?>>
                    <a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
<?php if($this->options->SNSPos!='showFooter' && isMobile()):?>
    <div class="text-center"><br>
        <?php if (!empty($this->options->TwitterURL)) : ?><span class="fa-stack fa-lg">
            <a class="fa fa-twitter fa-stack-1x" href="<?php $this->options->TwitterURL() ?>" target="view_window"></a>
            </span><?php endif;?>
        <?php if (!empty($this->options->FacebookURL)) : ?><span class="fa-stack fa-lg">
            <a class="fa fa-facebook fa-stack-1x" href="<?php $this->options->FacebookURL() ?>" target="view_window"></a>
            </span><?php endif;?>
        <?php if (!empty($this->options->GooglePlusURL)) : ?><span class="fa-stack fa-lg">
            <a class="fa fa-google-plus fa-stack-1x" href="<?php $this->options->GooglePlusURL() ?>" target="view_window"></a>
            </span><?php endif;?>
        <?php if (!empty($this->options->WeiboURL)) : ?><span class="fa-stack fa-lg">
            <a class="fa fa-weibo fa-stack-1x" href="<?php $this->options->WeiboURL() ?>" target="view_window"></a>
            </span><?php endif;?>
        <?php if (!empty($this->options->InstagramURL)) : ?><span class="fa-stack fa-lg">
            <a class="fa fa-instagram fa-stack-1x" href="<?php $this->options->InstagramURL() ?>" target="view_window"></a>
            </span><?php endif;?>
        <?php if (!empty($this->options->GithubURL)) : ?><span class="fa-stack fa-lg">
            <a class="fa fa-github fa-stack-1x" href="<?php $this->options->GithubURL() ?>" target="view_window"></a>
            </span><?php endif;?>
        <?php if (!empty($this->options->TelegramURL)) : ?><span class="fa-stack fa-lg">
            <a class="fa fa-telegram fa-stack-1x" href="<?php echo 'https://t.me/'.$this->options->TelegramURL ?>" target="view_window"></a>
            </span><?php endif;?>
        <?php if (!empty($this->options->QQURL)) : ?><span class="fa-stack fa-lg">
            <a class="fa fa-qq fa-stack-1x" href="http://wpa.qq.com/msgrd?v=3&uin=<?php $this->options->QQURL() ?>&site=qq&menu=yes" target="view_window"></a>
            </span><?php endif;?>
        <?php if (!empty($this->options->weixinURL)) : ?><span class="fa-stack fa-lg">
            <a class="fa fa-weixin fa-stack-1x" href="https://open.weixin.qq.com/qr/code/?username=<?php $this->options->weixinURL() ?>" target="view_window"></a>
            </span><?php endif;?>
    </div>
<?php endif;?>
</div>
<form role="search" method="get" id="search-form" action="./">
    <div class="search-form">
        <span id="search-form-close">×</span>
		<?php if("搜点什么呗"==$this->options->searchWord):?>
        <input placeholder="搜点什么呗" name="s" id="search-input-s" type="text">
		<?php else:?>
		<input placeholder="<?php $this->options->searchWord();?>" name="s" id="search-input-s" type="text">
		<?php endif;?>
        <input class="webFont" id="searchsubmit" value="L" type="submit">
    </div>
</form>
<div id="m-header" class="m-header">
    <div id="showLeftPush" class="left m-header-button"></div>
    <h1><a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a></h1>
    <div id="search-trigger" style="font-size: 18px;" class="right m-header-search"></div>
</div>