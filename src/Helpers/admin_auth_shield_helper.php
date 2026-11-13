<?php

use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Config\Factories;
use Config\AdminAuthRoutes;

if (!function_exists('admin_auth_shield_routes'))
{
    function admin_auth_shield_routes(RouteCollection $routes): bool
    {
        if (current_url(true)->getSegment(1) === 'admin')
        {
            $instances = Factories::getComponentInstances('config');

            $instances['aliases']['AuthRoutes'] = AdminAuthRoutes::class;
            
            Factories::setComponentInstances('config', $instances);

            service('auth')->routes($routes, ['except' => [
                'register',
                //'login',
                'magic-link',
                //'logout',
                'auth-actions'
            ]]);

            return true;
        }
        
        return false;
    }
}