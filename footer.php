<div id="back-to-top" class="red" title="返回顶部" data-scroll="body" style="display: none;">
    <svg id="point-up" version="1.1" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
        <path d="M23.588 17.637c-0.359-0.643-0.34-1.056-2.507-3.057 0.012-7.232-4.851-12.247-5.152-12.55 0-0.010 0-0.015 0-0.015s-0.003 0.003-0.007 0.007l-0.007-0.007c0 0 0 0.005 0 0.015-0.299 0.305-5.141 5.342-5.097 12.575-2.158 2.010-2.138 2.423-2.493 3.068-0.65 1.178-0.481 5.888 0.132 6.957 0.613 1.069 1.629 0.293 1.977-0.004 0.348-0.298 1.885-2.264 2.263-2.176 0 0 0.465-0.090 0.989 0.414 0.518 0.498 1.462 0.966 2.27 1.033 0 0.001 0 0.002-0 0.003 0.005-0.001 0.010-0.001 0.015-0.002 0.005 0 0.010 0.001 0.015 0.001 0-0.001-0-0.002 0-0.003 0.808-0.070 1.749-0.543 2.265-1.043 0.522-0.507 0.988-0.419 0.988-0.419 0.378-0.090 1.923 1.869 2.272 2.165 0.35 0.296 1.369 1.067 1.977-0.005 0.608-1.072 0.756-5.783 0.101-6.958v0 0zM15.95 14.86c-1.349 0.003-2.445-1.112-2.448-2.492-0.003-1.38 1.088-2.5 2.437-2.503 1.349-0.003 2.445 1.112 2.448 2.492 0.003 1.379-1.088 2.5-2.437 2.503v0 0zM17.76 24.876c-0.615 0.474-1.236 0.633-1.801 0.626-0.566 0.009-1.187-0.147-1.804-0.617-0.553-0.403-1.047-0.348-1.308 0.003-0.261 0.351-0.169 2.481 0.152 2.939 0.321 0.458 0.697-0.298 1.249-0.327 0.552-0.028 1.011 1.103 1.221 1.75 0.107 0.331 0.274 0.633 0.5 0.654 0.226-0.023 0.392-0.326 0.497-0.657 0.207-0.648 0.661-1.781 1.213-1.756 0.553 0.026 0.932 0.78 1.251 0.321 0.319-0.459 0.401-2.59 0.139-2.94-0.262-0.35-0.757-0.403-1.308 0.003v0 0z" fill="#CCCCCC"></path>
    </svg>
</div>
<footer id="m-footer">
<div class="Copyright">
        <p>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
        <?php _e('All Rights Reserved.'); ?>
        </p>
