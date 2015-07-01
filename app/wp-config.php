<?php
/**
 * WordPress基础配置文件。
 *
 * 本文件包含以下配置选项：MySQL设置、数据库表名前缀、密钥、
 * WordPress语言设定以及ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 * 编辑wp-config.php}Codex页面。MySQL设置具体信息请咨询您的空间提供商。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以手动复制这个文件，并重命名为“wp-config.php”，然后填入相关信息。
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'blog');

/** MySQL数据库用户名 */
define('DB_USER', 'laravel');

/** MySQL数据库密码 */
define('DB_PASSWORD', '$8CDsAdrJvIA$XwV');

/** MySQL主机 */
define('DB_HOST', '127.0.0.1');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'OH/`Vbv{?N[>U4y$-uYCJ%l]@J8&~)[TZC=TX;h`l8u#<G9y6_q#Cx}(SL(`}2rN');
define('SECURE_AUTH_KEY',  'Ln@D+b1%3Ubd5c%`P?GkYTT24+V2;mRXh:uO.%OQ|_FBN=Ts~ReZ-v8H*YZ&hiuD');
define('LOGGED_IN_KEY',    'Xsfi[(c(|9,|+ >R-#^bM#tpo&n_zA+rjNC~O4T9?g3||qzud|5#]}x7kg|&L;9p');
define('NONCE_KEY',        'N@;J5rPbNr4=i%;v:cp<`2Y|IM}O+!$I9mxeww0uOR3{/+Evk[SBjsu5c,INmfNr');
define('AUTH_SALT',        'jot&IA`].6GEAA_YIXjanHYiX85;[yE}VFDTgX1%S;JK~~<J%Zz61^-gV|u`^%9t');
define('SECURE_AUTH_SALT', '9|cvY8?{L>ti*X0qC8@+D^?ct}h(Y3aq0RNE|F2+d&Oi()Yb g=v|r 3_ $qZf^|');
define('LOGGED_IN_SALT',   'D0T>GAcQJapP]}`ig3+gFhGO{X`_6qv>WH|gYyzz$JM}@u2E6.V$V,.joN}|8,-K');
define('NONCE_SALT',       '>CqwC!QDL9hES<K+)1@]G8JB/ELmLHN]J76km4r+@^Z}V9$|e79%.F9wxiFB1Q6e');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'blog_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
