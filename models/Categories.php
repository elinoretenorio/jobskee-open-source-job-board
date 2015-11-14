<?php
/**
 * Jobskee - open source job board
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 * 
 * Categories class handles category display and management
 */

class Categories {
    
    private $_id;
    
    public function __construct($id) 
    {
        $this->_id = $id;
    }
    
    public function findCategory() 
    {
        $category = R::findOne('categories', ' id=:id ', array(':id'=>$this->_id));
        return $category;
    }
    
    public function findCategoryJobs($start, $limit) 
    {
        $jobs = R::findAll('jobs', " status=1 AND category=:category ORDER BY created DESC LIMIT :start, :limit ", 
                            array(':category'=>$this->_id, ':start'=>$start, ':limit'=>$limit));
        return $jobs;
    }

    public function findAllCategoryJobs() 
    {
        $jobs = R::findAll('jobs', " status=1 AND category=:category ORDER BY created DESC LIMIT 0, 100", 
                            array(':category'=>$this->_id));
        return $jobs;
    }
    
    public function countCategoryJobs() {
        $count = R::count('jobs', " status=1 AND category=:category ", array(':category'=>$this->_id));
        return $count;
    }
    
    public function addCategory($data)
    {
        if (isset($data['id']) && $data['id'] > 0) {
            $category = R::load('categories', $data['id']);
        } else {
            $category = R::dispense('categories');
        }
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->url = $data['url'];
        $category->sort = $data['sort'];
        $id = R::store($category);
        return $id;
    }
    
    public function deleteCategory()
    {
        $count = R::count('jobs', " category=:category ", array(':category'=>$this->_id));
        if (!$count) {
            $category = R::load('categories', $this->_id);
            R::trash($category);
            return true;
        }
        return false;
    }
    
    public static function findCategories() 
    {
        $categories = R::findAll('categories', ' ORDER BY sort ASC ');
        return $categories;
    }
    
}
