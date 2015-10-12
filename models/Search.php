<?php
/**
 * Jobskee - open source job board 
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 * 
 * Search class handles job search functionality
 */

class Search 
{
    
    public function searchJobs($terms)
    {
        global $categories;
        $terms = splitTerms($terms);
        $terms = implode('|', $terms);
        
        try {
            foreach ($categories as $cat) {
                $jobs[$cat->id] = R::findAll('jobs', " status=1 AND category=:category AND (title REGEXP :title OR description REGEXP :description OR perks REGEXP :perks OR how_to_apply REGEXP :how_to_apply OR company_name REGEXP :company_name) ORDER BY created", 
                                array(':category'=>$cat->id,
                                    ':title'=>$terms,
                                    ':description'=>$terms,
                                    ':perks'=>$terms,
                                    ':how_to_apply'=>$terms,
                                    ':company_name'=>$terms));
            }
            return $jobs;
        } catch (Exception $e) {
            return false;
        }
        
    }
    
    public function countJobs($terms)
    {
        $terms = splitTerms($terms);
        $terms = implode('|', $terms);
        
        try {
            $jobs = R::findAll('jobs', " status=1 AND (title REGEXP :title OR description REGEXP :description OR perks REGEXP :perks OR how_to_apply REGEXP :how_to_apply OR company_name REGEXP :company_name)", 
                            array(':title'=>$terms,
                                ':description'=>$terms,
                                ':perks'=>$terms,
                                ':how_to_apply'=>$terms,
                                ':company_name'=>$terms));
            return count($jobs);
        } catch (Exception $e) {
            return 0;
        }
        
    }
    
}
