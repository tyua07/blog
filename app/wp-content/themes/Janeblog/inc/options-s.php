<?php         
class ClassicOptions {            
    function getOptions() {
        $options = get_option('classic_options'); 
        if (!is_array($options)) { 
            $options['jane_keywords'] = ''; 
            $options['jane_description'] = ''; 
            $options['jane_menu'] = ''; 
            $options['jane_user'] = ''; 
            $options['jane_banner'] = ''; 
            $options['jane_banner_link'] = ''; 
            $options['jane_img1'] = ''; 
            $options['jane_img2'] = ''; 
            $options['jane_img3'] = ''; 
            $options['jane_img4'] = ''; 
            $options['jane_img5'] = ''; 
            $options['jane_img1_title'] = ''; 
            $options['jane_img2_title'] = ''; 
            $options['jane_img3_title'] = ''; 
            $options['jane_img4_title'] = ''; 
            $options['jane_img5_title'] = ''; 
            $options['jane_img1_link'] = ''; 
            $options['jane_img2_link'] = ''; 
            $options['jane_img3_link'] = ''; 
            $options['jane_img4_link'] = ''; 
            $options['jane_img5_link'] = ''; 
            $options['jane_links'] = ''; 
            $options['jane_beian'] = '';
            $options['jane_tongji'] = ''; 
            update_option('classic_options', $options);         
        }   
        return $options;  
    }
    function init() {
        if(isset($_POST['classic_save'])) {
			$options = ClassicOptions::getOptions();
            $options['jane_keywords'] = stripslashes($_POST['jane_keywords']);
            $options['jane_description'] = stripslashes($_POST['jane_description']);
            $options['jane_menu'] = stripslashes($_POST['jane_menu']);
            $options['jane_user'] = stripslashes($_POST['jane_user']);
            $options['jane_banner'] = stripslashes($_POST['jane_banner']);
            $options['jane_banner_link'] = stripslashes($_POST['jane_banner_link']);
            $options['jane_img1'] = stripslashes($_POST['jane_img1']);
            $options['jane_img2'] = stripslashes($_POST['jane_img2']);
            $options['jane_img3'] = stripslashes($_POST['jane_img3']);
            $options['jane_img4'] = stripslashes($_POST['jane_img4']);
            $options['jane_img5'] = stripslashes($_POST['jane_img5']);
            $options['jane_img1_title'] = stripslashes($_POST['jane_img1_title']);
            $options['jane_img2_title'] = stripslashes($_POST['jane_img2_title']);
            $options['jane_img3_title'] = stripslashes($_POST['jane_img3_title']);
            $options['jane_img4_title'] = stripslashes($_POST['jane_img4_title']);
            $options['jane_img5_title'] = stripslashes($_POST['jane_img5_title']);
            $options['jane_img1_link'] = stripslashes($_POST['jane_img1_link']);
            $options['jane_img2_link'] = stripslashes($_POST['jane_img2_link']);
            $options['jane_img3_link'] = stripslashes($_POST['jane_img3_link']);
            $options['jane_img4_link'] = stripslashes($_POST['jane_img4_link']);
            $options['jane_img5_link'] = stripslashes($_POST['jane_img5_link']);
            $options['jane_links'] = stripslashes($_POST['jane_links']);
            $options['jane_beian'] = stripslashes($_POST['jane_beian']);
            $options['jane_tongji'] = stripslashes($_POST['jane_tongji']);
            update_option('classic_options', $options);   
        } else {   
            ClassicOptions::getOptions();         
        }   
        add_theme_page("Theme Options", "JaneBlog主题设置", 'edit_themes', basename(__FILE__), array('ClassicOptions', 'display'));         
    } 
    function display() {   
        wp_enqueue_script('my-upload', get_bloginfo( 'stylesheet_directory' ) . '/js/upload.js'); 
		wp_enqueue_style('my-upload', get_bloginfo('stylesheet_directory') . '/inc/options.css');
        wp_enqueue_script('thickbox');   
        wp_enqueue_style('thickbox');   
        $options = ClassicOptions::getOptions(); 
		?>

<form method="post" enctype="multipart/form-data" name="classic_form" id="classic_form">
  <!-- 设置内容 -->
  <div class="options">
    <div class="options-title">
      <h3><span>JaneBlog</span> 主题设置:&nbsp;&nbsp;&nbsp;&nbsp; 发布来源于: <a target="_blank" href="http://119800.com/">美朵网</a></h3>
      <p>本主题JaneBlog怀着分享精神，基于CC协议分享给大家；请大家到<a target="_blank" href="http://119800.com/">美朵网</a>下载试用转载修改，只要保留页脚版权即可。主题交流群：263555652 欢迎大家提意见或建议。</p>
    </div>
    <div class="tabPanel">
      <ul>
        <li class="hit">基本设置</li>
        <li>SEO设置</li>
        <li>底部设置</li>
        <li>AD广告</li>
      </ul>
      <div class="panes">
        <div class="pane" style="display:block;">
          <div class="section">
            <h4 class="heading">菜单设置</h4>
            <div class="option">
              <div class="controls">
                <input type="radio" name="jane_menu" value="1" <?php if ($options['jane_menu'] == '1'){ echo 'checked="checked"';} ?>/>
                <label>是隐藏&nbsp;&nbsp;&nbsp;</label>
                <input type="radio" name="jane_menu" value="0" <?php if ($options['jane_menu'] == '0'){ echo 'checked="checked"';} ?>/>
                <label>不隐藏 </label>
              </div>
              <div class="explain">设置菜单导航默认是隐藏。</div>
            </div>
          </div>
          <div class="section">
            <h4 class="heading">首页头像设置(83x83)</h4>
            <div class="option">
              <div class="controls">
                <?php 
				if($options['jane_user'] != ''){   
					echo '<span class="jane_user"><img src='.$options['jane_user'].' alt="" /></span>';   
				}   
				?>
                <input type="text" class="upload" name="jane_user" value="<?php echo($options['jane_user'] ) ?>"/>
                <input type="button" class="button jane_button" value="上传"/>
              </div>
              <div class="explain">首页头像设置上传。</div>
            </div>
          </div>
          <div class="section">
            <h4 class="heading">幻灯设置(固定5幅图494x280)</h4>
            <div class="option">
              <div class="controls">
                <?php   
				if($options['jane_img1'] != ''){   
					echo '<span class="jane_img"><img src='.$options['jane_img1'].' alt="" /></span>';   
				}   
				?>
                <input type="text" class="upload" name="jane_img1" value="<?php echo($options['jane_img1']) ?>"/>
                <input type="button" class="button jane_button" value="上传"/>
                <input type="text" class="upload" name="jane_img1_title" value="<?php echo($options['jane_img1_title']) ?>"/>
                <input type="text" class="upload" name="jane_img1_link" value="<?php echo($options['jane_img1_link']) ?>"/>
              </div>
              <div class="explain">幻灯1：图片上传，标题填写，网址址写。</div>
            </div>
            <div class="option">
              <div class="controls">
                <?php    
				if($options['jane_img2'] != ''){   
					echo '<span class="jane_img"><img src='.$options['jane_img2'].' alt="" /></span>';   
				}   
				?>
                <input type="text" class="upload" name="jane_img2" value="<?php echo($options['jane_img2']) ?>"/>
                <input type="button" class="button jane_button" value="上传"/>
                <input type="text" class="upload" name="jane_img2_title" value="<?php echo($options['jane_img2_title']) ?>"/>
                <input type="text" class="upload" name="jane_img2_link" value="<?php echo($options['jane_img2_link']) ?>"/>
              </div>
              <div class="explain">幻灯2：图片上传，标题填写，网址址写。</div>
            </div>
            <div class="option">
              <div class="controls">
                <?php   
				if($options['jane_img3'] != ''){   
					echo '<span class="jane_img"><img src='.$options['jane_img3'].' alt="" /></span>';   
				}   
				?>
                <input type="text" class="upload" name="jane_img3" value="<?php echo($options['jane_img3']) ?>"/>
                <input type="button" class="button jane_button" value="上传"/>
                <input type="text" class="upload" name="jane_img3_title" value="<?php echo($options['jane_img3_title']) ?>"/>
                <input type="text" class="upload" name="jane_img3_link" value="<?php echo($options['jane_img3_link']) ?>"/>
              </div>
              <div class="explain">幻灯3：图片上传，标题填写，网址址写。</div>
            </div>
            <div class="option">
              <div class="controls">
                <?php   
				if($options['jane_img4'] != ''){   
					echo '<span class="jane_img"><img src='.$options['jane_img4'].' alt="" /></span>';   
				}   
				?>
                <input type="text" class="upload" name="jane_img4" value="<?php echo($options['jane_img4']) ?>"/>
                <input type="button" class="button jane_button" value="上传"/>
                <input type="text" class="upload" name="jane_img4_title" value="<?php echo($options['jane_img4_title']) ?>"/>
                <input type="text" class="upload" name="jane_img4_link" value="<?php echo($options['jane_img4_link']) ?>"/>
              </div>
              <div class="explain">幻灯4：图片上传，标题填写，网址址写。</div>
            </div>
            <div class="option">
              <div class="controls">
                <?php   
				if($options['jane_img5'] != ''){   
					echo '<span class="jane_img"><img src='.$options['jane_img5'].' alt="" /></span>';   
				}   
				?>
                <input type="text" class="upload" name="jane_img5" value="<?php echo($options['jane_img5']) ?>"/>
                <input type="button" class="button jane_button" value="上传"/>
                <input type="text" class="upload" name="jane_img5_title" value="<?php echo($options['jane_img5_title']) ?>"/>
                <input type="text" class="upload" name="jane_img5_link" value="<?php echo($options['jane_img5_link']) ?>"/>
              </div>
              <div class="explain">幻灯5：图片上传，标题填写，网址址写。</div>
            </div>
          </div>
        </div>
        <div class="pane">
          <div class="section">
            <h4 class="heading">网站关键字设置</h4>
            <div class="option">
              <div class="controls">
                <textarea rows="3" class="upload" name="jane_keywords"><?php echo($options['jane_keywords']);?></textarea>
              </div>
              <div class="explain">这栏填写网站的关键字。</div>
            </div>
          </div>
          <div class="section">
            <h4 class="heading">网站描述设置</h4>
            <div class="option">
              <div class="controls">
                <textarea rows="8" class="upload" type="text"  name="jane_description"><?php echo($options['jane_description']);?></textarea>
              </div>
              <div class="explain">这栏填写网站的站点描述。</div>
            </div>
          </div>
        </div>
        <div class="pane">
          <div class="section">
            <h4 class="heading">友情链接设置</h4>
            <div class="option">
              <div class="controls">
                <textarea rows="8" class="upload" type="text"  name="jane_links"><?php echo($options['jane_links']);?></textarea>
              </div>
              <div class="explain">这栏填写友情链接，例如：〈a target="_blank" href="www.abc.com"〉abc网站〈/a〉可多个。</div>
            </div>
          </div>
          <div class="section">
            <h4 class="heading">统计代码</h4>
            <div class="option">
              <div class="controls">
                <textarea rows="2" class="upload" type="text"  name="jane_tongji"><?php echo($options['jane_tongji']); ?></textarea>
              </div>
              <div class="explain">这栏是填写统计代码</div>
            </div>
          </div>
          <div class="section">
            <h4 class="heading">备案号代码</h4>
            <div class="option">
              <div class="controls">
                <textarea rows="2" class="upload" type="text"  name="jane_beian"><?php echo($options['jane_beian']);?></textarea>
              </div>
              <div class="explain">这栏填写备案号代码。</div>
            </div>
          </div>
        </div>
        <div class="pane">
          <div class="section">
            <h4 class="heading">首页banner广告设置(760x80)</h4>
            <div class="option">
              <div class="controls">
                <?php    
				if($options['jane_banner'] != ''){   
					echo '<span class="jane_banner"><img src='.$options['jane_banner'].' alt="" /></span>';   
				}   
				?>
                <input type="text" class="upload" name="jane_banner" value="<?php echo($options['jane_banner']) ?>"/>
                <input type="button" class="button jane_button" value="上传"/>
              </div>
              <div class="explain">首页banner广告设置上传。</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- TODO: 在这里追加其他选项内容 -->
    <div class="submit">
      <input type="submit"  class="button button-primary button-large" name="classic_save" value="<?php _e('保存设置') ?>" />
    </div>
  </div>
</form>
<?php         
    }         
} 
add_action('admin_menu', array('ClassicOptions', 'init'));  
?>
