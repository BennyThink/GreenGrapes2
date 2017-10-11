<?php $this->need('header.php'); ?>
<style>
	.wrapper {
	text-align: center;
	}
</style>
    <div class="wrapper">
        <div class="error-page">
            <h2 class="post-title">404 - <?php _e('页面没找到'); ?></h2>
			<?php $this->options->tongJi(); ?>
	        <?php
	        if ( empty( $this->options->notFoundGame ) ):?>
                <p>哎呦卧槽~404了！搜索试试？</p>
                Some of us get dipped in flat, some in satin, some in gloss.<br>
                But every once in a while you find someone who's iridescent, <br>and when you do,<br>
                <strong>nothing will ever compare.</strong><br>
	        <?php elseif ( $this->options->notFoundGame == 1 ): ?>
                <p>哎呦卧槽~404了！搜索试试？或者玩玩我们的小恐龙？</p><br>
                <embed width="330" height="280"
                   src="<?php $this->options->themeUrl( 'extra/games/t-rex-runner/index.html' ); ?>">
		    <?php elseif ( $this->options->notFoundGame == 2 ): ?>
                <p>哎呦卧槽~404了！搜索试试？打败幽灵吧！</p><br>
                <embed width="420" height="280"
                       src="<?php $this->options->themeUrl( 'extra/games/halloween-2016/index.html' ); ?>">
			<?php endif; ?>
            <form method="post">
                <p><input type="text" name="s" class="text" autofocus /></p>
                <p><button type="submit" class="submit"><?php _e('搜索'); ?></button></p>
            </form>
        </div>
    </div>
<?php $this->need('footer.php'); ?>