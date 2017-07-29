<aside id="sidebar">
    <aside>
        <form method="get" id="searchform" class="form-inline clearfix" action="./">
		<?php if("搜点什么呗"==$this->options->searchWord):?>
            <input class="form-control" name="s" id="s" placeholder="搜点什么呗" type="text">
		<?php else:?>
			<input class="form-control" name="s" id="s" placeholder="<?php $this->options->searchWord();?>" type="text">
		<?php endif;?>
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
    <?php if (!empty($this->options->ShowWeather) &&
        $this->options->ShowWeather > 0 && !isMobile()): ?>
    <aside>
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-cloud fa-fw"></i> 天气预报</div>
            <div class="list-group category">
<?php echo isNew();?>
            </div>
        </div>
    </aside>
<?php endif;?>
    <?php if(class_exists('Links_Plugin') && isset($this->options->plugins['activated']['Links'])): ?>
    <aside>
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-link fa-fw"></i> 友情链接</div>
            <ul class="list-group">
	<?php Links_Plugin::output('<li class="list-group-item"><a href="{url}" target="_blank">{name}</a></li>', 10, NULL, true); ?>
            </ul>
        </div>
    </aside>
	<?php elseif(!empty($this->options->links)):?>
	    <aside>
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-link fa-fw"></i> 友情链接</div>
            <ul class="list-group">
	<?php  
	if (!empty($this->options->switch) && in_array('ShowLinksIcon', $this->options->switch))
	{	
		preg_match_all("/(http|https):\/\/([\w\d\-_]+[\.\w\d\-_]+)[:\d+]?([\/]?[\w\/\.]+)/i", $this->options->links,$matches);
		$arrCode=explode("\n", $this->options->links);

        for($i=0;$i<sizeof($matches[0]);$i++)
        {   //自动获取favicon（盗链）
            //$favicon=$matches[0][$i].'/'.'favicon.ico';
            //f.ydr.me获取favicon
            $favicon='https://f.ydr.me/'.$matches[0][$i];
            $loss=$this->options->themeUrl.'/loss.ico';
            $icon='<img src="'.$favicon.'"'." onerror=".'"javascript:this.src=\''.$loss.'\';"'.' alt="pic" width="16"/>';
            echo str_replace(array('<a href','</a>'),
            array('<li class="list-group-item">'.$icon.'&nbsp;&nbsp;<a target="_blank" href',
            '</a></li>'),$arrCode[$i]);
        }
	}
	else{
		echo str_replace(array('<a href','</a>'),
		array('<li class="list-group-item"><a target="_blank" href',
		'</a></li>'),$this->options->links);
	}
?>
	
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

<?php if('ShowAll'==$this->options->showArchive):?>
	<aside>
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-archive fa-fw"></i> 文章存档</div>
            <div class="list-group category">			
                <?php 
					$this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->parse('
				<ul class="fa-ul"><li><i class="fa-li fa fa-calendar-o"></i>{year}-{month}-{day} : 
				<a href="{permalink}" class="fa fa-file-archive-o">&nbsp;&nbsp;{title}</a>
				</li></ul>');?>
</div></div></aside>
<?php elseif('ShowMonth'==$this->options->showArchive):?>
	<aside>
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-archive fa-fw"></i> 文章存档</div>
            <div class="list-group category">			
<?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y年m月')
->parse('<ul class="fa-ul"><li><a href="{permalink}" class="fa fa-calendar-o">&nbsp;&nbsp;{date}</a></li></ul>'); ?>
</div></div></aside>
<?php endif;?>

<aside >
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-yelp"></i> 网站统计</div>
<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
<ul class="fa-ul">
<li><i class="fa-li fa fa-flag-checkered "></i>建站日期：<?php echo substr($this->options->createTime,0,10) ?></li>
<li><i class="fa-li fa fa-file-text-o "></i>文章总数：<?php $stat->publishedPostsNum() ?>篇</li>
<li><i class="fa-li fa fa-file-zip-o "></i>页面总数：<?php $stat->publishedPagesNum() ?>个</li>
<li><i class="fa-li fa fa-folder-o "></i>分类总数：<?php $stat->categoriesNum() ?>个</li>
<li><i class="fa-li fa fa-comment-o "></i>评论总数：<?php $stat->publishedCommentsNum() ?>条</li>
</ul></div>
    </aside>
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
    <?php if(!empty($this->options->EmailFeed)): ?>
<li><i class="fa-li fa fa-envelope "></i><a href="<?php echo $this->options->EmailFeed; ?>">邮件 订阅</a></li>
    <?php endif;?>
</ul></div></div>
</aside></aside>