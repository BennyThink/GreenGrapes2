<?php $this->need('header.php'); ?>
<div id="m-container" class="container">
    <div class="col-md-8">
        <div id="article-list">
            <article class="post-article clearfix">
                <div>
<?php if(!empty($this->options->switch) && in_array('ShowBreadCrumb', $this->options->switch)):?>
<div class="breadcrumb">
	<a href="<?php $this->options->siteUrl(); ?>">主页</a> <i class="fa fa-angle-double-right"></i>
	<?php if ($this->is('index')): ?><!-- 页面为首页时 -->
		Latest Post
	<?php elseif ($this->is('post')): ?><!-- 页面为文章单页时 -->
		<?php $this->category(); ?> <i class="fa fa-angle-double-right"></i> <?php $this->title() ?>
	<?php else: ?><!-- 页面为其他页时 -->
		<?php $this->archiveTitle(' &raquo; ','',''); ?>
	<?php endif; ?>
</div>				
<?php endif;?>
                    <h2 class="title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                    <p class="post-big-info">
                        <span class="label label-green"><i class="fa fa-user"></i> <a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span>
                        <span class="label label-green"><i class="fa fa-calendar"></i> <?php $this->date('Y-m-d'); ?></span>
<span class="label label-green"><?php if($this->user->hasLogin()):?><i class="fa fa-edit"></i><a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" >编辑</a><?php endif;?></span>
<span class="label label-green"><i class="fa fa-line-chart"></i> <?php _e('浏览量: '); ?><?php get_post_view($this) ?></span>
<span class="label label-green"><i class="fa fa-keyboard-o"></i> <?php _e('字数统计: '); ?><?php echo art_count($this->cid); ?></span>
<span class="label label-green"><i class="fa fa-clock-o"></i> <?php _e('最后更新： '); ?><?php echo gmdate('Y-m-d H:i', $this->modified + Typecho_Widget::widget('Widget_Options')->timezone); ?></span>
                    </p>
                </div>
                <div class="article-content clearfix">
                    <?php //$this->content(); 
					echo render($this->content);?>
                </div>
                <div class="article-copyright">
                    <div class="article-license">
<?php if(!empty($this->options->motto)
    && strpos($this->options->motto, '!@') !== false):
echo preg_replace('/\!\@(.+?)\!\@/i', "$1", $this->options->motto).'<br>'; ?>
<?php elseif(!empty($this->options->motto)):?>
    <style>.catlist {
            border: 2px solid #FFB6C1;
            padding: 5px;
            margin-top: 12px;
            text-align: center;
            color: #000;
        }

        .yunluotips {
            border: 2px solid #FFCC33;
            padding: 15px
        }
    </style>
<?php $url=$this->author->url;$name=$this->author->screenName.' 说：';
    echo avatar($this->author->mail);
    echo "<a href='$url'>$name</a>";?>
<div class="yunluotips"><?php echo $this->options->motto;?></div><br>
<?php endif;?>
                        <img height="24" src="<?php $this->options->themeUrl('img/creativecommons-cc.png'); ?>" class="mb5"><br>
                        <div class="license-item text-muted">
<?php if(empty($this->options->copyright)):?>
    本文由 <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a> 创作，
    采用 <a class="alert-link" target="_blank"
    href="https://creativecommons.org/licenses/by-nc-sa/4.0/">CC-BY-NC-SA4.0</a>授权，
    可自由转载、引用、不可商用，但需署名作者且注明文章出处。
<?php else:
    $newInfo=$this->options->copyright;
    $newInfo=str_replace("{{title}}", $this->title, $newInfo);
    $newInfo=str_replace("{{link}}", $this->permalink, $newInfo);
    $newInfo=str_replace("{{name}}", $this->author->screenName, $newInfo);
    $newInfo=str_replace("{{homepage}}", $this->author->url, $newInfo);
    echo $newInfo;?>
<?php endif; ?>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <?php $this->need('comments.php'); ?>
    </div>
    <div class="col-md-4">
        <?php $this->need('sidebar.php'); ?>
    </div>
</div>
<?php $this->need('footer.php');
