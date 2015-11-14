<?php
/**
 * Jobskee - open source job board 
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 * 
 * Cities class handles city display and management
 */

class Cities {
    
    private $_id;
    
    public function __construct($id) 
    {
        $this->_id = $id;
    }
    
    public function findCity() 
    {
        $city = R::findOne('cities', ' id=:id ', array(':id'=>$this->_id));
        return $city;
    }
    
    public function findCityJobs($start, $limit) 
    {
        $jobs = R::findAll('jobs', " status=1 AND city=:city ORDER BY created DESC LIMIT :start, :limit ", 
                            array(':city'=>$this->_id, ':start'=>$start, ':limit'=>$limit));
        return $jobs;
    }

    public function findAllCityJobs() 
    {
        $jobs = R::findAll('jobs', " status=1 AND city=:city ORDER BY created DESC LIMIT 0, 100", 
                            array(':city'=>$this->_id));
        return $jobs;
    }
    
    public function countCityJobs() {
        $count = R::count('jobs', " status=1 AND city=:city ", array(':city'=>$this->_id));
        return $count;
    }
    
    public function addCity($data)
    {
        if (isset($data['id']) && $data['id'] > 0) {
            $city = R::load('cities', $data['id']);
        } else {
            $city = R::dispense('cities');
        }
        $city->name = $data['name'];
        $city->description = $data['description'];
        $city->url = $data['url'];
        $city->sort = $data['sort'];
        $id = R::store($city);
        return $id;
    }
    
    public function deleteCity()
    {
        $count = R::count('jobs', " city=:city ", array(':city'=>$this->_id));
        if (!$count) {
            $city = R::load('cities', $this->_id);
            R::trash($city);
            return true;
        }
        return false;
    }
    
    public static function findCities() 
    {
        $cities = R::findAll('cities', ' ORDER BY sort ASC ');
        return $cities;
    }
    
}
