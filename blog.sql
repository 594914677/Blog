/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-03-14 13:37:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_adminuser
-- ----------------------------
DROP TABLE IF EXISTS `admin_adminuser`;
CREATE TABLE `admin_adminuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员表';

-- ----------------------------
-- Records of admin_adminuser
-- ----------------------------
INSERT INTO `admin_adminuser` VALUES ('2', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2018-01-17 09:27:32');
INSERT INTO `admin_adminuser` VALUES ('3', 'liqi', '21232f297a57a5a743894a0e4a801fc3', '2018-01-17 09:27:18');

-- ----------------------------
-- Table structure for admin_carousel
-- ----------------------------
DROP TABLE IF EXISTS `admin_carousel`;
CREATE TABLE `admin_carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `img` varchar(255) DEFAULT NULL COMMENT '图像地址',
  `url` varchar(255) DEFAULT NULL COMMENT 'url地址',
  `isShow` int(1) DEFAULT '0' COMMENT '展示 1:展示 0：不展示',
  `update_time` date DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='轮播图';

-- ----------------------------
-- Records of admin_carousel
-- ----------------------------
INSERT INTO `admin_carousel` VALUES ('1', 'banner1', '/public/static/image/index/banner/20180209/f8f5121bb445fa98d7c9a573d776b57f.jpg', 'index/123', '1', null, '2018-02-09 16:35:12');
INSERT INTO `admin_carousel` VALUES ('2', 'banner2', '/public/static/image/index/banner/20180209/1db31b339a137edd137dbeb5ca2a3a6c.jpg', 'index/123', '1', null, '2018-02-09 16:35:18');
INSERT INTO `admin_carousel` VALUES ('3', 'banner3', '/public/static/image/index/banner/20180209/cf7f464a3bb56a7af1d8a39d10503e8b.jpg', '1', '1', null, '2018-02-09 16:35:21');
INSERT INTO `admin_carousel` VALUES ('4', 'banner4', '/public/static/image/index/banner/20180209/37bc48968e2554862f355d498bbd5744.jpg', '1', '1', null, '2018-02-09 16:35:25');
INSERT INTO `admin_carousel` VALUES ('6', '1', '/public/static/image/index/banner/20180209/418a280dddf369c070f764081dd7a0c7.jpg', '1', '0', null, '2018-02-22 09:53:47');

