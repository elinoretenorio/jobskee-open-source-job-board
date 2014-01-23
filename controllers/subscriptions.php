<?php
/**
 * Jobskee - open source job board
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 *
 * Subscriptions
 * Create and manage email subscriptions
 */

$app->group('/subscribe', function () use ($app) {
    
    $app->post('/new', 'isBanned', function () use ($app) {
        
        global $categories, $cities;
        $data = $app->request->post();
        
        $redirect = ($data['category_id'] > 0) ? 'categories' : 'cities';
        $id = ($data['category_id'] > 0) ? $data['category_id'] : $data['city_id'];
        if ($data['category_id'] > 0) {
            $subscription_for = $categories[$data['category_id']]['name'];
        } else {
            $subscription_for = $cities[$data['city_id']]['name'];
        }
        
        if ($data['trap'] == '') {
            $subscribe = new Subscriptions($data['email'], $data['category_id'], $data['city_id']);
            if ($subscribe->createSubscription($subscription_for)) {
                $app->flash('success', "A subscription confirmation was sent to your email address.");
            } else {
                $app->flash('danger', "Your subscription failed. You may have an existing subscription already.");
            }
            $app->redirect(BASE_URL . "{$redirect}/{$id}");
        } else {
            $app->flash('danger', "Your subscription failed. You are not allowed to subscriibe.");
            $app->redirect(BASE_URL . "{$redirect}/{$id}");
        }
    });
    
    $app->get('/:id/:action/:token', 'isBanned', function ($id, $action, $token) use ($app) {
        
        $status = ($action == 'confirm') ? ACTIVE : INACTIVE;
        $s = new Subscriptions('');
        $user = $s->getUserSubscription($id, $token);
        if ($user) {
            $s->updateSubscription($id, $status);
            if ($status == ACTIVE) {
                $app->flash('success', 'Thank you for confirming your subscription.');
            } else {
                $app->flash('success', 'Your subscription has been canceled.');
            }
            $app->redirect(BASE_URL);
        } else {
            $app->flash('danger', 'Your subscription could not be confirmed.');
            $app->redirect(BASE_URL);
        }
        
    });
    
});