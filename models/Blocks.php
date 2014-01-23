<?php
/**
 * Jobskee - open source job board 
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 * 
 * Blocks class handles managing block content
 */

class Blocks
{
    
    public function __construct()
    { 
    
    }
    
    public function showBlockList($start, $limit)
    {
        $blocks = R::findAll('blocks', " ORDER BY name ASC LIMIT :start, :limit ", array(':start'=>$start, ':limit'=>$limit));
        return $blocks;
    }
    
    public static function showBlock($id)
    {
        $block = R::load('blocks', $id);
        if (isset($block) && $block->id) {
            return $block;
        }
        return false;
    }
    
    public static function showBlockByID($id)
    {
        $block = R::load('blocks', $id);
        if (isset($block) && $block->id) {
            echo $block->content;
        }
        return false;
    }
    
    public static function showBlockBySlug($name)
    {
        $block = R::findOne('blocks', " url=:url ", array(':url'=>$name));
        if (isset($block) && $block->id) {
            echo $block->content;
        }
        return false;
    }
    
    public function countBlockList()
    {
        $blocks = R::count('blocks');
        return $blocks;
    }
    
    public function addToBlockList($data)
    {
        if (isset($data['id']) && $data['id'] > 0) {
            $block = R::load('blocks', $data['id']);
        } else {
            $block = R::dispense('blocks');
        }
        $block->name = $data['name'];
        $block->url = $data['url'];
        $block->content = $data['content'];
        $id = R::store($block);
        return $id;
    }
    
    public function deleteFromBlock($id)
    {
        $block = R::load('blocks', $id);
        R::trash($block);
        return true;
    }
    
}