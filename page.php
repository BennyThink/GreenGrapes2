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
            </article>
        </div>
        <?php $this->need('comments.php'); ?>
    </div>
    <div class="col-md-4">
        <?php $this->need('sidebar.php'); ?>
    </div>
</div>
<?php $this->need('footer.php');
