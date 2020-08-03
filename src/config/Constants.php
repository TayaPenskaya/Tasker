<?php


namespace App\Config;


class Constants {
    const routes = [
        '' => [
            'controller' => 'main',
            'action' => 'start'
        ],
        'account/login' => [
            'controller' => 'account',
            'action' => 'login'
        ],
        'tasks/show' => [
            'controller' => 'tasker',
            'action' => 'show'
        ],
        'tasks/add' => [
            'controller' => 'tasker',
            'action' => 'add'
        ],
        'admin/hello' => [
            'controller' => 'admin',
            'action' => 'hello'
        ],
        'admin/logout' => [
            'controller' => 'admin',
            'action' => 'logout'
        ]
    ];
    const happyControllerMessage = 'Controller performed the action!';
}