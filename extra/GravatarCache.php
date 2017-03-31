<?php
/**
 * Gravatar 头像缓存插件
 * 
 * @package GravatarCache 
 * @author Byends
 * @version 2.0.0
 * @link http://www.byends.com
 */

/**
 * 2.0.0  at 2011-04-23
 * 
 * 此版只是功能更新，需要用到如下功能的可以考虑更新，未对 1.2.0 版功能作任何调整
 * 增加 方法  getGravatarCache($mail, $isSecure = false, $size = 32, $rating = 'G')
 * 功能：获取给定邮件地址的缓存头像（此处缓存头像是指使用本插件时生成的评论者的缓存头像），方便用于主题中各个页面的调用
 * 参数： 
 * $mail     ->  邮件地址；
 * $isSecure ->  是否使用 https 安全协议，默认 false； 
 * $size     ->  头像大小，这个只用于当评论头像不存在时重新获取头像时的大小，若头像已存在则无效，默认 32
 * $rating   ->  头像等级，这个只用于当评论头像不存在时重新获取头像时的等级，若头像已存在则无效，默认 G
 * 
 * return  返回 头像 地址 如: http://www.byends.com/usr/uploads/avatarCache/default.jpg
 * 
 * 使用方法：GravatarCache::getGravatarCache('example@domain.com');
 * 
 * 
 * 
 * 1.2.0  at 2011-04-14
 * 
 * 1、修复程序逻辑BUG
 * 2、修复域名后面多出一个斜杠的BUG
 * 3、优化了代码效率
 * 
 * 1.1.0  at 2011-02-25
 *
 * 增加获取图片的方法，现在有 curl/fopen/copy 三个方法，加强成功率
 *
 * 1.0.2 at 2010-10-21
 * 
 * 修改头像获取地址
 *
 *
 * 1.0.1 at 2010-09-11
 * 
 * 修正当邮箱地址不为空 且 没有Gravatar头像时 不会 调用默认头像的 BUG
 * 
 *
 * 1.0.0 at 2010-09-08
 *
 * 使用方法：即插即用
 */
