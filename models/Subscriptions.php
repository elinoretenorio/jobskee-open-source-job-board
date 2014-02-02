<?php
/**
 * Jobskee - open source job board 
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 * 
 * Subscriptions class handles user email subscriptions
 */

class Subscriptions
{
    protected $_email;
    protected $_category_id;
    protected $_city_id;

    public function __construct($email, $category_id=0, $city_id=0)
    { 
        $this->_email = $email;
        $this->_category_id = $category_id;
        $this->_city_id = $city_id;
    }
    
    public function createSubscription($subscription_for)
    {
        if (!$this->isUserSubscribed()) {
            
            $user = R::dispense('subscriptions');
            $user->email = $this->_email;
            $user->category_id = $this->_category_id;
            $user->city_id = $this->_city_id;
            $user->token = token();
            $user->is_confirmed = 0;
            $user->created = R::isoDateTime();
            $id = R::store($user);
            
            $notif = new Notifications();
            $notif->createSubscriptionMail($id, $user->token, $user->email, $subscription_for);
            return $id;
        }
        return false;
    }
    
    public function updateSubscription($id, $status=INACTIVE)
    {
        global $categories, $cities;
        $user = R::load('subscriptions', $id);
        if (isset($user) && $user->id) {
            $user->is_confirmed = $status;
            R::store($user);
            if ($status) {
                $subscription_for = ($user->category_id) ? $categories[$user->category_id]['name'] :  $cities[$user->city_id]['name'];
                $notif = new Notifications();
                $notif->updateSubscriptionMail($user->email, $id, $user->token, $subscription_for);
            }
            return $id;
        }
        return false;
    }
    
    public function sendEmailsToSubscribers($job_id)
    {
        $notif = new Notifications();
        $notif->sendEmailsToSubscribersMail($job_id);
    }
    
    public function getUserSubscription($id, $token)
    {
        $user = R::findOne('subscriptions', ' id=:id AND token=:token', array(':id'=>$id, ':token'=>$token));
        if ($user && $user->id) {
            return $user;
        }
        return false;
    }
    
    public function isUserSubscribed()
    {
        $user = R::findOne('subscriptions', ' email=:email AND category_id=:category_id AND city_id=:city_id ', 
                        array(':email'=>$this->_email, ':category_id'=> $this->_category_id, ':city_id'=>$this->_city_id));
        if ($user && $user->id) {
            return $user->id;
        }
        return false;
    }
    
    public function getAllSubscriptions($start)
    {
        $users = R::findAll('subscriptions', ' ORDER BY created DESC LIMIT :start, :limit ', array(':start'=>$start, ':limit'=>LIMIT));
        if (isset($users)) {
            return $users;
        }
        return false;
    }
    
    public function countSubscriptions()
    {
        $count = R::count('subscriptions');
        return $count;
    }
    
    public function deleteSubscription($id, $token) {
        $user = $this->getUserSubscription($id, $token);
        R::trash($user);
    }
	
}