-- ----------------------------
-- Table structure for admin_category
-- ----------------------------
DROP TABLE IF EXISTS `admin_category`;
CREATE TABLE `admin_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '栏目名称',
  `links` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT '0' COMMENT '子ID',
  `isShow` int(1) DEFAULT '0' COMMENT '展示 1:展示 0：不展示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='标题分类栏目';

-- ----------------------------
-- Records of admin_category
-- ----------------------------
INSERT INTO `admin_category` VALUES ('1', '服务端', '/service/index', '0', '1');
INSERT INTO `admin_category` VALUES ('2', '数据库', '/database/index', '0', '1');
INSERT INTO `admin_category` VALUES ('3', '前端', '/web/index', '0', '1');
INSERT INTO `admin_category` VALUES ('4', 'PHP', '/service/php', '1', '1');
INSERT INTO `admin_category` VALUES ('5', 'Linux', '/service/Linux', '1', '1');
INSERT INTO `admin_category` VALUES ('6', 'MySql', '/database/mysql', '2', '1');
INSERT INTO `admin_category` VALUES ('7', 'HTML5', '/web/html', '3', '1');
INSERT INTO `admin_category` VALUES ('8', 'JS', '/web/js', '3', '1');
INSERT INTO `admin_category` VALUES ('9', 'Css', '/web/css', '3', '1');
INSERT INTO `admin_category` VALUES ('10', 'Git', '/service/git', '1', '1');

-- ----------------------------
-- Table structure for admin_links
-- ----------------------------
DROP TABLE IF EXISTS `admin_links`;
CREATE TABLE `admin_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linksName` varchar(50) DEFAULT NULL COMMENT '网站名称',
  `linksUrl` varchar(255) DEFAULT NULL COMMENT '网站地址',
  `masterEmail` varchar(30) DEFAULT NULL COMMENT '站长邮箱',
  `linksDesc` varchar(255) DEFAULT NULL COMMENT '站点描述',
  `linksTime` date DEFAULT NULL COMMENT '添加时间',
  `isShow` int(1) DEFAULT '0' COMMENT '是否展示 0:不展示 1：展示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='友情链接';

-- ----------------------------
-- Records of admin_links
-- ----------------------------
INSERT INTO `admin_links` VALUES ('5', 'layui - 经典模块化前端框架', 'http://www.layui.com', 'xianxin@layui.com', 'layui - 经典模块化前端框架', '2018-01-12', '1');
INSERT INTO `admin_links` VALUES ('6', 'layer官方演示与讲解', 'http://layer.layui.com	', 'xianxin@layer.com', 'layer官方演示与讲解', '2018-01-16', '1');
INSERT INTO `admin_links` VALUES ('7', 'layui - 前端框架官方社区', 'http://fly.layui.com', 'xianxin@fly.com', 'layui - 前端框架官方社区', '2018-01-12', '1');
INSERT INTO `admin_links` VALUES ('8', '百度', 'https://www.baidu.com/', 'admin@qq.com', '百度一下，你就知道', '2018-01-01', '1');
INSERT INTO `admin_links` VALUES ('9', '福利吧', 'http://fuliba.net/', 'admin@qq.com', '福利吧', '2018-01-12', '1');
INSERT INTO `admin_links` VALUES ('11', 'ThinkPHP V5.0', 'https://www.kancloud.cn/manual/thinkphp5/118003', 'admin@qq.com', 'ThinkPHP V5.0——为API开发而设计的高性能框架\n', '2018-01-16', '1');
INSERT INTO `admin_links` VALUES ('12', '老张博客', 'http://www.phplaozhang.com/', '1@qq.com', '', '2018-02-02', '1');
INSERT INTO `admin_links` VALUES ('13', 'layuiCMS2.0基础版', 'http://layuicms.gitee.io/layuicms2.0/index.html', '1a@qq.com', '', '2018-02-06', '1');

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL COMMENT '菜单名称',
  `url` varchar(255) DEFAULT NULL COMMENT '菜单URL地址',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `p_id` int(11) NOT NULL COMMENT '父级ID',
  `is_show` int(1) NOT NULL DEFAULT '0' COMMENT '0不显示 1显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单列表';

-- ----------------------------
-- Records of admin_menu
-- ----------------------------

-- ----------------------------
-- Table structure for admin_news
-- ----------------------------
DROP TABLE IF EXISTS `admin_news`;
CREATE TABLE `admin_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsName` varchar(50) DEFAULT NULL COMMENT '文章标题',
  `newsAuthor` varchar(10) DEFAULT NULL COMMENT '文章作者',
  `newsTime` date DEFAULT NULL COMMENT '发布时间',
  `createTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键字',
  `textarea` varchar(255) DEFAULT NULL COMMENT '内容摘要',
  `content` text COMMENT '文章内容',
  `newsCid` int(11) DEFAULT NULL COMMENT '所属分类ID',
  `isShow` int(1) DEFAULT '0' COMMENT '展示 1:展示 0：不展示',
  `newsStatus` int(1) DEFAULT '0' COMMENT '审核 1:通过 0：不通过',
  `tuijian` int(1) DEFAULT '0' COMMENT '推荐 1:推荐 0：不推荐',
  `total` int(11) DEFAULT '0' COMMENT '访问量',
  PRIMARY KEY (`id`),
  KEY `newsCid` (`newsCid`),
  CONSTRAINT `newsCid` FOREIGN KEY (`newsCid`) REFERENCES `admin_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='文章';

-- ----------------------------
-- Records of admin_news
-- ----------------------------
INSERT INTO `admin_news` VALUES ('1', 'Git——git 上传时 遗漏文件解决办法', 'admin', '2018-02-12', '2018-02-12 11:08:15', 'git', '今天在Server上建立一个git 库，把本地的code 上传到Server，再次clone下来时，发现少了些文件。原来git 工具不上上传一些二进制，pdf，.patch等一些文件。在上传时，git会把这些文件标志为.gitignore文件。', '<p>&nbsp;今天在Server上建立一个git 库，把本地的code 上传到Server，再次clone下来时，发现少了些文件。原来git 工具不上上传一些二进制，pdf，.patch等一些文件。在上传时，git会把这些文件标志为.gitignore文件。所以，我们在上传完文件，使用如下命令检查下：</p><p><br></p><pre name=\"code\" class=\"html\">find ./ -name \"*.gitignore\"</pre><p><br></p><p>一旦发现有文件被标志为.gitignore。需要删除：</p><pre name=\"code\" class=\"html\">find ./ -name \"*.gitignore\"  | xargs  rm</pre><p><br></p><p>然后</p><pre name=\"code\" class=\"html\">git status</pre><p>最后把遗漏的文件再次上传一下。&nbsp;<br></p>', '10', '1', '0', '0', '1');
INSERT INTO `admin_news` VALUES ('2', 'yum安装出现“/var/run/yum.pid 已被锁定”', 'admin', '2018-02-12', '2018-02-12 11:11:52', ' yum  Liunx', '在进行yum安装时出现如下错误:已加载插件：fastestmirror,langpacks/var/run/yum.pid已被锁定，PID为98081的另一个程序正在运行。Anotherappiscurrentlyholdingt', '<div id=\"art_desc\"><div class=\"intro\">在进行yum安装时出现如下错误:已加载插件：fastestmirror,langpacks/var/run/yum.pid已被锁定，PID为98081的另一个程序正在运行。Anotherappiscurrentlyholdingt</div></div><div id=\"con_all\"><div id=\"con_ad1\"></div><div id=\"con_ad8\"></div></div><p>在进行yum安装时出现如下错误:</p><p><br></p><p>已加载插件：fastestmirror, langpacks</p><p>/var/run/yum.pid 已被锁定，PID 为 98081 的另一个程序正在运行。</p><p>Another app is currently holding the yum lock; waiting for it to exit...</p><p>&nbsp; 另一个应用程序是：PackageKit</p><p>&nbsp; &nbsp; 内存： 99 M RSS （982 MB VSZ）</p><p>&nbsp; &nbsp; 已启动： Thu Sep 17 14:32:44 2015 - 58:52之前</p><p>&nbsp; &nbsp; 状态 &nbsp;：睡眠中，，进程ID：98081</p><p><br></p><p>解决方法:</p><p><span>#&nbsp;rm&nbsp;-rf&nbsp;/var/run/yum.pid</span></p><p>使用该命令将其删除即可重新运行，进行yum安装。</p>', '5', '1', '0', '0', '0');
INSERT INTO `admin_news` VALUES ('3', '解决centos7出现了 license information', 'admin', '2018-02-12', '2018-03-01 15:55:29', 'centos7 Liunx', '解决centos7出现了 license information', '<p>第一次安装之后 重新启动之后出现了 license information</p><p>具体的解决方法贴上&nbsp;<br>只需要同意许可即可&nbsp;<br>按照如下步骤操作：&nbsp;<br>输入1-回车-2-回车-c-回车-c回车&nbsp;<br>问题成功解决</p>', '5', '1', '0', '0', '7');
INSERT INTO `admin_news` VALUES ('4', '解决shell命令行只显示-bash-4.1#不显示用户和路径方法', 'admin', '2018-02-12', '2018-02-26 12:51:51', 'Vim ', '今天一不小心打了home目录删除命令，虽然最后因为种种原因没有删掉，但是home目录下很多文件和目录都被删了，而且命令行也不显示当前用户和路径了。', '<div>今天一不小心打了home目录删除命令，虽然最后因为种种原因没有删掉，但是home目录下很多文件和目录都被删了，而且命令行也不显示当前用户和路径了。</div><div></div><div>&nbsp;</div><div>下面对其重新设置，需要设置两个文件：~/.bashrc和~/.bash_profile</div><div>&nbsp;</div><div>1. bashrc</div><div>在当前目录下新建.bashrc文件：</div><div># touch ~/.bashrc</div><div># vim&nbsp;<span>~/.bashrc</span></div><div>&nbsp;</div><div><span>并输入以下数据</span></div><div># .bashrc</div><div>&nbsp;</div><div># Source global definitions</div><div>if [ -f /etc/bashrc ]; then</div><div>&nbsp; &nbsp; &nbsp; &nbsp; . /etc/bashrc</div><div>fi</div><div># User specific aliases and functions</div><div></div><div>&nbsp;</div><div>source以下使得其生效：</div><div># source&nbsp;<span>~/.bashrc</span></div><div>&nbsp;</div><div>&nbsp;</div><div><span>2. bash_profile</span></div><div><div>在当前目录下新建.bash_profile文件：</div><div># touch ~/.bash_profile</div><div># vim&nbsp;~/.bash_profile</div><div>&nbsp;</div><div>并输入以下数据</div># .bash_profile</div><div>&nbsp;</div><div><span># Get the aliases and functions</span></div><div><span>if [ -f ~/.bashrc ]; then</span></div><div><span>&nbsp; &nbsp; &nbsp; &nbsp; . ~/.bashrc</span></div><div><span>fi</span></div><div></div><div>&nbsp;</div><div><div>source以下使得其生效：</div><div># source&nbsp;~/.bash_profile</div><div>&nbsp;</div><div></div><div>可以看到已经能成功显示当前用户和路径了。</div><div>&nbsp;</div><div>===========华丽丽的分割线============</div>如果你存在这两个目录，但还是显示-bash-4.1#，可以参考以下方案（该方案摘自网上，为进行验证）</div><div>&nbsp;</div><div>步骤如下:</div><div>&nbsp;</div><div>vim ~/.bash_profile</div><div><span>（不用管.bash_profile这个文件有几个，自己新建一个也是可以的）&nbsp;</span></div><div>&nbsp;</div><div>在最后加上</div><div>export PS1=\'[\\u@\\h \\W]\\$\'</div><div>&nbsp;</div><div>然后执行</div><div>source ~/.bash_profile</div><div>&nbsp;</div><div>这样shell就可以显示路径了。</div>', '10', '1', '0', '1', '2');
INSERT INTO `admin_news` VALUES ('5', '找回丢失的 Github 血泪史（谨慎保管 2FA 验证）', 'admin', '2018-02-12', '2018-02-24 09:07:50', 'Github ', '我丢失了 Github 账号', '<p>从前天，经过了两天时间与 Github 客服对话，终于找回了我的 Github。</p><p>朋友在问我为什么登陆不了 Github 的时候表示不太理解。</p><p>原因很简单，因为我丢失了两步验证的 app，也丢失了 recovery code。</p><h2>2FA 和基于时间戳的实时验证码</h2><p>其实，是这样的。Github 也有两步验证（2FA），提供了两种可选方式：</p><ol><li>使用手机接收短信</li><li>使用由时间戳生成的 2FA 实时验证码生成</li></ol><p>由于方法 1 无法支持国内的手机号，所以只能使用方法 2。</p><p>方法二的原理是，Github 会提供一个秘钥，通常以二维码的方式显示，用三方软件比如 Autenticator、1password（当时我不知道 1password 也可以） 在扫码之后，将秘钥保存到客户端。</p><p>在用户登陆的时候，app 会以秘钥和时间戳为参数，通过固定算法生成一个 6 位数字的一次验证码。</p><p>服务端通过同样的算法也会生成一个同样的一次性验证码，两者对比一致，则通过验证。和手机短信接收验证码很类似。</p><p>Github 在开启 2FA 的同时，会提供给你一份 recovery code，如果你无法拿到一次验证码，就使用 recovery code 暂时通过验证。recovery code 只能使用一次，使用过一次以后，就会被更新，你需要保存新的 recovery code。</p><p>当时我选择验证码生成 app 是 Google 的 Autenticator。就是这个 app 坑了我。这个 app 不需要登陆，我直接扫码就记录了，但是我当时用的 iPhone 6，在更换了 iPhone 7 之后，iPhone 6 借给他人使用前做了抹除，So，我没有了 app，只能通过 recovery code 恢复，但是奇怪的事，我使用三个月内我印象里最新的 recovery code 去验证，但是失败了。</p><p>在彻底折腾一番发现没办法后，去联系了 Github 客服。</p><h2>Github 客服</h2><p>当你没有 2FA app，也丢失了 recovery code 之后，你必须去联系客服，请求帮助你关闭 2FA。</p><p>这时候客服会要求你运行一段 command，以证明的电脑使用过此账号的公钥。</p><pre class=\"hljs nginx\"><span class=\"hljs-attribute\">ssh</span> -T git<span class=\"hljs-variable\">@github</span>.com verify\n</pre><p>但是我怎样也得不到结果，要么提示 DNS 劫持（和公司的网络翻墙了有关），要么其他的种种问题。</p><p>在和 Github 客服一番对话后，对方表示验证的 ssh 公钥是应由 Github Destop 软件生成了。当时很懵逼，问对方『难道我自己生成的秘钥就不是秘钥了？难道不能证明我电脑生成的这个公钥？』。然后客服就说『你 2015 年用一台 Macbook Pro 生成了一个公钥，这是你的电脑吗？』，然后 run 一下：</p><pre class=\"hljs nginx\"><span class=\"hljs-attribute\">ssh</span> -i ~/.ssh/github_rsa -T git<span class=\"hljs-variable\">@github</span>.com verify\n</pre><p>然后 run 之后：</p><pre class=\"hljs vbnet\">Enter passphrase <span class=\"hljs-keyword\">for</span> <span class=\"hljs-keyword\">key</span> <span class=\"hljs-comment\">\'/Users/zhoulingyu/.ssh/github_rsa\':</span>\n</pre><p>当时我想了一下，傻傻的输入了 Github 密码，然而不对。然后我让几个朋友 run 了一下，均是直接显示出了 verification token。我很奇怪，于是想了一下，发现这里要求输入的密码应该是当初生成公钥的时候设置的密码，通常很多人都会选择不设置密码，但是我显然当初设置了，然而我记不起来。</p><p>一番搜索之后，得到了一个 happy 的结果，如果你是 windows，那洗洗睡吧，如果是 Mac，这个密码可以在 keychain 中找到，具体方法在&nbsp;<a href=\"https://help.github.com/articles/recovering-your-ssh-key-passphrase/\" target=\"_blank\" rel=\"nofollow,noindex\">这里</a>&nbsp;。</p><p>我从 keychain 中粘出密码后我就惊呆了，是一个 40 多位的密码。显然是自动生成的高复杂度密码。我当时一定是忘了保存。</p><p>SO，拿到 verification token 之后，Github 客服就帮我关掉了 2FA。</p><p>随后，我发现 1password 是可以生成一次性验证码的，于是使用 1password 保存，不在使用 Google 的 app。</p>', '10', '1', '0', '0', '1');
INSERT INTO `admin_news` VALUES ('6', 'PHP代码优化的40条建议', 'admin', '2018-02-12', '2018-02-12 11:28:49', 'php', '作为一个php程序员们必须知道的PHP代码优化的40条建议： ', '<p><font size=\"3\"><font face=\"宋体, SimSun \">1.如果一个方法可静态化，就对它做静态声明。速率可提升至4倍。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">2.echo 比 print 快。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">3.使用echo的多重参数(译注：指用逗号而不是句点)代替字符串连接。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">4.在执行for循环之前确定最大循环数，不要每循环一次都计算最大值。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">5.注销那些不用的变量尤其是大数组，以便释放内存。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">6.尽量避免使用__get，__set，__autoload。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">7.require_once()代价昂贵。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">8.在包含文件时使用完整路径，<span id=\"rlt_15\">解析</span><span id=\"rlt_12\">操作</span><span id=\"rlt_11\">系统</span>路径所需的时间会更少。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">9.如果你想知道脚本开始执行(译注：即<span id=\"rlt_1\"><span id=\"rlt_2\"><span id=\"rlt_7\">服务</span></span>器</span>端收到客户端请求)的时刻，使用$_SERVER[\'REQUEST_TIME\']要好于time()。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">10.函数代替正则表达式完成相同功能。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">11.str_replace函数比preg_replace函数快，但strtr函数的效率是str_replace函数的四倍。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">12.如果一个字符串替换函数，可接受数组或字符作为参数，并且参数长度不太长，那么可以考虑额外写一段替换代码，使得每次传递参数是一个字符，而不是只写一行代码接受数组作为查询和替换的参数。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">13.使用选择分支语句(译注：即switch case)好于使用多个if，else if语句。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">14.用@屏蔽<span id=\"rlt_4\"><span id=\"rlt_9\">错误</span></span>消息的做法非常低效。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">15.打开apache的mod_deflate模块。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">16.数据库连接当使用完毕时应关掉。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">17.$row[\'id\']的效率是$row[id]的7倍。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">18.错误消息代价昂贵。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">19.尽量不要在for循环中使用函数，比如for ($x=0; $x &lt; count($array); $x)每循环一次都会调用count()函数。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">20.在方法中递增局部变量，速度是最快的。几乎与在函数中调用局部变量的速度相当。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">21.递增一个全局变量要比递增一个局部变量慢2倍。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">22.递增一个对象属性(如：$this-&gt;prop++)要比递增一个局部变量慢3倍。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">23.递增一个未预定义的局部变量要比递增一个预定义的局部变量慢9至10倍。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">24.仅定义一个局部变量而没在函数中调用它，同样会减慢速度(其程度相当于递增一个局部变量)。PHP大概会检查看是否存在全局变量。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">25.方法调用看来与类中定义的方法的数量无关，因为我(在测试方法之前和之后都)添加了10个方法，但性能上没有变化。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">26.派生类中的方法运行起来要快于在基类中定义的同样的方法。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">27.调用带有一个参数的空函数，其花费的时间相当于执行7至8次的局部变量递增操作。类似的方法调用所花费的时间接近于15次的局部变量递增操作。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">28.用单引号代替双引号来包含字符串，这样做会更快一些。因为PHP会在双引号包围的字符串中搜寻变量，单引号则不会。当然，只有当你不需要在字符串中包含变量时才可以这么做。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">29.输出多个字符串时，用逗号代替句点来分隔字符串，速度更快。注意：只有echo能这么做，它是一种可以把多个字符串当作参数的\"函数\"(译注：PHP手册中说echo是语言结构，不是真正的函数，故把函数加上了双引号)。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">30.Apache解析一个PHP脚本的时间要比解析一个静态HTML页面慢2至10倍。尽量多用静态HTML页面，少用脚本。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">31.除非脚本可以缓存，否则每次调用时都会重新编译一次。引入一套PHP缓存机制通常可以提升25%至100%的性能，以免除编译开销。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">32.尽量做缓存，可使用memcached。memcached是一款高性能的内存对象缓存系统，可用来加速动态Web应用程序，减轻<span id=\"rlt_3\"><span id=\"rlt_8\"><span id=\"rlt_13\">数据</span>库</span></span>负载。对运算码 (OP code)的缓存很有用，使得脚本不必为每个请求做重新编译。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">33.当操作字符串并需要检验其长度是否满足某种要求时，你想当然地会使用strlen()函数。此函数执行起来相当快，因为它不做任何计算，只返回在zval结构(C的内置数据结构，用于存储PHP变量)中存储的已知字符串长度。但是，由于strlen()是函数，多多少少会有些慢，因为函数调用会经过诸多步骤，如字母小写化(译注：指函数名小写化，PHP不区分函数名大小写)、哈希查找，会跟随被调用的函数一起执行。在某些情况下，你可以使用isset()技巧加速执行你的代码。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">(举例如下)</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">if (strlen($foo) &lt; 5) { echo \"Foo is too short\"; }</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">(与下面的技巧做比较)</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">if (!isset($foo{5})) { echo \"Foo is too short\"; }</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">调用isset()恰巧比strlen()快，因为与后者不同的是，isset()作为一种语言结构，意味着它的执行不需要函数查找和字母小写化。也就是说，实际上在检验字符串长度的顶层代码中你没有花太多开销。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">34.当执行变量$i的递增或递减时，$i++会比++$i慢一些。这种差异是PHP特有的，并不适用于其他语言，所以请不要<span id=\"rlt_14\">修改</span>你的C或Java代码并指望它们能立即变快，没用的。++$i更快是因为它只需要3条指令(opcodes)，$i++则需要4条指令。后置递增实际上会产生一个临时变量，这个临时变量随后被递增。而前置递增直接在原值上递增。这是最优化处理的一种，正如Zend的PHP优化器所作的那样。牢记这个优化处理不失为一个好主意，因为并不是所有的指令优化器都会做同样的优化处理，并且存在大量没有装配指令优化器的互联网服务提供商(ISPs)和<span id=\"rlt_6\">服务器</span>。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">35.并不是事必面向对象(OOP)，面向对象往往开销很大，每个方法和对象调用都会消耗很多内存。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">36.并非要用类实现所有的数据结构，数组也很有用。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">37.不要把方法细分得过多，仔细想想你真正打算重用的是哪些代码?</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">38.当你需要时，你总能把代码分解成方法。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">39.尽量采用大量的PHP内置函数。</font></font><span>&nbsp;</span><br><font size=\"3\"><font face=\"宋体, SimSun \">40.如果在代码中存在大量耗时的函数，你可以考虑用C扩展的方式实现它们。</font></font></p>', '4', '1', '0', '0', '4');

-- ----------------------------
-- Table structure for admin_test
-- ----------------------------
DROP TABLE IF EXISTS `admin_test`;
CREATE TABLE `admin_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_test
-- ----------------------------
INSERT INTO `admin_test` VALUES ('1', 'thinkphp', '10');
INSERT INTO `admin_test` VALUES ('2', 'thinkphp', '10');
INSERT INTO `admin_test` VALUES ('3', 'thiasdnkphp', '10');

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2017-12-28 14:24:29');
