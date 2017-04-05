<?php
date_default_timezone_set('Asia/Shanghai');
//预览图Helper::options()->themeUrl('img/bg/', 'GreenGrapes2')
function thumb($cid) {
if (empty($imgurl)) {
$rand_num = 15; //随机图片数量，根据图片目录中图片实际数量设置
if ($rand_num == 0) {
$imgurl = Helper::options()->themeUrl('img/bg/', 'GreenGrapes2').'0.jpg';
//如果$rand_num = 0,则显示默认图片，须命名为"0.jpg"，注意是绝对地址
}else{
$imgurl = Helper::options()->themeUrl('img/bg/', 'GreenGrapes2').rand(1,$rand_num).".jpg";
//随机图片，须按"1.jpg","2.jpg","3.jpg"...的顺序命名，注意是绝对地址
}
}
$db = Typecho_Db::get();
$rs = $db->fetchRow($db->select('table.contents.text')
->from('table.contents')
->where('table.contents.type = ?', 'attachment')
->where('table.contents.parent= ?', $cid)
->order('table.contents.cid', Typecho_Db::SORT_ASC)
->limit(1));
$img = unserialize($rs['text']);
if (empty($img)){
//这个效果不好，不带class吧echo '<img class="col-md-3" src="'.$imgurl.'" />';
echo '<img  src="'.$imgurl.'" />';
}
else{
//echo str_replace('/','',Helper::options()->siteUrl).$img['path'];//有图
$imgPath=substr(Helper::options()->siteUrl,0,strlen(Helper::options()->siteUrl)-1).$img['path'];//有图
echo '<img src="'.$imgPath.'" width="300" />';
}
}




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
if(empty(Helper::options()->createTime))
	$ct='2016-12-23 13:59:00';
else
	$ct=Helper::options()->createTime;
$site_create_time = strtotime($ct);
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
$yourUrl=Helper::options()->siteUrl;
$saveName='usr/uploads/avatarCache/'.md5(strtolower(trim($email))).'.jpg';
clearstatcache();
if(empty(Helper::options()->cacheTime))
	$ct=1209600;
else
	$ct=Helper::options()->cacheTime;
//echo 'current cacheTime is '.$ct;
if(strpos($email,"@qq.com")){
    //如果是QQ邮箱的话，测试缓存策略
	if(file_exists($saveName) && (time()-filemtime($saveName))<$ct)
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
elseif(file_exists($saveName) && (time()-filemtime($saveName))<$ct){
	//返回未超时的gravatar
		//已有缓存
		return '<img class="avatar" src="'.$yourUrl.$saveName.'" />';
	}
else{	
		//获取新的gravatar，并判断
		$headers = @get_headers('https://www.gravatar.com/avatar/'.md5(strtolower(trim($email))).'?d=404');		
		if (preg_match("/404/", $headers[0])) { 
		//无头像，应该拷贝头像
		copy($yourUrl.'usr/themes/GreenGrapes2/img/default.jpg',$saveName);
		return '<img class="avatar" src="'.$yourUrl.'usr/themes/GreenGrapes2/img/default.jpg" />'; 	
		} else {
		//有gravatar
		copy('https://www.gravatar.com/avatar/'.md5(strtolower(trim($email))),$saveName);
        return '<img class="avatar" src="'.$yourUrl.$saveName.'" />'; 
		}
	
	}

}

