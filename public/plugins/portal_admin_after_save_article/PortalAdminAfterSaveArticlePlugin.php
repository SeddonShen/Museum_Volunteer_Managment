<?php

namespace plugins\portal_admin_after_save_article;

use cmf\lib\Plugin;
use think\Db;

/**
 * Created by IntelliJ IDEA.
 * User: Tanray Yong
 * Date: 2018-11-12
 * Time: 16:33
 */
class PortalAdminAfterSaveArticlePlugin extends Plugin
{
    public $info = [
        'name' => 'PortalAdminAfterSaveArticle',
        'title' => '后台文章保存之后自动处理',
        'description' => '后台文章保存之后自动处理，如：自动发布、自动截取文章摘要、自动获取文章缩略图等',
        'status' => 1,
        'author' => 'Tanray',
        'version' => '1.0'
    ];

    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return false;
    }

    //实现钩子：portal_admin_after_save_article
    public function PortalAdminAfterSaveArticle($hookParam)
    {
        trace($hookParam, 'error');
        $config = $this->getConfig();
        $updateData = array();

        //只有添加文章时执行自动发布
        if ($hookParam['is_add']) {
            //是否自动发布
            if ($config['auto_publish'] == '1') {
                $updateData['post_status'] = 1;
                $updateData['published_time'] = time();
            }
        }

        $auto_excerpt = trim($config['auto_excerpt']);
        //文章摘要为空
        if (trim($hookParam['article']['post_excerpt']) == false) {
            //是否自动截取摘要
            if (!empty($auto_excerpt)) {
                $updateData['post_excerpt'] = $this->_getSummary($hookParam['article']['post_content'], 0, $auto_excerpt);
            }
        }

        //自动获取缩略图
        if ($config['auto_thumbnail'] == '1') {
            if (empty($hookParam['article']['thumbnail'])) {
                $thumbnail = $this->_getImg($hookParam['article']['post_content']);
                $more = $hookParam['article']['more'];
                $more['thumbnail'] = $thumbnail;

                $updateData['thumbnail'] = $thumbnail;
                $updateData['more'] = json_encode($more);
            }
        }

        if (!empty($updateData)) {
            Db::name("portal_post")->where(['id' => $hookParam['article']['id']])->update($updateData);
        }
    }

    /**
     * 文章简介截取方法
     * @param $content  文章内容
     * @param int $s 开始截取位置
     * @param int $e 截取结束位置
     * @param string $char 字符编码
     * @return string
     */
    private function _getSummary($content, $s = 0, $e = 100, $char = 'utf-8')
    {
        if (empty($content)) {
            return '';
        }
        $newContent = strip_tags(htmlspecialchars_decode($content));
        $newContent = str_replace('&nbsp;', '', $newContent);
        $patternArr = array('/\s/', '/ /');
        $replaceArr = array('', '');
        $newContent = preg_replace($patternArr, $replaceArr, $newContent);
        $newContent = mb_substr($newContent, $s, $e, $char);
        return trim($newContent);
    }

    /**
     * 文章图片提取方法
     * @param $str
     * @return null
     */
    private function _getImg($str)
    {
        if (empty($str)) {
            return null;
        }
        $pattern = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
        preg_match_all($pattern, html_entity_decode($str), $match);
        return isset($match[1][0]) ? $match[1][0] : null;
    }
}