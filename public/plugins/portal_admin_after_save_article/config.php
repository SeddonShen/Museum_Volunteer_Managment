<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tanray Yong
 * Date: 2018-11-13
 * Time: 8:16
 */
return array(
    'auto_publish' => array(// 在后台插件配置表单中的键名 ,会是config[text]
        'title' => '文章自动发布', // 表单的label标题
        'type' => 'radio',// 表单的类型：text,password,textarea,checkbox,radio,select等
        'options' => [
            '1' => '是',
            '0' => '否'
        ],
        'value' => '1',// 表单的默认值
        'tip' => '选择是，文章保存之后自动发布，无需再执行"编辑->发布->保存"流程' //表单的帮助提示
    ),
    'auto_excerpt' => array(// 在后台插件配置表单中的键名 ,会是config[text]
        'title' => '自动截取文章摘要', // 表单的label标题
        'type' => 'text',// 表单的类型：text,password,textarea,checkbox,radio,select等
        'value' => '100',// 表单的默认值
        'tip' => '截取文章内容的字符数，留空则不截取' //表单的帮助提示
    ),
    'auto_thumbnail' => array(// 在后台插件配置表单中的键名 ,会是config[text]
        'title' => '自动生成文章缩略图', // 表单的label标题
        'type' => 'radio',// 表单的类型：text,password,textarea,checkbox,radio,select等
        'options' => [
            '1' => '是',
            '0' => '否'
        ],
        'value' => '1',// 表单的默认值
        'tip' => '选择是，文章保存之后自动获取正文第一个图片作为缩略图' //表单的帮助提示
    ),
);