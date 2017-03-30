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
            <p><?php _e('哎呦卧槽~404了！搜索试试？或者帮我喂喂可怜的小仓鼠吧！ '); ?></p>
<br><embed width="290" height="230" src="https://o51bfbumd.qnssl.com/h5hamster.html" />
            <form method="post">
                <p><input type="text" name="s" class="text" autofocus /></p>
                <p><button type="submit" class="submit"><?php _e('搜索'); ?></button></p>
            </form>
        </div>

    </div><!-- end #content-->
<?php $this->need('footer.php'); ?>
