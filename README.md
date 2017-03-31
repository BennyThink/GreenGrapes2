# GreenGrapes
typecho 绿色主题
修改自[https://github.com/hongweipeng/GreenGrapes](https://github.com/hongweipeng/GreenGrapes "https://github.com/hongweipeng/GreenGrapes")

## 使用条件 ##
需要`GravatarCache`插件，在`extra`目录下，请移动到`plugins`目录并启用。

## 改动 ##
* 增加了分享功能（插件来自于[river](https://github.com/revir/need-more-share2)）
* 页面和文章访问量统计（不需要插件）
* 改变协议为CC-BY-NC-SA4.0
* 去除页面最下方的备案信息、改成动态的颜文字
* 增加`meta theme color`使Chrome变色
* 增加侧边后台管理
* 启用侧边分类
* 启用页脚加载耗时
* 启用页脚运行时间
* 增加编辑按钮
* 增加字数统计
* 增加最后更新时间
* 增加文章数量统计
* 增加评论框特效
* 评论头像QQ邮箱和Gravatar同时启用
优先QQ头像，然后是Gravatar，再之后是默认。已经启用了gravatar和QQ头像的缓存策略，所以基本上不会对网站速度有太大影响。
由于技术限制，需要大家修改`functions.php`中第73行`$yourUrl='https://www.mingyueli.com/';`为你的域名，不要忘记了最后的`/`

## To do ##
- [ ]移除对插件`GravatarCache`的依赖

## 演示 ##
[奔跑的蜗牛壳](https://www.mingyueli.com)

## 使用的插件 ##
* CommentToMail		评论邮件提醒插件
* GravatarCache		Gravatar 头像缓存插件
* HighSlide		无缝集成HighSlide双核版实现自动化弹窗与页面相册功能
* Links		友情链接插件
* Sitemap		Google Sitemap 生成器
* Smilies		为博客添加图片表情功能
* Snow		3D效果的飘雪插件
* Syntax Highlighter		语法高亮插件（特效移植于WordPress Git主题，更多请[参见这里](https://github.com/BennyThink/Git-SyntaxHighlighter-For-Typecho)）
* cPlayer		网易云、上传本地音乐插件
* kiana		琪亚娜小挂件
* notice		判断来路地址输出欢迎消息。


原始说明
====
## 特点
* 头像设计，突出中间的图片，使你脱颖而出。
* header背景颗粒感突出。
* 支持自定义头像即测拉显示名称。
* 支持高分辨率视网膜屏幕，自适应手机及平板。
* 立体式标签云。

## 主题安装
1. 下载Typecho主题，得到一个文件夹
2. 整个文件夹上传至usr/themes/目录下
3. 登陆自己的博客后台，在“控制台”的下拉菜单中选择“外观”选项进入已安装主题列表
4. 在相应的主题点击“启用”即可使用

## Todo
- [ ] 侧边栏项目可选是否显示
- [ ] 主题配色扩充