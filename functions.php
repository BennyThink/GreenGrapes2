<?php
date_default_timezone_set('Asia/Shanghai');
//加载耗时
function timer_start() {
    global $timestart;
    $mtime = explode( ' ', microtime() );
    $timestart = $mtime[1] + $mtime[0];
    return true;
}
timer_start();
 
function timer_stop( $display = 0, $precision = 3 ) {
    global $timestart, $timeend;
    $mtime = explode( ' ', microtime() );
    $timeend = $mtime[1] + $mtime[0];
    $timetotal = number_format( $timeend - $timestart, $precision );
    $r = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
    if ( $display )
    echo $r;
    return $r;
}

/**
* 判断时间区间
* <?php if(timeZone($this->date->timeStamp)) echo ' new'; ?>
* 使用方法  if(timeZone($this->date->timeStamp)) echo 'ok';
*/
function timeZone($from){
$now = new Typecho_Date(Typecho_Date::gmtTime());
return $now->timeStamp - $from < 24*60*60 ? true : false;
}

//字数统计
function  art_count ($cid){
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
    echo mb_strlen($text,'UTF-8');
}

function getBuildTime(){
// 在下面按格式输入本站创建的时间
$site_create_time = strtotime('2016-12-23 13:14:52');
$time = time() - $site_create_time; 
$time=floor($time/86400);
echo '<span class="time">'.'本站已经建立'.$time.'天啦!'.'</span>';
}
//访问量

function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
    }
    echo $row['views'];
}
/**
 * 头像：先QQ、再gravatar、最后是默认的
 * return img头像url，一定会获得头像url
**/
function avatar($email){
if(strpos($email,"@qq.com")){
    //如果是QQ邮箱的话，测试缓存策略
	$yourUrl='https://www.mingyueli.com/';
	$saveName='usr/uploads/avatarCache/'.md5($email).'.jpg';
	//echo 'QQ头像的地址显示在这里'.$yourUrl.$saveName;
	$lastModifyTime=filemtime($saveName);
	clearstatcache();
	if(file_exists($saveName) && (time()-$lastModifyTime)<604800)
		return '<img class="avatar" src="'.$yourUrl.$saveName.'" />';
	else
	{
		//echo '文件不存在或者过期，重新获取';
        $geturl = 'http://ptlogin2.qq.com/getface?&imgtype=1&uin='.$email;
        $qquser = file_get_contents($geturl);
		$str1 = explode('qq&k=', $qquser);
        $str2 = explode('&s=', $str1[1]);
        $k = $str2[0];
        $qqimg = 'https://q1.qlogo.cn/g?b=qq&k='.$k.'&s=100';
		//保存图片
		copy($qqimg,$saveName);
        return '<img class="avatar" src="'.$yourUrl.$saveName.'" />';
	}
}
else{
	//返回默认Gravatar头像  
	$uri=GravatarCache::getGravatarCache($email);
	return  '<img class="avatar" src="'.$uri.'"/>';
}

}


/**
 * 随机文章
 * @throws Typecho_Db_Exception
 * @throws Typecho_Widget_Exception
 */
function theme_random_posts(){
    $defaults = array(
        'number' => 10,
        'before' => '<ul class="list-group">',
        'after' => '</ul>',
        'xformat' => '<li class="list-group-item clearfix"><a href="{permalink}" title="{title}">{title}</a></li>'
    );
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('status = ?','publish')
        ->where('type = ?', 'post')
        ->where('created <= unix_timestamp(now())', 'post') //添加这一句避免未达到时间的文章提前曝光
        ->limit($defaults['number'])
        ->order('RAND()');
    $result = $db->fetchAll($sql);
    echo $defaults['before'];
    foreach($result as $val){
        $val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
        echo str_replace(array('{permalink}', '{title}'),array($val['permalink'], $val['title']), $defaults['xformat']);
    }
    echo $defaults['after'];
}
function themeConfig($form) {
    $options = Typecho_Widget::widget('Widget_Options');
    $bgImg = new Typecho_Widget_Helper_Form_Element_Text('bgImg', null, $options->themeUrl('img/bg.jpg', 'GreenGrapes'), _t('首页背景图片地址'), _t('在这里填入一个图片URL地址, 作为首页背景图片, 默认使用img下的header.png'));
    $form->addInput($bgImg);

    $headIcon = new Typecho_Widget_Helper_Form_Element_Text('headerIcon', null, $options->themeUrl('img/head.jpg', 'GreenGrapes'), _t('首页头像地址'), _t('在这里填入一个图片URL地址, 作为首页头像, 默认使用images下的head.png'));
    $form->addInput($headIcon);

    $siteIcon = new Typecho_Widget_Helper_Form_Element_Text('sideName', null, null, _t('侧栏用户名'), _t('在这里填入一个左侧显示的用户名, 默认不显示'));
    $form->addInput($siteIcon);

    $showBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('ShowBlock', array(
        'ShowPostBottomBar' => _t('文章页显示上一篇和下一篇')),
        array('ShowPostBottomBar'), _t('显示设置'));
    $form->addInput($showBlock->multiMode());
}

/**
 * 重写评论显示函数
 */
function threadedComments($comments, $options){
    $singleCommentOptions = $options;
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';

    ?>
<li itemscope itemtype="http://schema.org/UserComments" id="<?php $comments->theId(); ?>" class="comment-li<?php
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">

    <div class="comment-author" itemprop="creator" itemscope itemtype="http://schema.org/Person">
<!--A little bit slow, 100ms per avatar,QQ->Gravatar->default, need gravatarCache-->

<span itemprop="image"><?php $imgurl=avatar($comments->mail);echo $imgurl;?></span>
<!--new avatar system-->
<!--<span itemprop="image"><?php //$comments->gravatar($singleCommentOptions->avatarSize, $singleCommentOptions->defaultAvatar); ?></span>-->
    </div>
    <div class="comment-body">
        <cite class="fn" itemprop="name"><?php $singleCommentOptions->beforeAuthor();
            $comments->author();
            $singleCommentOptions->afterAuthor(); ?></cite>
        <div class="comment-content" itemprop="commentText">
            <?php $comments->content(); ?>
        </div>
        <div class="comment-footer">
            <time itemprop="commentTime" datetime="<?php $comments->date('c'); ?>"><?php $singleCommentOptions->beforeDate();
                $comments->date($singleCommentOptions->dateFormat);
                    $singleCommentOptions->afterDate(); ?></time>
            <?php $comments->reply($singleCommentOptions->replyWord); ?>
        </div>
    </div>
    <?php if ($comments->children) { ?>
        <div class="comment-children" itemprop="discusses">
            <?php $comments->threadedComments(); ?>
        </div>
    <?php } ?>
    
    
</li>
<?php

}
