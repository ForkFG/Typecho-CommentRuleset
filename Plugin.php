<?php
if(!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * Typecho 评论规则集插件
 * 
 * @package CommentRuleset
 * @author wuxianucw
 * @version 1.0.0
 * @link https://ucw.moe/
 */
class CommentRuleset_Plugin implements Typecho_Plugin_Interface {
    /**
     * 激活插件
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate() {
        if(!is_dir(dirname(__FILE__) . '/runtime')) mkdir(dirname(__FILE__) . '/runtime');
        if(!file_exists(dirname(__FILE__) . '/runtime/ruleset.json')) touch(dirname(__FILE__) . '/runtime/ruleset.json');
        Typecho_Plugin::factory('Widget_Feedback')->comment = array('CommentRuleset_Plugin', 'filter');
        Helper::addPanel(1, 'CommentRuleset/control-panel.php', '评论规则集', '评论规则集管理',' administrator');
        return _t('插件启用成功，请配置评论规则集。');
    }
    
    /**
     * 禁用插件
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate() {
        Helper::removePanel(1, 'CommentRuleset/control-panel.php');
        return _t('插件已禁用，已保存的规则集自动失效但并未删除。');
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
        $panelUrl = Helper::url('CommentRuleset/control-panel.php');
        /** MDUI 加载来源 */
        $form->addInput(new Typecho_Widget_Helper_Form_Element_Radio('email', array(0 => '本地', 1 => 'jsDelivr'), 0, 'MDUI 加载来源', _t(<<<HTML
            本参数用于设置评论规则集管理页面使用到的 MDUI 相关资源的加载来源，目前提供本地源和 jsDelivr 两个选项。<br>
            如果评论规则集页面加载缓慢，可以尝试更改此项目。<br>
            如果您不知道此项目的用途，保持默认即可。（反正也不影响规则集配置）<br>
            如果您希望配置评论规则集，请移步<a href="{$panelUrl}" target="_blank">「控制台 -> 评论规则集」</a>。
HTML
        )));
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form) {}
    
    /**
     * 评论过滤
     * 
     * @access public
     * @return void
     */
    public static function filter() {
        
    }
}
