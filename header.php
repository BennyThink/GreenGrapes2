<!--Nothing will ever compare.-->
<!doctype html>
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
<?php if (!empty($this->options->switch) && in_array('EnableNotice', $this->options->switch)): ?>
	<script src="<?php $this->options->themeUrl('js/notice.js'); ?>"></script>
<?php endif; ?>	
<?php if (!empty($this->options->switch) && in_array('ShowEmotions', $this->options->switch)): ?>
	<link rel="stylesheet" href="<?php $this->options->themeUrl('css/OwO.min.css'); ?>" >
	<script src="<?php $this->options->themeUrl('js/OwO.min.js'); ?>"></script>
<?php endif;?>
<?php if('ShowAll'==$this->options->Snow or 'ShowPC'==$this->options->Snow):?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/Snow.css'); ?>">
<?php endif;?>
 <?php
    if('Close'!=$this->options->SHTheme){
    $settings = $this->options->SHTheme;
    $currentPath = $this->options->themeUrl.'/SyntaxHighlighter/';
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
    html {  cursor: url(<?php $this->options->themeUrl('cursor/default1.cur'); ?>), default;  }
    a {  cursor: url(<?php $this->options->themeUrl('cursor/pointer1.cur'); ?>), pointer;  }
    .btn,.icon-share {  cursor: url(<?php $this->options->themeUrl('cursor/pointer1.cur'); ?>), pointer;  }
</style>
    <?php elseif ('cursor2'==$this->options->cursor && !isMobile()):?>
 <style type="text/css">
     html {  cursor: url(<?php $this->options->themeUrl('cursor/default2.cur'); ?>), default;  }
     a {  cursor: url(<?php $this->options->themeUrl('cursor/pointer2.cur'); ?>), pointer;  }
     .btn,.icon-share {  cursor: url(<?php $this->options->themeUrl('cursor/pointer2.cur'); ?>), pointer;  }
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
