<?php $this->need('header.php'); ?>
<div id="m-container" class="container">
    <div class="col-md-8">
        <div id="article-list">
            <article class="post-article clearfix">
                <div>
<?php if(!empty($this->options->switch) && in_array('ShowBreadCrumb', $this->options->switch)):?>
<div class="breadcrumb">
	<a href="<?php $this->options->siteUrl(); ?>">主页</a> &raquo;
	<?php if ($this->is('index')): ?><!-- 页面为首页时 -->
		Latest Post
	<?php elseif ($this->is('post')): ?><!-- 页面为文章单页时 -->
		<?php $this->category(); ?> &raquo; <?php $this->title() ?>
	<?php else: ?><!-- 页面为其他页时 -->
		<?php $this->archiveTitle(' &raquo; ','',''); ?>
	<?php endif; ?>
</div>				
<?php endif;?>
                    <h2 class="title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                    <p class="post-big-info">
                        <span class="label label-green"><i class="fa fa-user"></i> <a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span>
                        <span class="label label-green"><i class="fa fa-tags"></i> <?php $this->category(','); ?></span>
                        <span class="label label-green"><i class="fa fa-calendar"></i> <?php $this->date('Y-m-d'); ?></span>
<span class="label label-green"><?php if($this->user->hasLogin()):?><i class="fa fa-edit"></i><a href="/admin/write-post.php?cid=<?php echo $this->cid;?>">编辑</a><?php endif;?></span>
<span class="label label-green"><i class="fa fa-line-chart"></i> <?php _e('浏览量: '); ?><?php get_post_view($this) ?></span>
<span class="label label-green"><i class="fa fa-keyboard-o"></i> <?php _e('字数统计: '); ?><?php echo art_count($this->cid); ?></span>
<span class="label label-green"><i class="fa fa-clock-o"></i> <?php _e('最后更新： '); ?><?php echo gmdate('Y-m-d H:i', $this->modified + Typecho_Widget::widget('Widget_Options')->timezone); ?></span>
                    </p>
                </div>
                <div class="article-content clearfix">
                    <?php //$this->content(); 
					echo render($this->content);?>
                </div>
                <?php if($this->allow('ping')): ?>
                    <div class="article-copyright">
                        <div class="article-license">

<?php if(!empty($this->options->motto)
    && strpos($this->options->motto, '!@') !== false):
    echo preg_replace('/\!\@(.+?)\!\@/i', "$1", $this->options->motto).'<br>';
?>
<?php elseif(!empty($this->options->motto)):?>
    <style>.catlist{border:2px solid #FFB6C1;padding:5px;margin-top: 12px;text-align: center;color:#000;}.yunluotips{border: 2px solid #FFCC33;padding: 15px}.panel{display:none}.panel h3{margin:0;font-size:1.2em}#panel_update ul{list-style-type:disc}.nav-tab-wrapper{clear:both}.nav-tab{position:relative}.nav-tab i:before{position:absolute;top:-10px;right:-8px;display:inline-block;padding:2px;border-radius:50%;background:#e14d43;color:#fff;content:"\f463";vertical-align:text-bottom;font:400 18px/1 dashicons;speak:none}#theme-options-search{display:none;float:right;margin-top:-34px;width:280px;font-weight:300;font-size:16px;line-height:1.5}.updated+#theme-options-search{margin-top:-91px}.wrap.searching .nav-tab-wrapper a,.wrap.searching .panel tr,#attrselector{display:none}.wrap.searching .panel{display:block !important}#attrselector[attrselector*=ok]{display:block}</style>
<?php $url=$this->author->url;$name=$this->author->screenName.' 说：';
echo avatar($this->author->mail);
echo "<a href='$url'>$name</a>";?>
<div class="yunluotips"><?php echo $this->options->motto;?></div><br>
<?php endif;?>
                            <img height="24" src="<?php $this->options->themeUrl('img/creativecommons-cc.png'); ?>" class="mb5"><br>
                            <div class="license-item text-muted">
<?php if(empty($this->options->copyright)):?>
本文由 <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a> 创作，
采用 <a class="alert-link" target="_blank" href="https://creativecommons.org/licenses/by-nc-sa/4.0/">CC-BY-NC-SA 4.0</a>授权，
可自由转载、引用、不可商用，但需署名作者且注明文章出处。
<?php else:
$newInfo=$this->options->copyright;
$newInfo=str_replace("{{title}}", $this->title, $newInfo);
$newInfo=str_replace("{{link}}", $this->permalink, $newInfo);
$newInfo=str_replace("{{name}}", $this->author->screenName, $newInfo);
$newInfo=str_replace("{{homepage}}", $this->author->url, $newInfo);
echo $newInfo;
?>
<?php endif; ?>
</div></div></div>
                <?php endif; ?>
                <?php if(class_exists('Reward_Plugin') && isset($this->options->plugins['activated']['Reward'])): ?>
                    <?php Reward_Plugin::show_reward(); ?>
                    <?php Reward_Plugin::show_modal(); ?>
                <?php endif; ?>
            </article>
        </div>
<style>
	body {
	font: 14px/1 "Helvetica Neue",Helvetica,Arial,sans-serif;
	margin:0;
	padding:0;
	background: #DFF4FF;
	}

	.wrapper {
	text-align: center;
	}
</style>
<!-- needPopup Javascript file -->
<script src="<?php $this->options->themeUrl('js/needsharebutton.min.js'); ?>"></script>
<!-- needPopup CSS file -->
<link href="<?php $this->options->themeUrl('css/needsharebutton.min.css'); ?>" rel="stylesheet" />
<div class="wrapper">
<div id="i-share" data-share-position="bottomCenter" class="need-share-button-default" data-share-icon-style="box" data-share-networks="QQZone,Wechat,Weibo,Douban,Twitter,Facebook,Evernote">
	<i class="i-share icon-share" aria-hidden="true"></i>
</div>
<!--like--></div>
<script>
new needShareButton(document.getElementById('i-share'));
</script>
<?php if (!empty($this->options->switch) && in_array('ShowPostBottomBar', $this->options->switch)): ?>
        <div class="block">
            <ul class="post-near">
                <li>上一篇: <?php $this->thePrev('%s','没有了'); ?></li>
                <li>下一篇: <?php $this->theNext('%s','没有了'); ?></li>
            </ul>
        </div>
    <?php endif; ?>
        <?php $this->need('comments.php'); ?>
    </div>
    <div class="col-md-4">
        <?php $this->need('sidebar.php'); ?>
    </div>
</div>
<?php $this->need('footer.php');?>