class GravatarCache implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Abstract_Comments')->gravatar = array('GravatarCache', 'getGravatar');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
	{
		self::deleteFile();
	}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
		$timeCache = new Typecho_Widget_Helper_Form_Element_Text('timeCache', NULL, '1209600', _t('缓存时间'),_t('缓存时间，默认 14天 = 1209600 秒'));
		$timeCache->input->setAttribute('class', 'mini');
		$form->addInput($timeCache->addRule('required', _t('必须填写缓存时间'))->addRule('isInteger', _t('缓存时间必须是整数')));
		
		$dir = new Typecho_Widget_Helper_Form_Element_Text('dir', null, '/usr/uploads/avatarCache/', _t('存放路径'), _t('缓存头像存放的路径，请确保第一个目录可写！'));
		$form->addInput($dir->addRule('required', _t('必须填写缓存目录')));
		
		$delCache= new Typecho_Widget_Helper_Form_Element_Radio( 'delCache', array( 'delY' => '是', 'delN' => '否' ), 'delY', '删除缓存',_t('禁用插件时是否删除缓存头像和目录') );
        $form->addInput($delCache);
		
		return _t('请到插件配置里设置相应选项');
	}
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    public static function getGravatar($size, $rating, $default, $comments)
    {
		$option = Typecho_Widget::widget('Widget_Options')->plugin('GravatarCache');
		$u = Helper::options()->siteUrl;   // Url 
		$b = __TYPECHO_ROOT_DIR__ . DIRECTORY_SEPARATOR; //本地路径
		$referer = "http://www.gravatar.com";
		$p = $option->dir;
		$p = substr($p, 0, 1) == '/' ? substr($p, 1) : $p;
		$p = substr($p, -1, 1) != '/' ? $p.'/' : $p;
		$d = $b.$p.'default.jpg';

    	if(!file_exists($d)){
			$g = 'http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s='.$size.'&r='.$rating;
			if(!self::download($g, $referer, $d)) copy($g, $d); 
    	}
		$default = empty($default) ? 'mm' : $default;
		//$default = empty($default) ? $u . $p . 'default.jpg'  :  $default ;
		$t = $option->timeCache; // 获取设定的缓存时间
		$f = empty($comments->mail) ? 'default' : md5( strtolower( $comments->mail ) ); // mail 为空时，直接用默认头像
		$a = $u.$p.$f.'.jpg';
		$e = $b.$p.$f.'.jpg';			

		if(!self::mkdirs(dirname($d))){ 
			throw new exception('GravatarCache 目录创建失败，请检查指定的根目录是否可写' );
		}
			
		if(!file_exists($e) || (time() - filemtime($e)) > $t){  //当头像不存在或超过 指定的 缓存时间才更新		
					
			if($comments->request->isSecure()){
				$host = 'https://secure.gravatar.com';
			}else{//if (empty($comments->mail)){
                        $host = 'http://www.gravatar.com';
                    //}else{
                        //$host = sprintf( "http://%d.gravatar.com", (hexdec($mailHash{0}) % 2));
                    //}
			}			
			$g = $host.'/avatar/'.$f.'?d='.$default.'&s='.$size.'&r='.$rating;
			if(!self::download($g, $referer, $e)) copy($g, $e);
			if(filesize($e) == 911 && filesize($d) != 911) copy($d, $e);
		}
		echo '<img class="avatar" src="'.$a.' "alt="'.$comments->author.'" width="'.$size.'" height="'.$size.'" />';
    }
	
    public static function getGravatarCache($mail, $isSecure = false, $size = 32, $rating = 'G'){
    	$option = Typecho_Widget::widget('Widget_Options')->plugin('GravatarCache');
		$u = Helper::options()->siteUrl;   // Url 
		$b = __TYPECHO_ROOT_DIR__ . DIRECTORY_SEPARATOR; //本地路径
		$referer = "http://www.gravatar.com";
		$p = $option->dir;
		$p = substr($p, 0, 1) == '/' ? substr($p, 1) : $p;
		$p = substr($p, -1, 1) != '/' ? $p.'/' : $p;
		$d = $b.$p.'default.jpg';

    	if(!file_exists($d)){
			$g = 'http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s='.$size.'&r='.$rating;
			if(!self::download($g, $referer, $d)) copy($g, $d); 
    	}
		$default = empty($default) ? 'mm' : $default;

		$t = $option->timeCache; // 获取设定的缓存时间
		$f = empty($mail) ? 'default' : md5( strtolower( $mail ) ); // mail 为空时，直接用默认头像
		$a = $u.$p .$f.'.jpg';
		$e = $b.$p.$f.'.jpg';			
			
		if(!file_exists($e) || (time() - filemtime($e)) > $t){  //当头像不存在或超过 指定的 缓存时间才更新
				
			$host = $isSecure ? 'https://secure.gravatar.com' : 'http://www.gravatar.com';			
			$g = $host.'/avatar/'.$f.'?d='.$default.'&s='.$size.'&r='.$rating;
			if(!self::download($g, $referer, $e)) copy($g, $e);
			if(filesize($e) == 911 && filesize($d) != 911) copy($d, $e);
		}		
		return $a;
    }
    
	/**
     * 生成多层目录
     * 
     * @access public
     * @return void
     */
	public static function mkdirs( $dir )
	{    
		return is_dir( $dir ) or ( self::mkdirs( dirname( $dir ) ) and mkdir( $dir, 0777 ));
	}
	
	/**
     * 禁用插件时同时删除缓存头像
     * 
     * @access public
     * @return void
     */
	public static function deleteFile()
	{
		
		$option = Typecho_Widget::widget('Widget_Options')->plugin('GravatarCache');
		$path = __TYPECHO_ROOT_DIR__ . DIRECTORY_SEPARATOR. $option->dir;
		if (substr($path,-1)!='/') {$path.='/';}
		if( $option->delCache == 'delY' ){
		foreach (glob( $path. '*.jpg') as $filename) {
		   unlink($filename);
		}
		$sysDir =  array( 'usr', 'uploads', 'themes', 'plugins' );
		$dirArray = explode("/", $path);
		array_pop($dirArray);
		$currentDir = array_pop($dirArray);
		
		if(!in_array( $currentDir, $sysDir)) { rmdir($path); }
		}
	}
	
	/**
     * 下载头像到本地
     * 
     * @access public
     * @return void
     */
	function download( $url, $referer, $imagePath  )
	{
		// Open the target file for writing
		$fpLocal = @fopen( $imagePath, 'w' );
		if( !$fpLocal ) {
			return false;
		}
		
		// Use cURL to download if available
		if( is_callable('curl_init') ) { 
			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_REFERER, $referer );
			curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
			curl_setopt( $ch, CURLOPT_HEADER, 0 );
			curl_setopt( $ch, CURLOPT_FILE, $fpLocal );
			if( !curl_exec($ch) ) {
				fclose( $fpLocal );
				curl_close( $ch );
				return false;
			}
			curl_close( $ch );
		}
		// Otherwise use fopen
		else { 
			$opts = array(
				'http' => array(
					'method' => "GET",
					'header' => "Referer: $referer\r\n"
				)
			);
			
			$context = stream_context_create( $opts );
			$fpRemote = @fopen( $url, 'r', false, $context );
			if( !$fpRemote ) {
				fclose( $fpLocal );
				return false;
			}
			
			while( !feof( $fpRemote ) ) {
				fwrite( $fpLocal, fread($fpRemote, 8192) ); 
			}
			fclose( $fpRemote );
		}
		
		fclose( $fpLocal );
		return true;
	}
}