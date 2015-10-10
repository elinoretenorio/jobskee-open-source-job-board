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
        global $lang;
        
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
                $app->flash('success', $lang->t('subscribe|confirm_email'));
            } else {
                $app->flash('danger', $lang->t('subscribe|existing'));
            }
            $app->redirect(BASE_URL . "{$redirect}/{$id}");
        } else {
            $app->flash('danger', $lang->t('subscribe|not_allowed'));
            $app->redirect(BASE_URL . "{$redirect}/{$id}");
        }
    });
    
    $app->get('/:id/:action/:token', 'isBanned', function ($id, $action, $token) use ($app) {

        global $lang;

        $status = ($action == 'confirm') ? ACTIVE : INACTIVE;
        $s = new Subscriptions('');
        $user = $s->getUserSubscription($id, $token);
        if ($user) {
            $s->updateSubscription($id, $status);
            if ($status == ACTIVE) {
                $app->flash('success', $lang->t('subscribe|confirmed'));
            } else {
                $app->flash('success', $lang->t('subscribe|cancel'));
            }
            $app->redirect(BASE_URL);
        } else {
            $app->flash('danger', $lang->t('subscribe|confirm_error'));
            $app->redirect(BASE_URL);
        }
        
    });
    
});