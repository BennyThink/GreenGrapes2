<?php $this->need('header.php'); ?>
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
    <div class="wrapper">
        <div class="error-page">
            <h2 class="post-title">404 - <?php _e('页面没找到'); ?></h2>

<?php
if(empty(Helper::options()->notFoundGame))
{
echo '<p>'._e('哎呦卧槽~404了！搜索试试？要不画画吧！').'</p>';
echo '<br><embed width="560" height="270" src="https://okwbu9s8e.qnssl.com/canvas-drawing/html5-canvas-drawing-app.html" />';
}	
elseif (Helper::options()->notFoundGame==1)
{
echo '<p>'._e('哎呦卧槽~404了！搜索试试？或者玩玩我们的小恐龙？').'</p>';
echo '<br><embed width="400" height="280" src="https://okwbu9s8e.qnssl.com/t-rex-runner/index.html" />';
}	
elseif (Helper::options()->notFoundGame==2)
	{
echo '<p>'._e('哎呦卧槽~404了！搜索试试？要不帮我喂喂可怜的小松鼠吧').'</p>';
echo '<br><embed width="290" height="230" src="https://o51bfbumd.qnssl.com/h5hamster.html" />';
}	
?>
            
            <form method="post">
                <p><input type="text" name="s" class="text" autofocus /></p>
                <p><button type="submit" class="submit"><?php _e('搜索'); ?></button></p>
            </form>
        </div>

    </div><!-- end #content-->
<?php $this->need('footer.php'); ?>
