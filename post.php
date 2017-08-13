<?php $this->need('header.php'); ?>
<div id="m-container" class="container">
    <div class="col-md-8">
	    <?php if ( ! empty( $this->options->switch ) && in_array( 'ShowFortunes', $this->options->switch ) ): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">
                    &times;
                </button>
			    <?php echo randomFortunes() ?>
            </div>
	    <?php endif ?>
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
                        <span class="label label-green"><i class="fa fa-tags"></i> <?php $this->category(','); ?></span>
                        <span class="label label-green"><i class="fa fa-calendar"></i> <?php $this->date('Y-m-d'); ?></span>
<span class="label label-green"><?php if($this->user->hasLogin()):?><i class="fa fa-edit"></i><a href="/admin/write-post.php?cid=<?php echo $this->cid;?>">编辑</a><?php endif;?></span>
<span class="label label-green"><i class="fa fa-line-chart"></i> <?php _e('浏览量: '); ?><?php get_post_view($this) ?></span>
<span class="label label-green"><i class="fa fa-keyboard-o"></i> <?php _e('字数统计: '); ?><?php echo art_count($this->cid); ?></span>
<span class="label label-green"><i class="fa fa-clock-o"></i> <?php _e('最后更新： '); ?><?php echo gmdate('Y-m-d H:i', $this->modified + Typecho_Widget::widget('Widget_Options')->timezone); ?></span>
                    </p>
                </div>
                <div class="article-content clearfix">
	                <?php
	                if ( ! empty( $this->options->switch ) &&
	                     in_array( 'EnableHide', $this->options->switch ) ) {
                        //$this->content();
		                $db     = Typecho_Db::get();
		                $sql    = $db->select()->from( 'table.comments' )
		                             ->where( 'cid = ?', $this->cid )
		                             ->where( 'mail = ?', $this->remember( 'mail', true ) )
		                             ->limit( 1 );
		                $result = $db->fetchAll( $sql );
		                if ( $this->user->hasLogin() || $result ) {
			                $content = preg_replace( "/\[hide\](.*?)\[\/hide\]/sm", '<div class="reply2view">$1</div>', $this->content );
		                } else {
			                $content = preg_replace( "/\[hide\](.*?)\[\/hide\]/sm", '<div class="reply2view">此处内容需要评论回复后方可阅读。</div>', $this->content );
		                }
		                echo render( $content );
	                } else {
		                echo render( $this->content );
	                }
	                ?>
                </div>
                <?php if($this->allow('ping')): ?>
                    <div class="article-copyright">
                        <div class="article-license">

<?php if(!empty($this->options->motto)
    && strpos($this->options->motto, '!@') !== false):
    echo preg_replace('/\!\@(.+?)\!\@/i', "$1", $this->options->motto).'<br>';
?>
<?php elseif(!empty($this->options->motto)):?>
    <style>
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
            </article>
        </div>
<!-- needPopup Javascript file -->
<script src="<?php $this->options->themeUrl('js/needsharebutton.min.js'); ?>"></script>
<!-- needPopup CSS file -->
<link href="<?php $this->options->themeUrl('css/needsharebutton.min.css'); ?>" rel="stylesheet" />
<div style="text-align:center;">
    <!--reward-->
	<?php if ( ! empty( $this->options->wechatBR ) || ! empty( $this->options->alipayBR ) ): ?>
        <button class="need-share-button-default" type="button" data-toggle="modal" data-target="#pay-modal">
            &nbsp;<i class="fa fa-rmb"></i>&nbsp;&nbsp;</button>
        <div class="modal fade" id="pay-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                    class="sr-only">Close</span></button>
                        <h4 class="modal-title">谢谢您的支持</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
							<?php if ( ! empty( $this->options->wechatBR ) && ! empty( $this->options->alipayBR ) ): ?>
                            <img id="brcode" src="<?php echo $this->options->alipayBR ?>" alt=""/><br><br>
                                <button type="button" class="btn btn-default" id="alipay">
                                    支付宝支付
                                </button>
                                <button type="button" class="btn btn-default" id="wechat">
                                    微信支付
                                </button>
                                <script>
                                    $('#alipay').on('click', function () {
                                        var imgsrc = "<?php echo $this->options->alipayBR ?>";
                                        $("#brcode").attr('src', imgsrc);
                                    })
                                    $('#wechat').on('click', function () {
                                        var imgsrc = "<?php echo $this->options->wechatBR ?>";
                                        $("#brcode").attr('src', imgsrc);
                                    })
                                </script>
							<?php elseif ( $this->options->alipayBR ): ?>
                            <img id="brcode" src="<?php echo $this->options->alipayBR ?>" alt=""/><br><br>
                                <button type="button" class="btn btn-default" id="alipay">
                                    支付宝支付
                                </button>
							<?php elseif ( $this->options->wechatBR ): ?>
                            <img id="brcode" src="<?php echo $this->options->wechatBR ?>" alt=""/><br><br>
                                <button type="button" class="btn btn-default" id="wechat">
                                    微信支付
                                </button>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php endif; ?>
    <!--reward end-->

<div id="i-share" data-share-position="bottomCenter" class="need-share-button-default" data-share-icon-style="box" data-share-networks="QQZone,Wechat,Weibo,Douban,Twitter,Facebook,Evernote">
	<i class="i-share icon-share" aria-hidden="true"></i>
</div></div>
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