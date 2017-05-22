<aside id="sidebar">
    <aside>
        <form method="get" id="searchform" class="form-inline clearfix" action="./">
            <input class="form-control" name="s" id="s" placeholder="搜索关键词..." type="text">
            <button class="btn btn-green btn-small"><i class="fa fa-search"></i> 查找</button>
        </form>
    </aside>
    <aside>
        <div class="panel widget-sets hidden-xs">
            <ul class="nav nav-pills">
                <li class="active"><a href="#sidebar-new" data-toggle="tab">最新文章</a></li>
                <li class=""><a href="#sidebar-comment" data-toggle="tab">最新评论</a></li>
                <li class=""><a href="#sidebar-rand" data-toggle="tab">随机文章</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane nav bs-sidenav fade active in" id="sidebar-new">
                    <ul class="list-group">
                        <?php $this->widget('Widget_Contents_Post_Recent')
                            ->parse('<li class="list-group-item clearfix"><a href="{permalink}">{title}</a></li>'); ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="sidebar-comment">
                    <?php 
					if (!empty($this->options->switch) && in_array('ShowBloggerCheckBox', $this->options->switch))
						$this->widget('Widget_Comments_Recent','ignoreAuthor=true')->to($comments);
					else
						$this->widget('Widget_Comments_Recent')->to($comments); ?>
                    <?php while($comments->next()): ?>
                        <li class="list-group-item clearfix"><?php $comments->author(false); ?>：<a href="<?php $comments->permalink(); ?>" target="_blank"><?php $comments->excerpt(35, '...'); ?></a></li>
                    <?php endwhile; ?>
                        
                </div>
                <div class="tab-pane nav bs-sidenav fade" id="sidebar-rand">
                    <?php theme_random_posts();?>
                </div>
            </div>
        </div>
    </aside>
    <?php if(class_exists('Links_Plugin') && isset($this->options->plugins['activated']['Links'])): ?>
    <aside>
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-link fa-fw"></i> 友情链接</div>
            <ul class="list-group">
                <?php Links_Plugin::output('<li class="list-group-item"><a href="{url}" target="_blank">{name}</a></li>', 10, NULL, true); ?>
            </ul>
        </div>
    </aside>
    <?php endif; ?>
    <?php if(true): ?>
    <aside>
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-book fa-fw"></i> 文章分类：目前总计 <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?><?php $stat->publishedPostsNum() ?> 篇</div>
            <div class="list-group category">
                <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
            </div>
        </div>
    </aside>
    <?php endif; ?>
    <aside >
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-tags fa-fw"></i> 标签云</div>
            <div id="meta-cloud">
            <canvas height="300" id="mycanvas" style="width: 100%">
                <p>标签云</p>
                <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
                <?php $this->widget('Widget_Metas_Tag_Cloud')->parse('<a href="{permalink}" class="tag">{name}</a>'); ?>
            </canvas>
            </div>
        </div>
    </aside>
<!--网站统计，待优化。如果需要请取消注释-->
<!--
<aside >
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-tags fa-fw"></i> 网站统计</div>
            <div id="meta-cloud">
<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
<p><?php _e('奔跑的蜗牛壳自 <strong>2016</strong> 年末建立以来，截至 %s 在已设定的 <strong>%s</strong> 个分类
和 <strong>%s</strong> 个页面中，
共发布了 <strong>%s</strong> 篇文章，并收到了 <strong>%s</strong> 条相关评论。
', date('Y年n月j日G时i分'), $stat->categoriesNum, $stat->publishedPagesNum, $stat->publishedPostsNum, $stat->publishedCommentsNum); ?></p>

            </div>
        </div>
    </aside>
-->

<div id="fixed"></div>
<aside class="fixsidebar">
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-terminal"></i> 欢迎主人来到这里(=￣ω￣=)</div>
            <div id="meta-cloud">
<ul class="fa-ul">
<?php if($this->user->hasLogin()): ?>
<li><i class="fa-li fa fa-spinner fa-spin"></i><a href="<?php $this->options->adminUrl(); ?>"><?php $this->user->screenName(); ?></a></li>
<li><i class="fa-li fa fa-spinner fa-spin"></i><a href="<?php $this->options->logoutUrl(); ?>">登出</a></li>
<?php else: ?>
<li><i class="fa-li fa fa-user fa-fw"></i><a href="<?php $this->options->adminUrl('login.php'); ?>">登录</a></li>
<?php endif; ?>
<li><i class="fa-li fa fa-rss "></i><a href="<?php $this->options->feedUrl(); ?>">RSS 订阅</a></li>
</ul></div></div>
</aside></aside>