function getUA($ua,$isPic){
	 
        //开始解析操作系统
        $os = null;
        if (preg_match('/Windows NT 6.0/i', $ua))
            $os = "Windows Vista";
        elseif (preg_match('/Windows NT 6.1/i', $ua))
            $os = "Windows 7";
        elseif (preg_match('/Windows NT 6.2/i', $ua))
            $os = "Windows 8";
        elseif (preg_match('/Windows NT 6.3/i', $ua))
            $os = "Windows 8.1";
        elseif (preg_match('/Windows NT 10.0/i', $ua))
            $os = "Windows 10";
        elseif (preg_match('/Windows NT 5.1/i', $ua)) 
            $os = "Windows XP";
        elseif (preg_match('/Windows NT 5.2/i', $ua) && preg_match('/Win64/i', $ua)) 
            $os = "Windows XP 64 bit";
		elseif (preg_match('/Windows NT 5.0/i', $ua)) 
            $os = "Windows 2000 Professional";
        elseif (preg_match('/Android ([0-9.]+)/i', $ua, $matches)) 
            $os = "Android " . $matches[1];
        elseif (preg_match('/iPhone OS ([_0-9]+)/i', $ua, $matches)) 
            $os = 'iPhone ' . $matches[1];
		elseif (preg_match('/iPad/i', $ua)) 
            $os = "iPad";
		elseif (preg_match('/Mac OS X ([_0-9]+)/i', $ua, $matches)) 
            $os = 'Mac OS X ' . $matches[1];		
		elseif (preg_match('/Windows Phone ([_0-9]+)/i', $ua, $matches)) 
            $os = 'Windows Phone ' . $matches[1];
		elseif(preg_match('/Gentoo/i',$ua))
			$os = 'Gentoo Linux';
		elseif(preg_match('/Ubuntu/i',$ua))
			$os = 'Ubuntu Linux';
		elseif(preg_match('/Debian/i',$ua))
			$os = 'Debian Linux';
		elseif(preg_match('/curl/i',$ua))
			$os = 'Linux distribution';
		elseif(preg_match('/X11; FreeBSD/i',$ua))
			$os = 'FreeBSD';
		elseif(preg_match('/X11; Linux/i',$ua))
			$os = 'Linux';
		elseif(preg_match('/X11; SunOS/i',$ua)||preg_match('/Solaris/i',$ua))
			$os = 'SunOS';
		elseif(preg_match('/BlackBerry/i',$ua))
			$os = 'BlackBerry';
        else 
            $os = '未知操作系统';
        
		//解析浏览器
        if (preg_match('#(Camino|Chimera)[ /]([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = 'Camino ' . $matches[2];
        elseif (preg_match('#SE 2([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = '搜狗浏览器 2' . $matches[1];
        elseif (preg_match('#360([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = '360浏览器 ' . $matches[1];
        elseif (preg_match('#Maxthon( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) 
			$browser = 'Maxthon ' . $matches[2];
		elseif (preg_match('#Edge( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = 'Edge ' . $matches[2];
		elseif (preg_match('#MicroMessenger/([a-zA-Z0-9.]+)#i', $ua, $matches)) 
			$browser = '微信 ' . $matches[1];
		elseif (preg_match('#Mobile MQQBrowser#i', $ua, $matches)) 
            $browser = '手机QQ ' . $matches[1];	
		elseif (preg_match('#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = 'Chrome ' . $matches[1];
		elseif (preg_match('#Chromium/([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = 'Chromium ' . $matches[1];
        elseif (preg_match('#XiaoMi/MiuiBrowser/([0-9.]+)#i', $ua, $matches)) 
            $browser = '小米浏览器 ' . $matches[1];
        elseif (preg_match('#Safari/([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = 'Safari ' . $matches[1];
        elseif (preg_match('#opera mini#i', $ua)) {
            preg_match('#Opera/([a-zA-Z0-9.]+)#i', $ua, $matches);
            $browser = 'Opera Mini ' . $matches[1];}
        elseif (preg_match('#Opera.([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = 'Opera ' . $matches[1];
        elseif (preg_match('#TencentTraveler ([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = '腾讯TT浏览器 ' . $matches[1];
		elseif (preg_match('#QQBrowser ([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = 'QQ浏览器 ' . $matches[1];
        elseif (preg_match('#UCWEB([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = 'UCWEB ' . $matches[1];
        elseif (preg_match('#wp-(iphone|android)/([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = 'WordPress客户端 ' . $matches[1];
        elseif (preg_match('#MSIE ([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = 'Internet Explorer ' . $matches[1];         
		elseif (preg_match('#Trident/([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = 'Internet Explorer 11';       		
		elseif (preg_match('#(Firefox|Phoenix|Firebird|BonEcho|GranParadiso|Minefield|Iceweasel)/([a-zA-Z0-9.]+)#i', $ua, $matches)) 
            $browser = 'Firefox ' . $matches[2];
        elseif(preg_match('/curl/i',$ua))
			$browser = 'curl';
		else 
            $browser = '未知浏览器';	
		
		//return $os . "  |  " . $browser;
		$prePath1=Helper::options()->themeUrl.'/img/ua/';
		$prePath2=$prePath1;
		$test1=$prePath1;
		$test2=$prePath2;
		//确定UA图片		
		if(strstr($os,'Vista')) 			$prePath1.='Vista'.'.png';
		elseif(strstr($os,'Windows 7')) 	$prePath1.= 'Windows7'.'.png';
		elseif(strstr($os,'Windows 8')) 	$prePath1.= 'Windows8'.'.png';
		elseif(strstr($os,'Windows 8.1'))	$prePath1.= 'Windows8.1'.'.png';
		elseif(strstr($os,'Windows 10'))	$prePath1.= 'Windows10'.'.png';
		elseif(strstr($os,'Windows XP'))	$prePath1.= 'WindowsXP'.'.png';
		elseif(strstr($os,'Windows 2000'))	$prePath1.= 'Windows2000'.'.png';
		elseif(strstr($os,'Android'))	$prePath1.= 'Android'.'.png';
		elseif(strstr($os,'iPhone'))	$prePath1.= 'ios'.'.png';
		elseif(strstr($os,'iPad'))	$prePath1.= 'ios'.'.png';
		elseif(strstr($os,'Mac'))	$prePath1.= 'Mac'.'.png';
		elseif(strstr($os,'Windows Phone'))	$prePath1.= 'WindowsPhone'.'.png';
		elseif(strstr($os,'Gentoo'))	$prePath1.= 'Gentoo'.'.png';
		elseif(strstr($os,'Ubuntu'))	$prePath1.= 'Ubuntu'.'.png';
		elseif(strstr($os,'Debian'))	$prePath1.= 'Debian'.'.png';
		elseif(strstr($os,'FreeBSD'))	$prePath1.= 'FreeBSD'.'.png';
		elseif(strstr($os,'SunOS')||strstr($os,'Solaris'))	$prePath1.= 'Sun'.'.png';
		elseif(strstr($os,'BlackBerry'))	$prePath1.= 'BlackBerry'.'.png';
		elseif(strstr($os,'Linux'))	$prePath1.= 'Linux'.'.png';
		else	$prePath1.= 'unknowOS'.'.png';
		//浏览器图片
		if(strstr($browser,'Camino')) 	$prePath2.= 'Camino'.'.png';
		elseif(strstr($browser,'搜狗浏览器')) 	$prePath2.= 'sogou'.'.png';
		elseif(strstr($browser,'360浏览器')) 	$prePath2.= '360'.'.png';
		elseif(strstr($browser,'Maxthon'))	$prePath2.= 'Maxthon'.'.png';
		elseif(strstr($browser,'Edge'))	$prePath2.= 'Edge'.'.png';
		elseif(strstr($browser,'微信'))	$prePath2.= 'weixin'.'.png';
		elseif(strstr($browser,'QQ'))	$prePath2.= 'QQ'.'.png';
		elseif(strstr($browser,'Chrome'))	$prePath2.= 'Chrome'.'.png';
		elseif(strstr($browser,'Chromium'))	$prePath2.= 'Chromium'.'.png';
		elseif(strstr($browser,'小米'))	$prePath2.= 'xiaomi'.'.png';
		elseif(strstr($browser,'Safari'))	$prePath2.= 'Safari'.'.png';
		elseif(strstr($browser,'Opera'))	$prePath2.= 'Opera'.'.png';
		elseif(strstr($browser,'腾讯TT浏览器'))	$prePath2.= 'tt'.'.png';
		elseif(strstr($browser,'QQ浏览器'))	$prePath2.= 'qqbrowser'.'.png';
		elseif(strstr($browser,'UCWEB'))	$prePath2.= 'ucweb'.'.png';
		elseif(strstr($browser,'Internet Explorer'))	$prePath2.= 'ie'.'.png';
		elseif(strstr($browser,'WordPress客户端'))	$prePath2.= 'wordpress'.'.png';
		elseif(strstr($browser,'Firefox'))	$prePath2.= 'firefox'.'.png';
		else	$prePath2.= 'unknowBrowser'.'.png';		
		//end
		if($isPic==0)
			return $os . "  |  " . $browser;
		elseif($isPic==1)
			//echo $prePath1.'  '.$prePath2;
			return '<img src="'.$prePath1.'"/>'.'<font  color=#ff6600>'.$os. "  |  " .'</font>'. 
				   '<img src="'.$prePath2.'"/>'.'<font  color=#ff6600>'.$browser.'</font>';
		else
			echo '出错了';

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
    $bgImg = new Typecho_Widget_Helper_Form_Element_Text('bgImg', null, $options->themeUrl('img/bg.jpg', 'GreenGrapes2'), _t('首页背景图片地址'), _t('在这里填入一个图片URL地址, 作为首页背景图片, 默认使用img下的header.png'));
    $form->addInput($bgImg);

    $headIcon = new Typecho_Widget_Helper_Form_Element_Text('headerIcon', null, $options->themeUrl('img/head.jpg', 'GreenGrapes2'), _t('首页头像地址'), _t('在这里填入一个图片URL地址, 作为首页头像, 默认使用images下的head.png'));
    $form->addInput($headIcon);
	
    $siteIcon = new Typecho_Widget_Helper_Form_Element_Text('sideName', null, null, _t('侧栏用户名'), _t('在这里填入一个左侧显示的用户名, 默认不显示'));
    $form->addInput($siteIcon);
	
	$siteCache = new Typecho_Widget_Helper_Form_Element_Text('cacheTime', null, '1209600', _t('缓存时间'), _t('头像缓存时间，默认1209600即14天'));
    $form->addInput($siteCache);
	
	$siteCreate = new Typecho_Widget_Helper_Form_Element_Text('createTime', null, '2016-12-23 13:59:00', _t('建站时间'), _t('填入形如2016-12-23 13:59:00，时间可以省略。如不填写，则默认为2016-12-23'));
    $form->addInput($siteCreate);
	
	$notFound = new Typecho_Widget_Helper_Form_Element_Radio(
        'notFoundGame', array ('1' => 'Chrome小恐龙', '2' => '小仓鼠'), '',
        '404游戏', '用于在404的时候展示的一款HTML5游戏！如不选择，则为默认动画');
    $form->addInput($notFound);
	
    $showBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('ShowBlock', array(
        'ShowPostBottomBar' => _t('文章页显示上一篇和下一篇')),
        array('ShowPostBottomBar'), _t('显示设置'));
    $form->addInput($showBlock->multiMode());
	
	$showUA = new Typecho_Widget_Helper_Form_Element_Select('showUA', array(
        'dontShow'=>'不显示UA',    
        'ShowUA' => '显示UA',
		'ShowUAPic' => '显示UA与图片',
    ), 'dontShow',
    _t('UA选项'), _t('默认不显示UA'));
    $form->addInput($showUA->multiMode());
	
	//up here
	
	$showBlogger = new Typecho_Widget_Helper_Form_Element_Checkbox('showBlogger', array(
        'ShowBloggerCheckBox' => _t('隐藏侧边栏博主回复')),
        array(''), _t('侧边博主回复'));
    $form->addInput($showBlogger->multiMode());
	
	$showThumb = new Typecho_Widget_Helper_Form_Element_Checkbox('showThumb', array(
        'ShowThumbPic' => _t('显示博文缩略图')),
        array('ShowThumbPic'), _t('主页博文缩略图设置'));
    $form->addInput($showThumb->multiMode());
	
	$showTypeFX = new Typecho_Widget_Helper_Form_Element_Checkbox('showTypeFX', array(
	'showTypeColorful' => _t('显示彩虹特效'),
	'showTypeShake' => _t('显示震动特效')),
    array('showTypeColorful'), _t('打字特效设置'));
    $form->addInput($showTypeFX->multiMode());

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
                //$comments->date($singleCommentOptions->dateFormat);Y-m-d H:i:s
				$comments->date('Y-m-d H:i:s');
                    $singleCommentOptions->afterDate(); ?></time>
					<!--UA设置的判定-->
<?php

if('dontShow'==Helper::options()->showUA)
	echo '';
elseif('ShowUA'==Helper::options()->showUA)
	echo '<font  color=#ff6600>'.getUA($comments->agent,0).'</font>';
elseif('ShowUAPic'==Helper::options()->showUA)
	//echo '<font  color=#ff6600>'.getUA($comments->agent,1).'</font>';
	echo getUA($comments->agent,1);
else
	echo '出错了';

?>

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
