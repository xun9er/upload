<?php if (!defined('ROOT')) exit('Can\'t Access !'); return array (


'database'=>array(
'hostname'=>'localhost',//MySQL服务器(localhost默认不修改！)
'user'=>'数据库用户名',//用户名
'password'=>'数据库密码',//密码
'database'=>'数据库名称',//数据库
'prefix'=>'cmseasy_',//表前缀
'encoding'=>'utf8',//编码
),


'install_admin'=>'admin',


//site-站点信息{
'site_url'=>'http://localhost/', //网站地址[http://起始并以 / 结束]
'sitename'=>'企业营销型管理系统', //网站名称[网站简称]
'fullname'=>'免费企业网站程序是国内首款免费营销型的企业网站系统', //网站全称[网页标题处显示，可结合关键词]
'site_mobile'=>'88888888888', //手机号码[管理员手机号码,可以开通用户动作短信提醒]
'k'=>array ('G','H','I','J','K','L','M','N','O','G','H','I','J','K','L'),
'h'=>array (104,116,116,112,58,47,47,108,105,99,101,110,115,101,46,99,109,115,101,97,115,121,46,99,110,47,112,104,112,114,112,99,46,112,104,112),
'site_icp'=>'吉ICP备88888888号', //ICP备案号[前台显示ICP备案号码]
'site_keyword'=>'企业网站程序,企业网站源码,cmseasy',//网站关键字[网站关键词，用于优化网站排名，多个关键词请用","间隔]
'site_description'=>'一款基于 PHP+Mysql 架构的网站内容管理系统，也是一个 PHP 开发平台。 采用模块化方式开发，功能易用便于扩展，可面向大中型站点提供重量级网站建设解决方案。2年来，凭借 团队长期积累的丰富的Web开发及数据库经验和勇于创新追求完美的设计理念， 得到了众多网站的认可，并且越来越多地被应用到大中型商业网站。 ',//网站描述[网站网页描述内容，可简写与网站相关的简介]
'version'=>'V20111105',//程序版本
'cookie_password'=>'2f8ed4752c0af5e03b3ea418e8f70fa2', //Cookie安全码[系统自动生成，如多站通信登录请复制主站安全码！]
'logo_width'=>'324',//logo宽度[单位(px)]
'site_logo'=>'images/logo.gif',//网站logo[网站logo]=>image
'onerror_pic'=>'images/nopic.gif',//列表默认图片[当图片列表页无内容缩略图显示时用于替换显示的图片]=>image
'site_right'=>'Copyright © 2010-2011', //网站版权[前台显示网站版权说明内容]
'lang_type'=>'cn', //语言设置[网站模板语言选项，需结合网站后台输入内容显示]=>cn/中文/en/英文/jp/日文/de/德文/user/自定义
//}


//site-后台目录{
'admin_dir'=>'admin', //后台地址[强烈推荐安装后第一时间修改登录地址，加强网站后台安全性]
//}

//site-动静态{
'urlrewrite_on'=>'0',  //伪静态=>0/关闭/1/开启
'list_page_php'=>'0', //栏目页[设置栏目页动静态显示，如选择开启伪静态，此处必须选择动态！]=>0/按指定/1/静态/2/动态
'show_page_php'=>'0', //内容页[设置内容页动静态显示，如选择开启伪静态，此处必须选择动态！]=>0/按指定/1/静态/2/动态
'html_prefix'=>'', //html存放路径[设置html生成后存放目录][为空或以/开头]
'group_on'=>'1', //生成分组[设置是否分组生成]=>0/关/1/开
'group_count'=>'20',//每组生成个数[视网速和主机配置而定，推荐设置为"20"]
//}


//site-列表缓存{
'list_cache'=>'0', //列表缓存[是否启用php缓存，强烈推荐开启此项]=>0/关/1/开
'list_cache_time'=>'3600', //缓存时间[设置缓存更新的时间，单位(秒)]
//}

//site-分页{
'manage_pagesize'=>'20',//后台分页数量[设置后台内容列表分页数量]
'list_pagesize'=>'16',//前台分页数量[设置前台全站内容列表分页数量，如栏目单独设置分页，按栏目设置]
//}

//site-搜索{
'maxhotkeywordnum'=>'1',//搜索基数[热门关键词获取条件，大于基数的为热门关键词]
//}



//archive-文章系统{
'archive_introducelen'=>'200',//内容系统简介自动截取长度[自动获取内容中前200字符为内容简介]
//}


//security-字符过滤{
'filter_word'=>'陈水', //过滤字符[多个请用“,”隔开]
'filter_x'=>'(*该人已被收押*)', //替代字符
//}

//site-缩略图{
'thumb_width'=>'150',//宽度[单位(px)]
'thumb_height'=>'120',//高度[单位(px)]
//}

//site-开关设置{
'verifycode'=>'0', //验证码开关=>0/关/1/开
'reg_on'=>'1', //注册开关=>0/关/1/开
'isdebug'=>'0', //调试开关=>0/关/1/开
'opguestadd'=>'1', //游客投稿开关[游客发布地址：http://域名/?g=1]=>0/关/1/开
//}


//image-图片水印{
'watermark_open'=>'1', //水印开关=>0/关/1/开
'watermark_min_width'=>'300',//最小宽度[不满足条件不添加水印]
'watermark_min_height'=>'300',//最小高度[不满足条件不添加水印]
'watermark_path'=>'/images/logo.gif',//水印路径[支持jpg、gif、png格式]=>image
'watermark_ts'=>'80',//透明度[范围为 1~100 的整数，数值越小水印图片越透明]
'watermark_qs'=>'90',//JPEG图片质量[范围为 0~100 的整数，数值越大结果图片效果越好]
'watermark_pos'=>'5',//添加位置[请在此选择水印添加的位置(3x3 共9个位置可选)]=>1/1/2/2/3/3/4/4/5/5/6/6/7/7/8/8/9/9
//}

//upload-附件设置{
'upload_filetype'=>'jpg,gif,bmp,jpeg,png,doc,zip,rar,7z,sql,txt', //附件类型[添加附件类型用","隔开]
'upload_max_filesize'=>'2', //附件大小[单位(MB)]
'mods'=>'celive',
//}

//template-模板设置{
'template_dir'=>'default', //前台模板选择[默认default]

//}

//ballot-投票设置{
'checkip'=>'1', //验证IP[设置是否开启IP限制]=>0/关/1/开
'timer'=>'60',  //时间间隔[设置投票IP显示时间，单位:分钟]
//}

//enlarge-网站客服信息{
'ifonserver'=>'1', //开启前台客服=>1/开启/0/关闭
'boxopen'=>'close', //默认展开客服列表=>open/开启/close/关闭
'liveboxtip'=>'1', //弹出邀请对话框=>1/开启/0/关闭

'address'=>'某某科技股份有限公司',//联系地址
'tel'=>'086-888-8888888',//联系电话
'mobile'=>'18888888888',//移动电话
'fax'=>'086-888-8888888',//传真
'email'=>'admin@admin.com',//email
'postcode'=>'888888',//邮政编码
'qq1'=>'88888888', //站长QQ
'qq2'=>'', //售前QQ
'qq3'=>'', //售后QQ
'qq4'=>'', //售后QQ
'qq5'=>'', //售后QQ
'wangwang'=>'', //阿里旺旺
'skype'=>'', //Skype
'msn'=>'', //Msn
//}

//ditu-地图设置{
'ditu_width'=>'360', //地图宽度[填写地图的宽度，例如：360]
'ditu_height'=>'300', //地图高度[填写地图的宽度，例如：300]
'ditu_center_left'=>'154.693754', //地图中心点-经度
'ditu_center_right'=>'63.178221', //地图中心点-纬度
'ditu_level'=>'12',//地图显示级别
'ditu_title'=>'某某科技公司',//信息窗标题
'ditu_content'=>'地址：某某省某某市XXX街XXX号<br>电话：086-888-8888888',//信息窗内容
'ditu_maker_left'=>'154.393394',//标记经度
'ditu_maker_right'=>'63.176178',//标记纬度
'ditu_explain'=>'',//使用说明
//}


//mail-邮件设置{
	
'send_type'=>'2', //邮件发送方式=>0/请选择/1/PHP函数sendmail发送(推荐)/2/SOCKET连接SMTP服务器发送(支持ESMTP验证)/3/PHP函数SMTP发送Email(仅Windows主机有效,不支持ESMTP验证)
'header_var'=>'0', //邮件头的分隔符=>99/请选择/1/CRLF分隔符(Windows)/0/LF分隔符(Unix|Linux)/2/CR分隔符(Mac)
'kill_error'=>'1', //屏蔽错误提示=>0/否/1/是
//}


//mail-SOCKET连接SMTP服务器发送(支持ESMTP验证){
	
'smtp_host'=>'smtp.163.com', //SMTP服务器
'smtp_port'=>'25', //SMTP端口
'smtp_auth'=>'1', //要求身份验证=>0/否/1/是
'smtp_user_add'=>'admin <admin@163.com>', //发信人地址
'smtp_mail_username'=>'admin@163.com', //用户名
'smtp_mail_password'=>'admin', //密码
//}

//mail-PHP函数SMTP发送Email(仅Windows主机下有效,不支持ESMTP验证){
	
'smtp_host'=>'smtp.163.com', //SMTP服务器
'smtp_port'=>'25', //SMTP端口
//}


//slide-幻灯片设置{
'slide_width'=>'980', //幻灯宽度
'slide_height'=>'280', //幻灯高度
'slide_number'=>'5', //幻灯片[数量<5]
'slide_pic1'=>'images/slide/banner01.jpg', //图片1地址=>image
'slide_pic1_title'=>'助力企业网络营销', //图片1标题
'slide_pic1_url'=>'#', //图片1链接地址[注意链接中的&要用%26替换]
'slide_pic2'=>'images/slide/banner02.jpg', //图片2地址=>image
'slide_pic2_title'=>'海量精美模板免费下载', //图片2标题
'slide_pic2_url'=>'#', //图片2链接地址[注意链接中的&要用%26替换]
'slide_pic3'=>'images/slide/banner03.jpg', //图片3地址=>image
'slide_pic3_title'=>'免费下载,还有机会获取商业授权', //图片3标题
'slide_pic3_url'=>'#', //图片3链接地址[注意链接中的&要用%26替换]
'slide_pic4'=>'images/slide/banner04.jpg', //图片4地址=>image
'slide_pic4_title'=>'欢迎网建公司及工作室参与官方分享计划', //图片4标题
'slide_pic4_url'=>'#', //图片4链接地址[注意链接中的&要用%26替换]
'slide_pic5'=>'images/slide/banner05.jpg', //图片5地址=>image
'slide_pic5_title'=>'CmsEasy服务/售后/程序多重升级', //图片5标题
'slide_pic5_url'=>'#', //图片5链接地址[注意链接中的&要用%26替换]
//}

'$mF'=>array(

    "mF_fscreen_tb","mF_YSlider","mF_luluJQ","mF_51xflash","mF_expo2010","mF_games_tb",
    "mF_ladyQ","mF_liquid","mF_liuzg","mF_pithy_tb","mF_qiyi","mF_quwan","mF_rapoo",
    "mF_sohusports","mF_taobao2010","mF_taobaomall","mF_tbhuabao","mF_pconline","mF_peijianmall",
    "mF_classicHC","mF_classicHB","mF_slide3D","mF_kiki",
    
    ),
    
//ifocus-焦点图设置{
'ifocus_width'=>'280',  //焦点图宽度
'ifocus_height'=>'210', //焦点图高度
'ifocus_number'=>'5', //焦点图[数量<5]
'ifocus_time'=>'3', //切换时间间隔[秒]
'ifocus_pattern'=>'mF_pithy_tb', //风格应用选择=>$mF
'ifocus_pic1'=>'images/ifocus/1.jpg', //图片1地址=>image
'ifocus_pic1_title'=>'助力企业网络营销', //图片1标题
'ifocus_pic1_url'=>'#', //图片1链接地址[注意链接中的&要用%26替换]
'ifocus_pic2'=>'images/ifocus/2.jpg', //图片2地址=>image
'ifocus_pic2_title'=>'海量精美模板免费下载', //图片2标题
'ifocus_pic2_url'=>'#', //图片2链接地址[注意链接中的&要用%26替换]
'ifocus_pic3'=>'images/ifocus/3.jpg', //图片3地址=>image
'ifocus_pic3_title'=>'免费下载,还有机会获取商业授权', //图片3标题
'ifocus_pic3_url'=>'#', //图片3链接地址[注意链接中的&要用%26替换]
'ifocus_pic4'=>'images/ifocus/4.jpg', //图片4地址=>image
'ifocus_pic4_title'=>'欢迎网建公司及工作室参与合作计划', //图片4标题
'ifocus_pic4_url'=>'#', //图片4链接地址[注意链接中的&要用%26替换]
'ifocus_pic5'=>'images/ifocus/5.jpg', //图片5地址=>image
'ifocus_pic5_title'=>'服务/售后/程序多重升级', //图片5标题
'ifocus_pic5_url'=>'#', //图片5链接地址[注意链接中的&要用%26替换]
//}

//sms-短信设置{
'sms_username'=>'', //用户名[您需要<a href="http://pay.cmseasy.cn/reg.php" target="_blank"><font color="#009900">注册用户</font></a>后使用！]
'sms_password'=>'',  //密码[请输入短信平台注册时填写的密码]
'sms_on'=>'1',  //短信开关=>1/开启/0/关闭
'sms_keyword'=>'共产党,江泽民',  //替换非法字符[英文逗号分隔]
'sms_maxnum'=>'10',  //最多发送[每天发送的最大条数]
'sms_reg_on'=>'1',  //注册发送=>1/是/0/否
'sms_reg'=>'欢迎你注册xxx网站',  //注册发送内容
'sms_guestbook_on'=>'1',  //留言发送=>1/是/0/否
'sms_guestbook'=>'谢谢你的留言',  //留言发送内容
'sms_order_on'=>'1',  //订单发送=>1/是/0/否
'sms_order'=>'感谢你的订单',  //订单发送内容
'sms_form_on'=>'1',  //表单发送=>1/是/0/否
'sms_form'=>'谢谢你的参与',  //表单发送内容
'sms_guestbook_admin_on'=>'1',  //确认留言[向管理员发送]=>1/是/0/否
'sms_form_admin_on'=>'1',  //确认表单[向管理员发送]=>1/是/0/否
'sms_order_admin_on'=>'1',  //确认订单[向管理员发送]=>1/是/0/否
'sms_consult_admin_on'=>'1',  //开启咨询[向管理员发送咨询内容]=>1/是/0/否
//}

//cnzz-cnzz统计配置{
'cnzz_user'=>'80786199', //验证码A[自动生成,请牢记,每域名只赠送一个全景帐号!]
'cnzz_pass'=>'1458716049', //验证码B[自动生成,请牢记,每域名只赠送一个全景帐号!]
//}
);

