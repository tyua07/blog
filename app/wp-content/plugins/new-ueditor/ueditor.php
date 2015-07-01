<?php
/**
 * Plugin Name: UEditor
 * Plugin URI: http://wordpress.org/extend/plugins/ck-and-syntaxhighlighter/
 * Version: 1.2.0
 * Author: taoqili
 * Author URI: http://www.taoqili.com
 * Description: 强大的百度开源富文本编辑器UEditor正式登陆wordpress！
 * 由于编辑器的特殊性，本插件的安装使用需要注意以下事项：
 * 1、插件安装好之后，还需要修改edit-form-advanced.php文件中关于编辑器容器的代码。
 * 2、插件目录下的ue-edit-form-advanced.php中是已经修改好的对应文件，适用于wp3.1版本，其他版本请搜索"UEditor"字符去寻找对应位置之后替换即可。
 * 3、如需修改编辑器的各种行为，可直接修改插件主文件下方实例化对象时传入的参数即可，参数名称请参考editor_config.js文件。
 * 4、此版本暂不支持自动保存功能。关闭默认的自动保存及自动草稿方法可参考网上资料，此处不再详述。
 * 5、不需要使用编辑器时，直接停用即可恢复默认编辑器。
 */
@include_once( dirname( __FILE__ ) . "/ueditor/ueditor.class.php" );
if ( class_exists( "UEditor" ) ) {
    $ue = new UEditor("postdivrich",array(
        //此处可以配置编辑器的所有配置项，配置方法同editor_config.js
        "focus"=>true,
        "textarea"=>"content",
        "zIndex"=>1
    ));
    register_activation_hook( __FILE__, array(  &$ue, 'ue_closeDefaultEditor' ) );
    register_deactivation_hook( __FILE__, array(  &$ue, 'ue_openDefaultEditor' ) );
    add_action("wp_head",array(&$ue,'ue_importSyntaxHighlighter'));
    add_action("wp_footer",array(&$ue,'ue_syntaxHighlighter'));
    add_action("admin_head",array(&$ue,'ue_importUEditorResource'));
    add_action('edit_form_advanced', array(&$ue, 'ue_renderUEditor'));
    add_action('edit_page_form', array(&$ue, 'ue_renderUEditor'));
    add_action( 'plugins_unload', array(&$ue, 'ue_openDefaultEditor'));

}
?>