<link href="<?php $this->options->themeUrl('css/shaky.css'); ?>" rel="stylesheet" />
<?php getBuildTime(); ?><span class="shaky">(´・ω・`)</span>
加载耗时：<?php echo timer_stop(); welcome_hello();?> 
<?php if(!empty($this->options->footer))
echo '<br>'.$this->options->footer;?>
</div>
<!--SNS-->
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
<a class="fa fa-telegram fa-stack-1x" href="<?php $this->options->TelegramURL() ?>" target="view_window"></a>
</span><?php endif;?>
<?php if (!empty($this->options->QQURL)) : ?><span class="fa-stack fa-lg">
<a class="fa fa-qq fa-stack-1x" href="http://wpa.qq.com/msgrd?v=3&uin=<?php $this->options->QQURL() ?>&site=qq&menu=yes" target="view_window"></a>
</span><?php endif;?>
<?php if (!empty($this->options->weixinURL)) : ?><span class="fa-stack fa-lg">
<a class="fa fa-weixin fa-stack-1x" href="https://open.weixin.qq.com/qr/code/?username=<?php $this->options->weixinURL() ?>" target="view_window"></a>
</span><?php endif;?>
</footer>
<script src = "<?php $this->options->themeUrl('js/jquery2.14.min.js'); ?>"></script>
<script src = "<?php $this->options->themeUrl('js/bootstrap.min.js'); ?>" async></script>
<script src = "<?php $this->options->themeUrl('js/functionall.js'); ?>" async></script>
<script src = "<?php $this->options->themeUrl('js/tagcanvas.min.js'); ?>"></script>
<script src = "<?php $this->options->themeUrl('js/particles.min.js'); ?>"></script>
<script src = "<?php $this->options->themeUrl('js/headerCanvas.js'); ?>" async></script>
<script src = "<?php $this->options->themeUrl('js/home.js'); ?>" async></script>
<script src="<?php $this->options->themeUrl('js/zoom.min.js'); ?>" async></script>
<link rel="stylesheet" href="<?php $this->options->themeUrl('css/zoom.css'); ?>" >
<?php $this->footer(); ?>
<!--Typing effect-->
<?php if(!empty($this->options->switch ) && 
in_array('showTypeColorful',$this->options->switch)&& in_array('showTypeShake',$this->options->switch)&&!isMobile()):?>
<script src="<?php $this->options->themeUrl('js/typing.js'); ?>" ></script>
<script type="text/javascript">
POWERMODE.colorful = true; // make power mode colorful
POWERMODE.shake = true; // turn off shake
document.body.addEventListener('input', POWERMODE);
</script>
<?php elseif(!empty($this->options->switch) && in_array('showTypeColorful',$this->options->switch)&&!isMobile()):?>
<script src="<?php $this->options->themeUrl('js/typing.js'); ?>" ></script>
<script type="text/javascript">
POWERMODE.colorful = true; // make power mode colorful
POWERMODE.shake = false; // turn off shake
document.body.addEventListener('input', POWERMODE);
</script>
<?php elseif(!empty($this->options->switch) && in_array('showTypeShake',$this->options->switch)&&!isMobile()):?>
<script src="<?php $this->options->themeUrl('js/typing.js'); ?>" ></script>
<script type="text/javascript">
POWERMODE.colorful = false; // make power mode colorful
POWERMODE.shake = true; // turn off shake
document.body.addEventListener('input', POWERMODE);
</script>
<?php endif; ?>
<script type="text/javascript">
//dynamic title
window.onblur = function() {
    document.title = "喵 (●'◡'●)~快回来";
$("#web-icon").attr('href',"<?php $this->options->themeUrl('loss.ico'); ?>");
window.onfocus = function() {
    document.title = "<?php $this->archiveTitle(array(
'category'=>_t('分类 %s 下的文章'),
'search'=>_t('包含关键字 %s 的文章'),
'tag' =>_t('标签 %s 下的文章'),
'author'=>_t('%s 发布的文章')
), '', ' - '); ?><?php $this->options->title(); ?>";
$("#web-icon").attr('href',"<?php $this->options->siteUrl(); ?>favicon.ico");
}};
jQuery(window).ready(function() {
    jQuery("#loading").fadeOut(500);
});
console.info('%c The tiniest possibility of seeing you again excites me.', "background: white; color: #16a085; padding-left:10px;");
var setupContents = function () {
            $(".article-content img").each(function() {
                $(this).attr('data-action', 'zoom');
            });         
        };
 setupContents();
 $('#loading').remove();
</script>
<?php if (!empty($this->options->switch) && in_array('atargetblank', $this->options->switch)): ?>
<script>
    //Add target="_blank" to a tags
    $(document).bind('DOMNodeInserted', function(event) {
        $('a[href^="http"]').each(
            function() {
                if (!$(this).attr('target')) {
                    $(this).attr('target', '_blank')
                }
            }
        );
    });
</script>
<?php endif; ?>
<?php if (!empty($this->options->switch) && in_array('Pangu', $this->options->switch)): ?>
<script src="<?php $this->options->themeUrl('js/pangu.min.js'); ?>" ></script>
<script> pangu.spacingPage(); </script>
<?php endif; ?>
<?php if (!empty($this->options->switch) && in_array('EnableKiana', $this->options->switch)): ?>
<script src="<?php $this->options->themeUrl('kiana/bga.min.js'); ?>" async></script>
<?php endif; ?>
<?php if (!empty($this->options->switch) && in_array('SmoothScroll', $this->options->switch)): ?>
<script src="<?php $this->options->themeUrl('js/smoothscroll.js'); ?>" async></script>
<?php endif; ?>
</body></html>
<!--I'm here as always. By Benny 2017-->
