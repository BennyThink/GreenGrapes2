<?php
date_default_timezone_set('Asia/Shanghai');

function themeConfig($form) {

	echo '<p style="font-size:14px;" id="use-intro">
    <span style="display: block;
    margin-bottom: 10px;
    margin-top: 10px;
    font-size: 16px;">感谢您使用 GreenGrapes2 主题</span>
    <span style="margin-bottom:10px;display:block">请关注 <a href="https://github.com/BennyThink/GreenGrapes2" target="_blank"
	style="color:#3384da;font-weight:bold;text-decoration:underline">GreenGrapes2</a> 以获得
	<span style="color:#df3827;font-weight:bold;">最新版本支持</span></span>
    <a href="mailto:benny@bennythink.com" >帮助&amp;支持</a> &nbsp;
    <a href="https://github.com/BennyThink/GreenGrapes2/issues" target="_blank">建议&amp;反馈</a>
    </p>';

	$options = Typecho_Widget::widget( 'Widget_Options' );

	$themeColor = new Typecho_Widget_Helper_Form_Element_Select( 'themeColor', array(
		'red'    => '幽红色',
		'blue'   => '深蓝色',
		'dark'   => '暗黑色',
		'purple' => '亮紫色',
		'yellow' => '淡黄色',
		'light'  => '轻蓝色',
		'green'  => '鲜绿色（默认、推荐）',
		'random'  => '随机主题色',
		'custom' => '自定义',
	), 'green',
		_t( '主题颜色选项；作者<a href="https://www.bennythink.com">（小土豆）</a><del>色盲</del>，所以推荐使用默认的鲜绿色主题' ),
		_t( '选择一个色调作为您网站的主色调，如果这里的色彩还不够，
		请选择自定义，然后设置下面的自定义色彩（需要设置四个自定义颜色值）' ) );
	$form->addInput( $themeColor->multiMode() );

	$color1 = new Typecho_Widget_Helper_Form_Element_Text( 'color1', null, null, _t( '主题颜色（请记得带#）' ), null );
	$form->addInput( $color1 );
	$color2 = new Typecho_Widget_Helper_Form_Element_Text( 'color2', null, null, _t( '次要颜色' ), '次要颜色一般要比主题颜色稍微淡一些' );
	$form->addInput( $color2 );
	$color3 = new Typecho_Widget_Helper_Form_Element_Text( 'color3', null, null, _t( '超链接颜色' ), null );
	$form->addInput( $color3 );
	$quote = new Typecho_Widget_Helper_Form_Element_Text( 'quote', null, null, _t( '块引用颜色' ), null );
	$form->addInput( $quote );

	$bgImg   = new Typecho_Widget_Helper_Form_Element_Text( 'bgImg', null, $options->themeUrl( 'img/bg.jpg', 'GreenGrapes2' ), _t( '首页背景图片地址' ), _t( '在这里填入一个图片URL地址, 作为首页背景图片, 默认使用img下的bg.png' ) );
	$form->addInput( $bgImg );

	$headIcon = new Typecho_Widget_Helper_Form_Element_Text( 'headerIcon', null, $options->themeUrl( 'img/head.jpg', 'GreenGrapes2' ), _t( '首页头像地址' ), _t( '在这里填入一个图片URL地址, 作为首页头像, 默认使用images下的head.png' ) );
	$form->addInput( $headIcon );

	$siteIcon = new Typecho_Widget_Helper_Form_Element_Text( 'sideName', null, null, _t( '侧栏用户名' ), _t( '在这里填入一个左侧显示的用户名, 默认不显示' ) );
	$form->addInput( $siteIcon );

	$siteCache = new Typecho_Widget_Helper_Form_Element_Text( 'cacheTime', null, '604800', _t( '缓存时间' ), _t( '头像缓存时间，默认604800即7天' ) );
	$form->addInput( $siteCache );

	$siteCreate = new Typecho_Widget_Helper_Form_Element_Text( 'createTime', null, '2016-12-23 13:59:00', _t( '建站时间' ), _t( '填入形如2016-12-23 13:59:00，时间可以省略。如不填写，则默认为2016-12-23' ) );
	$form->addInput( $siteCreate );

	$searchWord = new Typecho_Widget_Helper_Form_Element_Text( 'searchWord', null, '搜点什么呗', _t( '搜索框预留词' ), _t( '搜索框预留内容' ) );
	$form->addInput( $searchWord );

	$commentWord = new Typecho_Widget_Helper_Form_Element_Text( 'commentWord', null, '眼见何事，情系何处，身在何方，心思何人？', _t( '评论框预留词' ), _t( '留空则不显示' ) );
	$form->addInput( $commentWord );

	$dynamicTitle = new Typecho_Widget_Helper_Form_Element_Text( 'dynamicTitle', null, '喵 (●\'◡\'●)~快回来', _t( '动态标题' ), _t( '动态标题预留词语，留空则禁用此功能，默认为喵 (●\'◡\'●)~快回来' ) );
	$form->addInput( $dynamicTitle );

	$ShowWeather = new Typecho_Widget_Helper_Form_Element_Text( 'ShowWeather', null, '18000', _t( '天气预报缓存时间设置' ), _t( '天气预报缓存时间，设置为0、负数或留空则禁用此功能；默认为18000秒（5小时）' ) );
	$form->addInput( $ShowWeather );

	$EmailFeed = new Typecho_Widget_Helper_Form_Element_Text( 'EmailFeed', null, null, _t( '邮件订阅设置' ), _t( '邮件订阅地址，推荐使用<a href="https://www.feedburner.com/">Feed Burner</a>；留空则禁用' ) );
	$form->addInput( $EmailFeed );

	$TelegramChannel = new Typecho_Widget_Helper_Form_Element_Text( 'TelegramChannel', null, null, _t( 'Telegram频道' ), _t( '输入你的Telegram频道地址；留空则禁用' ) );
	$form->addInput( $TelegramChannel );

	$TelegramGroup = new Typecho_Widget_Helper_Form_Element_Text( 'TelegramGroup', null, null, _t( 'Telegram群' ), _t( '输入你的Telegram群地址；留空则禁用' ) );
	$form->addInput( $TelegramGroup );

	$wechatBR = new Typecho_Widget_Helper_Form_Element_Text( 'wechatBR', null, null, _t( '微信打赏设置' ),
        _t( '微信收款二维码；留空则禁用' ) );
	$form->addInput( $wechatBR );
	$alipayBR = new Typecho_Widget_Helper_Form_Element_Text( 'alipayBR', null, null, _t( '支付宝打赏设置' ),
        _t( '支付宝收款二维码；留空则禁用' ) );
	$form->addInput( $alipayBR );

	$clickNotify = new Typecho_Widget_Helper_Form_Element_Text( 'clickNotify', null,
        '快说 你 是不是 想我了', _t( '鼠标点击提示词' ),
		_t( '鼠标点击提示词，使用空格分隔，留空则禁用' ) );
	$form->addInput( $clickNotify );

	$notFound = new Typecho_Widget_Helper_Form_Element_Radio(
		'notFoundGame', array( '1' => 'Chrome小恐龙', '2' => 'MomoTheCat' ), '',
		'404游戏', '用于在404的时候展示的一款HTML5游戏！如不选择，那就有个彩蛋呗。' );
	$form->addInput( $notFound );

	$showUA = new Typecho_Widget_Helper_Form_Element_Select('showUA', array(
        'dontShow'=>'不显示UA',
        'ShowUA' => '显示UA',
		'ShowUAPic' => '显示UA与图片',
		'ShowOwner' => '为博主显示UA与图片',
    ), 'ShowOwner',
    _t('UA选项'), _t('默认为博主显示UA与图片'));
    $form->addInput($showUA->multiMode());

	$showArchive = new Typecho_Widget_Helper_Form_Element_Select('showArchive', array(
        'dontShow'=>'不显示归档',
        'ShowAll' => '显示全部文章列表',
		'ShowMonth' => '显示按月归档',
    ), 'ShowMonth',
    _t('侧栏文章归设置'), _t('默认为显示按月归档'));
    $form->addInput($showArchive->multiMode());

	$cursor = new Typecho_Widget_Helper_Form_Element_Select('cursor', array(
		'default'=>'默认鼠标指针',
		'cursor1' => '样式1',
		'cursor2' => '样式2',
	), 'cursor1',
		_t('鼠标指针设置'), _t('
<strong>样式1</strong>
    <img src="'.Helper::options()->themeUrl('extra/cursor/default1.cur','GreenGrapes2').'">
    <img src="'.Helper::options()->themeUrl('extra/cursor/pointer1.cur','GreenGrapes2').'">
<strong>样式2</strong>
    <img src="'.Helper::options()->themeUrl('extra/cursor/default2.cur','GreenGrapes2').'">
    <img src="'.Helper::options()->themeUrl('extra/cursor/pointer2.cur','GreenGrapes2').'">

' ));
	$form->addInput($cursor->multiMode());

	$SNSPos = new Typecho_Widget_Helper_Form_Element_Select('SNSPos', array(
		'showFooter'=>'仅页脚显示',
		'showSideBar' => '仅侧边显示',
		'showAll' => '侧边和页脚都显示',
	), 'showAll',
		_t('SNS显示位置'), _t('默认侧边和页脚均显示'));
	$form->addInput($SNSPos->multiMode());

	$Emotions = new Typecho_Widget_Helper_Form_Element_Select('Emotions', array(
		'offEmotions'=>'关闭表情',
		'CDNEmmotions' => '使用CDN表情源（已倒闭）',
		'LocalEmotions' => '使用本地表情源',
	), 'LocalEmotions',
		_t('主题表情设置'),
		_t('本功能将<trong>不会</strong>与similies插件共存。推荐使用本地表情源(CDN表情源已倒闭）<br>
    如果开启自带表情，建议到“设置-评论-允许使用的HTML标签和属性”中允许img标签，推荐如下：<br>
	&lt;blockquote&gt;&lt;pre&gt;&lt;code class=&quot;&quot;&gt;&lt;strong&gt;&lt;em&gt;&lt;h5&gt;&lt;h6&gt;&lt;a href title
	&gt;&lt;table&gt;&lt;thead&gt;&lt;tr&gt;&lt;th&gt;&lt;tbody&gt;&lt;td&gt;&lt;img src=&quot;&quot;&gt;<br>
	如果表情显示为img标签，请尝试重装或者是升级Typecho到开发版'));
	$form->addInput($Emotions->multiMode());

	$Snow = new Typecho_Widget_Helper_Form_Element_Select('Snow', array(
		'dontShow'=>'关闭下雪特效',
		'ShowAll' => '全部开启下雪特效',
		'ShowPC' => '仅移动设备关闭下雪特效',
	), 'ShowPC',
		_t('下雪特效设置'), _t('默认为仅移动设备关闭下雪特效'));
	$form->addInput($Snow->multiMode());

	$CommentsIP = new Typecho_Widget_Helper_Form_Element_Select('CommentsIP', array(
		'dontShow'=>'不显示',
		'ShowAll' => '为所有人显示',
		'ShowAllHide' => '为所有人显示（隐藏博主）',
		'ShowBlogger' => '仅博主显示',

	), 'dontShow',
		_t('评论者地理位置'), _t('默认为不显示，其中为所有人显示（隐藏博主）需要在下面的选项中输入博主的用户名（显示的名字，也就是screenName）'));
	$form->addInput($CommentsIP->multiMode());

	$username = new Typecho_Widget_Helper_Form_Element_Text( 'username', null, '',
        _t( '博主认证设置' ),
        _t( '请在这里输入你的用户名或者是任何想显示认证标志的用户名，以空格分隔' ) );
	$form->addInput( $username );

	$commentSwitch = new Typecho_Widget_Helper_Form_Element_Checkbox('commentSwitch',
		array(

			'code'   => _t( '代码' ),
			'bold' => _t( '加粗' ),
			'del'    => _t( '删除线' ),
			'italics' => _t( '斜体' ),
			'link' => _t( '链接' ),
			'sign' => _t( '签到' ),
		),
		array('code','bold','del','italics','link','sign'),
		_t('评论功能开关'),
		_t('设置评论框下面的按钮开关')
	);
	$form->addInput($commentSwitch->multiMode());

	$effect = new Typecho_Widget_Helper_Form_Element_Checkbox('effect',
		array(

			'KianaWidgets'   => _t( '开启kiana挂件' ),
			'TypeColorful' => _t( '显示打字彩虹特效（移动设备会自动关闭此特效）' ),
			'TypeShake'    => _t( '显示打字震动特效（移动设备会自动关闭此特效）' ),
			'RandomColor' => _t( '开启随机meta theme-color，有点辣眼睛' ),
			'canvas_three' => _t( '开启canvas_three特效' ),
			'canvas_lines' => _t( '开启canvas_lines特效' ),
			'baffle'    => _t( '开启baffle特效（就是会让标题先是乱码啊~）' ),
		),
		array('KianaWidgets','TypeColorful'),
		_t('特效功能开关'),
		_t('设置网站显示特效')
	);
	$form->addInput($effect->multiMode());

	$markdownExtendBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('markdownExtend',
        array(
            'enablePhonetic' => _t("添加 <code style='background-color: rgba(0, 0, 0, 0.071);color: #666;'>{{拼音 : pin yin}}</code> 语法解析注音"),
            'enableDeleteLine' => _t("添加 <code style='background-color: rgba(0, 0, 0, 0.071);color: #666;'>~~要加删除线的内容~~</code> 语法解析删除线, 你可以在必要的时候使用 <code style='background-color: rgba(0, 0, 0, 0.071);color: #666;'>\~</code> 转义以输出字符 <code style='background-color: rgba(0, 0, 0, 0.071);color: #666;'>~</code>"),
            'enableHighlightText' => _t("添加 <code style='background-color: rgba(0, 0, 0, 0.071);color: #666;'>==要高亮显示的内容==</code> 语法解析高亮 (荧光笔效果), 你可以在必要的时候使用 <code style='background-color: rgba(0, 0, 0, 0.071);color: #666;'>\=</code> 转义以输出字符 <code style='background-color: rgba(0, 0, 0, 0.071);color: #666;'>=</code>"),
        ),
        array('enablePhonetic','enableHighlightText'), _t('Markdown 语法扩展'),
        _t('扩展markdown语法'));
    $form->addInput($markdownExtendBlock->multiMode());

	$switch = new Typecho_Widget_Helper_Form_Element_Checkbox('switch',
		array(
			'Pangu'             => _t( '引用 Pangu.js 实现中英文间自动添加空格' ),
			'ShowBreadCrumb'    => _t( '显示面包屑' ),
			'ShowPostBottomBar' => _t( '文章页显示上一篇和下一篇' ),
			'ShowLinksIcon'     => _t( '友情链接显示favicon（此功能有时会获取失败，比如说防盗链的网站、被墙网站）' ),
			'EnableNetease' => _t( '开启网易云音乐支持，在文章中使用<code>{{音乐id}}</code>添加音乐（不自动播放）' ),
			'EnableNotice'  => _t( '开启来路提示功能' ),
			'ShowFortunes'  => _t( '显示动态格言' ),
			'EnableHide'    => _t( '开启回复可见功能，在文章中使用<code>[hide]隐藏内容[/hide]</code>' ),
			'EnableSlimbox' => _t( '开启Slimbox2灯箱' ),
			'SmoothScroll'        => _t( '平滑滚动效果——让你的Chrome醋溜到底吧！' ),
			'atargetblank'        => _t( '链接以新标签页形式打开' ),
			'ShowBloggerCheckBox' => _t( '隐藏侧边栏博主回复' ),
			'ShowThumbPic'        => _t( '显示博文缩略图' ),
			'EnableCompress'    => _t( '开启压缩HTML代码功能，对性能略有提升' ),
			'EnableCopyright'   => _t( '开启复制版权提示' ),
			'RandomGravatar'   => _t( '无gravatar随机头像' ),
			'PostMagic'   => _t( '新文章显示new图片，如不选择，则显示魔术棒' ),
			'TOC'   => _t( '显示目录' ),

		),
		array('Pangu','ShowBreadCrumb','ShowPostBottomBar','ShowLinksIcon',
			'EnableNetease','EnableNotice','ShowFortunes',
			'EnableHide','EnableSlimbox','RandomGravatar'),
		_t('杂项功能开关'),
		_t('插入视频请使用iframe语法')
	);
	$form->addInput($switch->multiMode());

	$TwitterURL = new Typecho_Widget_Helper_Form_Element_Text('TwitterURL', null, null, _t('Twitter 地址，留空则不显示,下同'), null);
    $form->addInput($TwitterURL);
    $FacebookURL = new Typecho_Widget_Helper_Form_Element_Text('FacebookURL', null, null, _t('Facebook 地址'), null);
    $form->addInput($FacebookURL);
    $GooglePlusURL = new Typecho_Widget_Helper_Form_Element_Text('GooglePlusURL', null,null, _t('Google+ 地址'), null);
    $form->addInput($GooglePlusURL);
    $WeiboURL = new Typecho_Widget_Helper_Form_Element_Text('WeiboURL', null, null, _t('新浪微博地址'), null);
    $form->addInput($WeiboURL);
    $InstagramURL = new Typecho_Widget_Helper_Form_Element_Text('InstagramURL', null, null, _t('Instagram 地址'), null);
    $form->addInput($InstagramURL);
    $GithubURL = new Typecho_Widget_Helper_Form_Element_Text('GithubURL', null, null, _t('Github 地址'), null);
    $form->addInput($GithubURL);
    $TelegramURL = new Typecho_Widget_Helper_Form_Element_Text('TelegramURL', null, null, _t('Telegram 用户名'), null);
    $form->addInput($TelegramURL);
	$QQURL = new Typecho_Widget_Helper_Form_Element_Text('QQURL', null, null, _t('QQ号'), null);
    $form->addInput($QQURL);
	$weixinSAURL = new Typecho_Widget_Helper_Form_Element_Text('weixinSAURL', null, null, _t('微信公众号（暂只支持公众号）'), null);
    $form->addInput($weixinSAURL);

    $motto = new Typecho_Widget_Helper_Form_Element_Textarea('motto', NULL,NULL,
        _t('个性签名设置'),
        _t('此处输入的文字将出现版权信息的上面，作为个性签名。如不填写则不显示。
如果在此处直接填入纯文本，那么将以默认的样式显示；如果使用自定的CSS，那么将以自定的模式显示。
请注意，如果使用自定CSS，需要将整个代码用!@包围，如<code>!@&lt;strong&gt;粗体&lt;strong&gt;!@</code>'));
    $form->addInput($motto);

	$copyright = new Typecho_Widget_Helper_Form_Element_Textarea('copyright', NULL,NULL,
	_t('文章底部版权信息设置'),
	_t('此处输入的文字将出现在每篇文章最底部.<br>
	{{title}}表示文章标题，{{link}}表示文章链接,
	{{name}}表示作者名字，{{homepage}}表示作者主页<br>
	使用HTML语法，如不填写则为默认样式，使用帮助<a href="https://github.com/BennyThink/GreenGrapes2">请戳我</a>'));
    $form->addInput($copyright);

	$footer = new Typecho_Widget_Helper_Form_Element_Textarea('footer',NULL,NULL,
	_t('页脚footer代码'), _t('填入页脚footer，支持HTML，比如说备案号。如不需要则留空'));
	$form->addInput($footer);

    $tongJi = new Typecho_Widget_Helper_Form_Element_Textarea('tongJi', NULL, NULL, _t('站点统计代码'),
	_t('在这里可以填入百度统计、cnzz、Google Analytics等统计代码，只对非登录用户起作用<br>
某童鞋也许可以尝试使用旧域名，认证信息你懂的。'));
    $form->addInput($tongJi);

	$SidebarTool1 = new Typecho_Widget_Helper_Form_Element_Textarea( 'SidebarTool1', null, null, _t( '侧边小工具' ),
		_t( '侧边小工具代码，可以使用HTML（放个小广告什么的），默认加载到网站统计上面，留空则禁用。使用方法：<br>
第一行：Font Awesome图标编号，如fa-moon-o，参考<a href="https://www.thinkcmf.com/font/font_awesome/icons.html">这里</a><br>
第二行：侧边栏标题，可以使用HTML<br>
第三行：侧边栏内容，可以使用HTML' ) );
	$form->addInput( $SidebarTool1 );

    $MemorialDay = new Typecho_Widget_Helper_Form_Element_Textarea('MemorialDay',NULL,
    '06-04 What is dead may never die.|
05-08 I have no enemies, and no hatred.|',
        _t('纪念日设置'), _t("每年固定时间开启黑白模式缅怀逝去的生命，默认开启06-04和07-13。留空则为禁用<br>
        每个纪念日使用管道符|分隔，纪念日与描述信息使用空格分隔，支持如下三种模式：<br>
        03-12 描述信息1|<br>
        03-11|<br>
        03-10 ".htmlspecialchars('<a href="http://www.z.cn" target="_blank">说明链接</a>').'|'));
    $form->addInput($MemorialDay);

	$links = new Typecho_Widget_Helper_Form_Element_Textarea('links',NULL,NULL,
	_t('友链样式的HTML代码'), _t('填入你的HTML代码，A标签即可，每行使用回车结尾，<strong>url结尾请不要带/</strong>。示例：<br>
	1. &lt;a href="https://www.bennythink.com"&gt;土豆不好吃&lt;/a&gt;<br>
	2. &lt;a href="https://www.bennythink.com"&gt;&lt;img src="https://www.bennythink.com/favicon.ico" width="16"/&gt;土豆不好吃&lt;/a&gt;<br>
	<strong>仅在上面“友情链接显示favicon”关闭之后可以使用语法2</strong><br>
	如果安装了Links插件，此项将不会生效<br>
	请注意，<strong>切换主题之后此项将会被清空</strong>，请谨慎操作'));
	$form->addInput($links);

    //代码高亮设置
    $SHTheme = new Typecho_Widget_Helper_Form_Element_Select('SHTheme', array(
        'Close' => '关闭代码高亮',
        'Default' => 'Default',
        'Django' => 'Django',
        'Eclipse' => 'Eclipse',
        'Emacs' => 'Emacs',
        'Benny' => 'Benny',
        'Moon' => 'Moon',
        'FadeToGrey' => 'FadeToGrey',
        'MDUltra' => 'MDUltra',
        'Midnight' => 'Midnight',
        'RDark' => 'RDark'), 'Default', _t('/**  代码高亮设置开始 **/<br>代码高亮主题'),
        _t('选择一个你喜欢的高亮主题，如果关闭代码高亮，下面的设置都不会生效'));
    $form->addInput($SHTheme->multiMode());

    $collapse = new Typecho_Widget_Helper_Form_Element_Checkbox('collapse', array('collapse' => '折叠代码'), NULL, _t('代码折叠'), _t('是否自动折叠代码，点击时展开（开启时，请同时开启显示工具栏，不然代码无法显示）'));
    $form->addInput($collapse);

    $codeFormat = new Typecho_Widget_Helper_Form_Element_Checkbox('codeFormat', array('gutter' => '显示行号',
        'auto-links' => '链接关键字文档',
        'smart-tabs' => '智能缩进'
    ), array('gutter',
        'auto-links'
    ), _t('格式设置'), _t('默认显示行号、自动链接关键字文档、关闭智能缩进。'));
    $form->addInput($codeFormat->multiMode());

    $tabSize = new Typecho_Widget_Helper_Form_Element_Text('tabSize', NULL, 4, _t('<TAB>缩进宽度'), _t('输入代码<TAB>缩进时占几个空格的宽度，建议2、4、8等值，默认占4个空格。'));
    $form->addInput($tabSize);

    $toolbar = new Typecho_Widget_Helper_Form_Element_Checkbox('toolbar', array('toolbar' => '显示工具栏'),
        NULL, _t('工具栏设置'), _t('设置是否显示代码块右上角的工具栏，默认不显示。<br>/** 代码高亮设置结束 **/ '));
    $form->addInput($toolbar);


    $themeUpdate = new Typecho_Widget_Helper_Form_Element_Checkbox('themeUpdate', array(
        'themeAutoUpdate' => _t('开启自动更新检查')),
        array('themeAutoUpdate'), _t('主题自动更新检查'),_t('当您进入设置的时候，主题将会自动查询新版本（但是不会更新）'));
    $form->addInput($themeUpdate->multiMode());

}

/**
 * 添加目录
 * @param $cont
 *
 * @return mixed|string
 */
function toc_parse($cont){

	$matches = array();
	$ul_li   = '';
	$r       = "/<h2>(.*?)<\/h2>/im";
	if (  preg_match_all( $r, $cont, $matches ) ) {
		foreach ( $matches[1] as $num => $title ) {
			$title   = trim( strip_tags( $title ) );
			$cont = str_replace( $matches[0][ $num ], '<h2 id="title-' . $num . '">' . $title . '</h2>', $cont );
			$ul_li   .= '🌙 <a href="#title-' . $num . '">' . $title . "</a><br>\n";
		}
		$cont = '<div id="article-index">
                            <strong>文章目录<a id="content-index-togglelink" href="javascript:toggleToc()" class="hidetoc">[显示]</a></strong>
                            <ul id="index-ul">' . $ul_li . '</ul>
                        </div>' . $cont;
	}

	return $cont;


}

/**
 * 压缩HTML代码
 * @param $html_source
 *
 * @return string
 */
function compressHtml( $html_source ) {
	$chunks   = preg_split( '/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, - 1, PREG_SPLIT_DELIM_CAPTURE );
	$compress = '';
	foreach ( $chunks as $c ) {
		if ( strtolower( substr( $c, 0, 19 ) ) == '<!--<nocompress>-->' ) {
			$c        = substr( $c, 19, strlen( $c ) - 19 - 20 );
			$compress .= $c;
			continue;
		} else if ( strtolower( substr( $c, 0, 12 ) ) == '<nocompress>' ) {
			$c        = substr( $c, 12, strlen( $c ) - 12 - 13 );
			$compress .= $c;
			continue;
		} else if ( strtolower( substr( $c, 0, 4 ) ) == '<pre' || strtolower( substr( $c, 0, 9 ) ) == '<textarea' ) {
			$compress .= $c;
			continue;
		} else if ( strtolower( substr( $c, 0, 7 ) ) == '<script' && strpos( $c, '//' ) != false && ( strpos( $c, "\r" ) !== false || strpos( $c, "\n" ) !== false ) ) {
			$tmps = preg_split( '/(\r|\n)/ms', $c, - 1, PREG_SPLIT_NO_EMPTY );
			$c    = '';
			foreach ( $tmps as $tmp ) {
				if ( strpos( $tmp, '//' ) !== false ) {
					if ( substr( trim( $tmp ), 0, 2 ) == '//' ) {
						continue;
					}
					$chars   = preg_split( '//', $tmp, - 1, PREG_SPLIT_NO_EMPTY );
					$is_quot = $is_apos = false;
					foreach ( $chars as $key => $char ) {
						if ( $char == '"' && $chars[ $key - 1 ] != '\\' && ! $is_apos ) {
							$is_quot = ! $is_quot;
						} else if ( $char == '\'' && $chars[ $key - 1 ] != '\\' && ! $is_quot ) {
							$is_apos = ! $is_apos;
						} else if ( $char == '/' && $chars[ $key + 1 ] == '/' && ! $is_quot && ! $is_apos ) {
							$tmp = substr( $tmp, 0, $key );
							break;
						}
					}
				}
				$c .= $tmp;
			}
		}
		$c        = preg_replace( '/[\\n\\r\\t]+/', ' ', $c );
		$c        = preg_replace( '/\\s{2,}/', ' ', $c );
		$c        = preg_replace( '/>\\s</', '> <', $c );
		$c        = preg_replace( '/\\/\\*.*?\\*\\//i', '', $c );
		$c        = preg_replace( '/<!--[^!]*-->/', '', $c );
		$compress .= $c;
	}
	$initial=strlen($html_source);
	$final=strlen($compress);
	$savings=($initial-$final)/$initial*100;
	$savings=round($savings, 2);
	$compress.="\n<!--压缩前的大小: $initial bytes; 压缩后的大小: $final bytes; 节约：$savings% -->\n";
	return $compress;
}

/**
 * 随机名言
 * @return string
 */
function randomFortunes() {

    $data=json_decode(file_get_contents(Helper::options()->themeUrl( 'js/fortunes.json', 'GreenGrapes2' )),true);
    //总计183行

    return $data[rand( 0,182)]['content'];

}

/**
 * 设置cookies，返回天气预报
 * @return string
 */
function isNew()
{
    if (!Typecho_Cookie::get('view')) {
        $weatherInfo = weather();
        Typecho_Cookie::set('view', '1',time()+Helper::options()->ShowWeather, Helper::options()->siteUrl);
        Typecho_Cookie::set('weather', $weatherInfo, time()+Helper::options()->ShowWeather, Helper::options()->siteUrl);
        return $weatherInfo;
    } else
        return Typecho_Cookie::get('weather');
}

/**
 * 查询天气预报
 * @return bool|string
 */
function weather(){

    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
	if ( $realip == '127.0.0.1' )
		return '本地测试就不要查天气预报啦😊';
    //在线IP库
    $url = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $realip;
    $ip = json_decode(file_get_contents($url));
    if ((string)$ip->code == '1') {
        return false;
    }
	$data=$ip->data->city;

    if(empty($data))
        return '对不起，未能查询到天气';
    else{
    $cityUrl = Helper::options()->themeUrl('js/city.json','GreenGrapes2');
    $web = json_decode(file_get_contents($cityUrl));
    $arr = array();
    foreach ($web as $k => $w) {
        if (is_object($w)) $arr[$k] = json_to_array($w); //判断类型是不是object
        else $arr[$k] = $w;
    }

    $url = "http://wthrcdn.etouch.cn/weather_mini?citykey=" . $arr[$data];
    $weather = json_decode(file_get_contents("compress.zlib://" . $url), true);
    return '城市：' . $weather['data']['city'] . '<br>' .
        ' 今日天气：' . $weather['data']['forecast'][0]['type'] . '  ' .
        $weather['data']['forecast'][0]['high'] . '  ' .
        $weather['data']['forecast'][0]['low'] . '  ' .
        $weather['data']['forecast'][0]['fengxiang'] . $weather['data']['forecast'][0]['fengli'] .
        '<br>' .
        '明日天气：' . $weather['data']['forecast'][1]['type'] . '  ' .
        $weather['data']['forecast'][1]['high'] . '  ' .
        $weather['data']['forecast'][1]['low'] . '  ' .
        $weather['data']['forecast'][1]['fengxiang'] . $weather['data']['forecast'][1]['fengli'] .
        '<br>' .
        '后天天气：' . $weather['data']['forecast'][2]['type'] . '  ' .
        $weather['data']['forecast'][2]['high'] . '  ' .
        $weather['data']['forecast'][2]['low'] . '  ' .
        $weather['data']['forecast'][2]['fengxiang'] . $weather['data']['forecast'][1]['fengli'];
    //return $weatherInfo;
    }
}

/**
 * 下雪特效
 */
function snow_display(){
	if ( ! isset( $_COOKIE['snow'] ) ) {
		$jsUrl  = Helper::options()->themeUrl( 'js/three.js', 'GreenGrapes2' );
		$imgUrl = Helper::options()->themeUrl( 'img/Snow1.png', 'GreenGrapes2' );
		echo '<script type="text/javascript" src="' . $jsUrl . '"></script>' . "\n";
		echo '<script type="text/javascript">
		function randomRange(t,i){return Math.random()*(i-t)+t}Particle3D=function(t){THREE.Particle.call(this,t),this.velocity=new THREE.Vector3(0,-6,0),this.velocity.rotateX(randomRange(-45,45)),this.velocity.rotateY(randomRange(0,360)),this.gravity=new THREE.Vector3(0,-0,0),this.drag=1},Particle3D.prototype=new THREE.Particle,Particle3D.prototype.constructor=Particle3D,Particle3D.prototype.updatePhysics=function(){this.velocity.multiplyScalar(this.drag),this.velocity.addSelf(this.gravity),this.position.addSelf(this.velocity)};var TO_RADIANS=Math.PI/180;THREE.Vector3.prototype.rotateY=function(t){cosRY=Math.cos(t*TO_RADIANS),sinRY=Math.sin(t*TO_RADIANS);var i=this.z,o=this.x;this.x=o*cosRY+i*sinRY,this.z=o*-sinRY+i*cosRY},THREE.Vector3.prototype.rotateX=function(t){cosRY=Math.cos(t*TO_RADIANS),sinRY=Math.sin(t*TO_RADIANS);var i=this.z,o=this.y;this.y=o*cosRY+i*sinRY,this.z=o*-sinRY+i*cosRY},THREE.Vector3.prototype.rotateZ=function(t){cosRY=Math.cos(t*TO_RADIANS),sinRY=Math.sin(t*TO_RADIANS);var i=this.x,o=this.y;this.y=o*cosRY+i*sinRY,this.x=o*-sinRY+i*cosRY};$(function(){var container=document.querySelector(".Snow");if(/MSIE 6|MSIE 7|MSIE 8/.test(navigator.userAgent)){return}else{if(/MSIE 9|MSIE 10/.test(navigator.userAgent)){$(container).css("height",$(window).height()).bind("click",function(){$(this).fadeOut(1000,function(){$(this).remove()})})}}var containerWidth=$(container).width();var containerHeight=$(container).height();var particle;var camera;var scene;var renderer;var mouseX=0;var mouseY=0;var windowHalfX=window.innerWidth/2;var windowHalfY=window.innerHeight/2;var particles=[];var particleImage=new Image();particleImage.src="' . $imgUrl . '";var snowNum=300;function init(){camera=new THREE.PerspectiveCamera(75,containerWidth/containerHeight,1,10000);camera.position.z=1000;scene=new THREE.Scene();scene.add(camera);renderer=new THREE.CanvasRenderer();renderer.setSize(containerWidth,containerHeight);var material=new THREE.ParticleBasicMaterial({map:new THREE.Texture(particleImage)});for(var i=0;i<snowNum;i++){particle=new Particle3D(material);particle.position.x=Math.random()*2000-1000;particle.position.y=Math.random()*2000-1000;particle.position.z=Math.random()*2000-1000;particle.scale.x=particle.scale.y=1;scene.add(particle);particles.push(particle)}container.appendChild(renderer.domElement);document.addEventListener("mousemove",onDocumentMouseMove,false);setInterval(loop,1000/40)}function onDocumentMouseMove(event){mouseX=event.clientX-windowHalfX;mouseY=event.clientY-windowHalfY}function loop(){for(var i=0;i<particles.length;i++){var particle=particles[i];particle.updatePhysics();with(particle.position){if(y<-1000){y+=2000}if(x>1000){x-=2000}else{if(x<-1000){x+=2000}}if(z>1000){z-=2000}else{if(z<-1000){z+=2000}}}}camera.position.x+=(mouseX-camera.position.x)*0.005;camera.position.y+=(-mouseY-camera.position.y)*0.005;camera.lookAt(scene.position);renderer.render(scene,camera)}init()});</script>' . "\n";
		echo '<div id="Snow" class="Snow"></div>' . "\n";
	}
}

/**
 * 欢迎信息
 */
function welcome_hello() {
	$referer     = $_SERVER["HTTP_REFERER"];
	$refererhost = parse_url( $referer );
	$host        = strtolower( $refererhost['host'] );
	$ben         = $_SERVER['HTTP_HOST'];
	$callback    = "HELLO！欢迎来自<strong>" . $host . "</strong>的朋友！";

	if ( $referer == "" || $referer == null ) {
		if ( ! Typecho_Cookie::get( 'firstView' ) ) {
			Typecho_Cookie::set( 'firstView', '1', 0, Helper::options()->siteUrl );
			$callback = "欢迎您访问我的博客~  我倍感荣幸啊 嘿嘿";
		} else {
			$callback = "您直接访问了本站!  莫非您记住了我的<strong>域名</strong>.厉害~  我倍感荣幸啊 嘿嘿";
		}
	} elseif ( strstr( $ben, $host ) ) {
		$callback = "host";
	} elseif ( preg_match( '/bennythink.*/i', $host ) ) {
		$callback = '您通过 <strong>小土豆</strong> 找到了我，一定很不一般噢！';
	} elseif ( preg_match( '/baiducontent.*/i', $host ) ) {
		$callback = '您通过 <strong>百度快照</strong> 找到了我，厉害！';
	} elseif ( preg_match( '/baidu.*/i', $host ) ) {
		$callback = '您通过 <strong>百度</strong> 找到了我，厉害！';
	} elseif ( preg_match( '/so.*/i', $host ) ) {
		$callback = '您通过 <strong>好搜</strong> 找到了我，厉害！';
	} elseif ( ! preg_match( '/www\.google\.com\/reader/i', $referer ) && preg_match( '/google\./i', $referer ) ) {
		$callback = '您居然通过 <strong>Google</strong> 找到了我! 一定是个技术宅吧!';
	} elseif ( preg_match( '/search\.yahoo.*/i', $referer ) || preg_match( '/yahoo.cn/i', $referer ) ) {
		$callback = '您通过 <strong>Yahoo</strong> 找到了我! 厉害！';
	} elseif ( preg_match( '/cn\.bing\.com\.*/i', $referer ) || preg_match( '/yahoo.cn/i', $referer ) ) {
		$callback = '您通过 <strong>Bing</strong> 找到了我! 厉害！';
	} elseif ( preg_match( '/google\.com\/reader/i', $referer ) ) {
		$callback = "感谢你通过 <strong>Google</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
	} elseif ( preg_match( '/xianguo\.com\/reader/i', $referer ) ) {
		$callback = "感谢你通过 <strong>鲜果</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
	} elseif ( preg_match( '/zhuaxia\.com/i', $referer ) ) {
		$callback = "感谢你通过 <strong>抓虾</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
	} elseif ( preg_match( '/inezha\.com/i', $referer ) ) {
		$callback = "感谢你通过 <strong>哪吒</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
	} elseif ( preg_match( '/reader\.youdao/i', $referer ) ) {
		$callback = "感谢你通过 <strong>有道</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
		//自己
	}
	if ( $callback != "host" )//排除本地访问
	{
		echo "<script>notie('info', '$callback', true);</script>";
	}
}

//自动更新执行
if(!empty(Helper::options()->themeUpdate) && in_array('themeAutoUpdate', Helper::options()->themeUpdate))
	autoUpdate();

/**
 * 自动更新
 */
function autoUpdate() {
    if(!strpos( $_SERVER['PHP_SELF'], '/admin/options-theme.php' ))
        return;
    else {
	    define( 'UPDATE_VERSION', 'https://raw.githubusercontent.com/BennyThink/GreenGrapes2/master/version.txt' );
	    $localVersion    = fopen( Helper::options()->themeUrl( 'version.txt', 'GreenGrapes2' ), "r" );
	    $localVersionNum = fgets( $localVersion );
	    fclose( $localVersion );
	    $remoteVersion    = fopen( UPDATE_VERSION, "r" );
	    $remoteVersionNum = fgets( $remoteVersion );
	    fclose( $remoteVersion );

	    if ( $localVersionNum < $remoteVersionNum ) {
		    echo '<style>.yunluotips {
            border: 2px solid #FFCC33;
            padding: 15px
        }</style>';
		    echo '<div class="yunluotips">' . "当前版本 $localVersionNum" .
		         "，最新版本 $remoteVersionNum<br>" .
		         "请<a href='https://github.com/BennyThink/GreenGrapes2'>戳我</a>获得最新更新" . '</div>';
	    }
    }

}


/**
 * Test if the current browser runs on a mobile device (smart phone, tablet, etc.)
 *
 * @return bool
 */
function isMobile() {
	if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
		$is_mobile = false;
	} elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
	           || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
	           || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
	           || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
	           || strpos($_SERVER['HTTP_USER_AGENT'], 'arm') !== false
	           || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
	           || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
	           || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
		$is_mobile = true;
	} else {
		$is_mobile = false;
	}

	return $is_mobile;
}

/**
 * 返回缩略图
 * @param $cid 文章ID
 *
 * @return string 图片url
 */
function thumb( $cid ) {

	$rand_num = 12; //随机图片数量，根据图片目录中图片实际数量设置

	$db  = Typecho_Db::get();
	$rs  = $db->fetchRow( $db->select( 'table.contents.text' )
	                         ->from( 'table.contents' )
	                         ->where( 'table.contents.type = ?', 'attachment' )
	                         ->where( 'table.contents.parent= ?', $cid )
	                         ->order( 'table.contents.cid', Typecho_Db::SORT_ASC )
	                         ->limit( 1 ) );
	//echo '<img  src="' . $imgurl . '" />';
	if ( empty( $rs ) ) {
		return Helper::options()->themeUrl( 'img/bg/', 'GreenGrapes2' ) . rand( 0, $rand_num - 1 ) . ".jpg";
	} else {
        //有图
		$img     = unserialize( $rs['text'] );
		$imgPath = substr( Helper::options()->siteUrl, 0, strlen( Helper::options()->siteUrl ) - 1 ) . $img['path'];//有图
		return $imgPath;
	}
}


/**
 * 加载时间
 * @return bool
 */
function timer_start() {
	global $timestart;
	$mtime     = explode( ' ', microtime() );
	$timestart = $mtime[1] + $mtime[0];

	return true;
}

timer_start();

function timer_stop( $display = 0, $precision = 3 ) {
	global $timestart, $timeend;
	$mtime     = explode( ' ', microtime() );
	$timeend   = $mtime[1] + $mtime[0];
	$timetotal = number_format( $timeend - $timestart, $precision );
	$r         = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
	if ( $display ) {
		echo $r;
	}

	return $r;
}

/**
* 判断时间区间
* <?php if(timeZone($this->date->timeStamp)) echo ' new'; ?>
* 使用方法  if(timeZone($this->date->timeStamp)) echo 'ok';
*/
function timeZone( $from ) {
	$now = new Typecho_Date( Typecho_Date::gmtTime() );

	return $now->timeStamp - $from < 24 * 60 * 60 ? true : false;
}

/**
 * 字数统计
 * @param $cid 文章ID
 */
function art_count( $cid ) {
	$db   = Typecho_Db::get();
	$rs   = $db->fetchRow( $db->select( 'table.contents.text' )->from( 'table.contents' )->where( 'table.contents.cid=?', $cid )->order( 'table.contents.cid', Typecho_Db::SORT_ASC )->limit( 1 ) );
	$text = preg_replace( "/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text'] );
	echo mb_strlen( $text, 'UTF-8' );
}

/**
 * 建站时间
 */
function getBuildTime() {
// 在下面按格式输入本站创建的时间
	if ( empty( Helper::options()->createTime ) )
		$ct = '2016-12-23 13:59:00';
    else
		$ct = Helper::options()->createTime;

	$site_create_time = strtotime( $ct );
	$time             = time() - $site_create_time;
	$time             = floor( $time / 86400 );
	echo '<span class="time">' . '本站已经建立' . $time . '天啦!' . '</span>';
}

/**
 * 访问量
 * @param $archive 文章ID
 */
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
 * 头像系统：先QQ、再gravatar、最后是默认的
 * @param $email 评论者邮箱
 *
 * @return string 头像的img标签
 */
function avatar( $email ) {
	$yourUrl  = Helper::options()->siteUrl;
	$saveNameJpg = 'usr/themes/GreenGrapes2/avatarCache/' . md5( strtolower( trim( $email ) ) ) . '.jpg';
	$saveNamePng = 'usr/themes/GreenGrapes2/avatarCache/' . md5( strtolower( trim( $email ) ) ) . '.png';
	clearstatcache();
	if ( empty( Helper::options()->cacheTime ) ) {
		$ct = 604800;
	} else {
		$ct = Helper::options()->cacheTime;
	}

	if ( strpos( $email, "@qq.com" ) ) {
		//如果是QQ邮箱的话，测试缓存策略
		if ( file_exists( $saveNameJpg ) && ( time() - filemtime( $saveNameJpg ) ) < $ct ) {
			return '<img class="avatar" src="' . $yourUrl . $saveNameJpg . '" />';
		} else {
			$qqimg  = 'https://q.qlogo.cn/g?b=qq&nk='.$email.'&s=100';
			//保存图片
			copy( $qqimg, $saveNameJpg );
			return '<img class="avatar" src="' . $yourUrl . $saveNameJpg . '" />';
		}
	} elseif ( file_exists( $saveNameJpg ) && ( time() - filemtime( $saveNameJpg ) ) < $ct ) {
		//返回未超时的gravatar、已有缓存
		return '<img class="avatar" src="' . $yourUrl . $saveNameJpg . '" />';
	} else {
		//获取新的gravatar，并判断
		$headers = @get_headers( 'https://www.gravatar.com/avatar/' . md5( strtolower( trim( $email ) ) ) . '?d=404' );
		if ( preg_match( "/404/", $headers[0] ) ) {
			if ( ! empty( Helper::options()->switch ) && in_array( 'RandomGravatar', Helper::options()->switch ) ) {
				// This code is a pile of shit!!
				if ( file_exists( $saveNamePng ) && ( time() - filemtime( $saveNamePng ) ) < $ct ) {
					return '<img class="avatar" src="' . $yourUrl . $saveNamePng . '" />';
				} else {
					//开启随机头像
					$index = rand( 1, 25 );
					copy( $yourUrl . 'usr/themes/GreenGrapes2/img/gravatar/' . $index . '.png', $saveNamePng );
					return '<img class="avatar" src="' . $yourUrl . 'usr/themes/GreenGrapes2/img/gravatar/' . $index . '.png" />';
				}
			} else {
				//未开启随机头像 无头像，应该拷贝头像
				copy( $yourUrl . 'usr/themes/GreenGrapes2/img/gravatar/0.jpg', $saveNameJpg );

				return '<img class="avatar" src="' . $yourUrl . 'usr/themes/GreenGrapes2/img/gravatar/0.jpg" />';
			}
		} else {
			//有gravatar
			copy( 'https://www.gravatar.com/avatar/' . md5( strtolower( trim( $email ) ) ), $saveNameJpg );
			return '<img class="avatar" src="' . $yourUrl . $saveNameJpg . '" />';
		}

	}

}

/**
 * 根据UA解析操作系统与浏览器
 * @param $ua 访客的UA
 * @param $isPic 是否显示图片
 *
 * @return string img标签
 */
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
		elseif (preg_match('#QQ/([a-zA-Z0-9.]+)#i', $ua, $matches))
            $browser = '手机QQ ' . $matches[1];
		elseif (preg_match('#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches))
            $browser = 'Chrome ' . $matches[1];
        elseif (preg_match('#CriOS/([a-zA-Z0-9.]+)#i', $ua, $matches))
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
		//$test1=$prePath1;
		//$test2=$prePath2;
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

/**
 * 自定义渲染替换
 * @param $content 文章输出
 *
 * @return string 渲染替换之后的内容
 */
function render($content) {
    $replaceStartIndex = array();
    $replaceEndIndex = array();
    $currentReplaceId = 0;
    $replaceIndex = 0;
    $searchIndex = 0;
    $searchCloseTag = false;
    $contentLength = strlen($content);
    while (true) {
        if ($searchCloseTag) {
            $tagName = substr($content, $searchIndex, 4);
            if ($tagName == "<cod") {
                $searchIndex = strpos($content, '</code>', $searchIndex);
                if (!$searchIndex) {
                    break;
                }
                $searchIndex += 7;
            } elseif ($tagName == "<pre") {
                $searchIndex = strpos($content, '</pre>', $searchIndex);
                if (!$searchIndex) {
                    break;
                }
                $searchIndex += 6;
            } elseif ($tagName == "<kbd") {
                $searchIndex = strpos($content, '</kbd>', $searchIndex);
                if (!$searchIndex) {
                    break;
                }
                $searchIndex += 6;
            } elseif ($tagName == "<scr") {
                $searchIndex = strpos($content, '</script>', $searchIndex);
                if (!$searchIndex) {
                    break;
                }
                $searchIndex += 9;
            } elseif ($tagName == "<sty") {
                $searchIndex = strpos($content, '</style>', $searchIndex);
                if (!$searchIndex) {
                    break;
                }
                $searchIndex += 8;
            } else {
                break;
            }

            if (!$searchIndex) {
                break;
            }
            $replaceIndex = $searchIndex;
            $searchCloseTag = false;
            continue;
        } else {
            $searchCodeIndex = strpos($content, '<code', $searchIndex);
            $searchPreIndex = strpos($content, '<pre', $searchIndex);
            $searchKbdIndex = strpos($content, '<kbd', $searchIndex);
            $searchScriptIndex = strpos($content, '<script', $searchIndex);
            $searchStyleIndex = strpos($content, '<style', $searchIndex);
            if (!$searchCodeIndex) {
                $searchCodeIndex = $contentLength;
            }
            if (!$searchPreIndex) {
                $searchPreIndex = $contentLength;
            }
            if (!$searchKbdIndex) {
                $searchKbdIndex = $contentLength;
            }
            if (!$searchScriptIndex) {
                $searchScriptIndex = $contentLength;
            }
            if (!$searchStyleIndex) {
                $searchStyleIndex = $contentLength;
            }
            $searchIndex = min($searchCodeIndex, $searchPreIndex, $searchKbdIndex, $searchScriptIndex, $searchStyleIndex);
            $searchCloseTag = true;
        }
        $replaceStartIndex[$currentReplaceId] = $replaceIndex;
        $replaceEndIndex[$currentReplaceId] = $searchIndex;
        $currentReplaceId++;
        $replaceIndex = $searchIndex;
    }

    $output = "";
    $output .= substr($content, 0, $replaceStartIndex[0]);
    for ($i = 0; $i < count($replaceStartIndex); $i++) {
        $part = substr($content, $replaceStartIndex[$i], $replaceEndIndex[$i] - $replaceStartIndex[$i]);
        $renderedPart = _renderPart($part);
        $output.= $renderedPart;
        if ($i < count($replaceStartIndex) - 1) {
            $output.= substr($content, $replaceEndIndex[$i], $replaceStartIndex[$i + 1] - $replaceEndIndex[$i]);
        }
    }
    $output .= substr($content, $replaceEndIndex[count($replaceStartIndex) - 1]);
    return $output;
}

function _renderPart($content) {
    $options = Typecho_Widget::widget('Widget_Options');
    if ((!empty($options->markdownExtend) && in_array('enablePhonetic', $options->markdownExtend))) {
        $content = _renderPhonetic($content);
    }
    if ((!empty($options->markdownExtend) && in_array('enableDeleteLine', $options->markdownExtend))) {
        $content = _renderDeleteTag($content);
    }
    if ((!empty($options->markdownExtend) && in_array('enableHighlightText', $options->markdownExtend))) {
        $content = _renderHighlight($content);
    }
	if ((!empty($options->switch) && in_array('EnableNetease', $options->switch))) {
        $content = _renderNetease($content);
    }

    $content = _escapeCharacter($content);
    $content = _renderCards($content);
    return $content;
}

function _renderPhonetic($content) {
    $content = preg_replace('/\{\{\s*([^\:]+?)\s*\:\s*([^}]+?)\s*\}\}/is',
        "<ruby>$1<rp> (</rp><rt>$2</rt><rp>) </rp></ruby>", $content);
    return $content;
}

function _renderDeleteTag($content) {
    $content = preg_replace('/\~\~(.+?)\~\~/i', "<del>$1</del>", $content);
    return $content;
}

function _renderNetease($content) {
    $content = preg_replace('/\{\{(.+?)\}\}/i',
		'<iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=330 height=86
		src="//music.163.com/outchain/player?type=2&id='.'$1'.'&auto=0&height=66"></iframe>', $content);
    return $content;
}


function _renderHighlight($content) {
    $content = preg_replace('/\=\=(.+?)\=\=/i', "<span class=\"highlight-text\">$1</span>", $content);
    return $content;
}

function _escapeCharacter($content) {
    $content = str_replace('\~', '~', $content);
    $content = str_replace('\=', '=', $content);
	//$content = str_replace('\{', '{', $content);
    $content = str_replace('\$', '<span>$</span>', $content);
    return $content;
}

function _renderCards($content) {
    $currentGroupId = 0;
    $lastFindIndex = 0;
    $lastFindLength = 0;
    $linkGroup = array();
    $linkGroupStartIndex = array();
    $linkGroupEndIndex = array();
    $first = true;

    $totalCount = preg_match_all('/(<p>)*<a\s+href=\"([^\"]+?)\"[^<>]*>([^<>]+?)<\/a>\+\(<a\s+href=\"([^\"]+?)\">([^<>]+?)<\/a>\)(<\/p>)*(<\s*br\s*\/\s*>)*(<\s*\/\s*br\s*>)*/ixs', $content, $matches);

    if ($totalCount <= 0) {
        $totalCount = preg_match_all('/(<p>)*<a\s+href=\"([^\"]+?)\"[^<>]*>([^<>]+?)<\/a>\+\(<a\s+href=\"([^\"]+?)\)\">([^<>]+?)\)<\/a>(<\/p>)*(<\s*br\s*\/\s*>)*(<\s*\/\s*br\s*>)*/ixs', $content, $matches);
    }

    if ($totalCount <= 0) {
        $totalCount = preg_match_all('/(<p>)*<a\s+href=\"([^\"]+?)\"[^<>]*>([^<>]+?)<\/a>\+\(([^<>]+?)\)(<\/p>)*(<\s*br\s*\/\s*>)*(<\s*\/\s*br\s*>)*/ixs', $content, $matches);
    }

    for ($i = 0; $i < $totalCount; $i++) {
        if ($first) {
            $first = false;
            $useNewGroup = true;
            $currentFindIndex = strpos($content, $matches[0][$i]);
            $currentFindLength = strlen($matches[0][$i]);
        } else {
            $lastEndIndex = $lastFindIndex + $lastFindLength;
            $currentFindIndex = strpos($content, $matches[0][$i], $lastEndIndex - 1);
            $currentFindLength = strlen($matches[0][$i]);
            if ($currentFindIndex - $lastEndIndex >= 0) {
                $splitContent = substr($content, $lastEndIndex, $currentFindIndex - $lastEndIndex);
                if (strlen($splitContent) > 0 && preg_match('/\w+/xs', $splitContent)) {
                    $trimSplitContent = preg_replace('/<\s*br\s*\/\s*>/ixs', '', $splitContent);
                    $trimSplitContent = preg_replace('/<\s*\/\s*br\s*>/ixs', '', $trimSplitContent);
                    $trimSplitContent = preg_replace('/<\s*br\s*>/ixs', '', $trimSplitContent);
                    if (strlen($trimSplitContent) > 0 && preg_match('/\w+/xs', $trimSplitContent)) {
                        $useNewGroup = true;
                    } else {
                        $useNewGroup = false;
                    }
                } else {
                    $useNewGroup = false;
                }
            } else {
                $useNewGroup = false;
            }
        }

        if ($useNewGroup) {
            $currentGroupId ++;
        }
        if (!isset($linkGroup[$currentGroupId])) {
            $linkGroup[$currentGroupId] = array();
        }
        if ($useNewGroup) {
            $linkGroupStartIndex[$currentGroupId] = $currentFindIndex;
        }
        $linkGroupEndIndex[$currentGroupId] = $currentFindIndex + $currentFindLength;
        $match = array();
        $match[2] = $matches[2][$i];
        $match[3] = $matches[3][$i];
        $match[4] = $matches[4][$i];
        $linkGroup[$currentGroupId][] = $match;
        $lastFindIndex = $currentFindIndex;
        $lastFindLength = $currentFindLength;
    }

    $output = "";
    for ($i = 1; $i <= $currentGroupId; $i++) {
        $start = $linkGroupStartIndex[$i];

        if ($i > 1){
            $lastId = $i - 1;
            $lastEnd = $linkGroupEndIndex[$lastId];
            $output .= substr($content, $lastEnd, $start - $lastEnd);
        } else {
            $output .= substr($content, 0, $start);
        }
        $matches = $linkGroup[$i];
        $linkGroupHtml = "<div class=\"link-box\">\n";

        foreach ($matches as $match) {
            $linkGroupHtml .= "<a href=\"{$match[2]}\" target=\"_blank\">";
            $linkGroupHtml .= "<div class=\"thumb\">";
            $linkGroupHtml .= "<img width=\"200\" height=\"200\" src=\"{$match[4]}\" alt=\"{$match[3]}\"></div>";
            $linkGroupHtml .= "<div class=\"content\">";
            $linkGroupHtml .= "<div class=\"title\"><h3>{$match[3]}</h3></div>";
            $linkGroupHtml .= "</div></a>\n";
        }
        $linkGroupHtml .= '</div>';
        $output .= $linkGroupHtml;
    }

    if ($currentGroupId < 1) {
        return $content;
    }

    $output .= substr($content, $linkGroupEndIndex[$currentGroupId]);
    return $output;
}


//custom render for markdownExtend
/**
 * 重写的评论函数
 * @param $comments 评论
 * @param $options
 */
function threadedComments($comments, $options){
	//Helper::options()->logoutUrl();
	Typecho_Widget::widget('Widget_User')->to($user);
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
        </div>
        <div class="comment-body">
            <cite class="fn" itemprop="name"><?php $singleCommentOptions->beforeAuthor();
            $comments->author();//here

                $arr=explode(' ',Helper::options()->username);
                $flag=false;
	            if ( in_array( $comments->author, $arr ) ) {
		            echo ' <img src="' . Helper::options()->themeUrl . '/img/vip.png"</img>';
		            $flag=true;
	            }
	            $singleCommentOptions->afterAuthor();
	            if ( Helper::options()->CommentsIP != 'dontShow' ) {

		            include_once( 'extra/ip/IP.php' );
		            $addresses = IPLocation_IP::find( $comments->ip );
		            $address   = 'unknown';
		            if ( ! empty( $addresses ) ) {
			            $addresses = array_unique( $addresses );
			            $address   = implode( '', $addresses );
		            }
		            if ( Helper::options()->CommentsIP == 'ShowAll' ) {
			            echo '<span style="color:#3CB371;"> [' . $address . ' 网友]</span>';
		            } elseif ( Helper::options()->CommentsIP == 'ShowAllHide' && !$flag ) {
			            echo '<span style="color:#3CB371;"> [' . $address . ' 网友]</span>';

		            } elseif ( Helper::options()->CommentsIP == 'ShowBlogger' && $user->hasLogin() ) {
			            echo '<span style="color:#3CB371;"> [' . $address . ' 网友]</span>';
		            }
	            }
				?>
            </cite>
            <div class="comment-content" itemprop="commentText">
				<?php $comments->content(); ?>
            </div>
            <div class="comment-footer">
                <time itemprop="commentTime" datetime="<?php $comments->date('c'); ?>"><?php $singleCommentOptions->beforeDate();
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
                elseif('ShowOwner'==Helper::options()->showUA && $user->hasLogin())
					//echo getUA($comments->agent,1);
					echo getUA($comments->agent,1);
				else
					echo '';
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
