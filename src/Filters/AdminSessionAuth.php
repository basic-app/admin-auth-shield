<?php

declare(strict_types=1);

namespace BasicApp\AdminAuthShield\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use BasicApp\AdminAuthShield\Config\AdminAuthShield;
use CodeIgniter\Config\Factories;
use CodeIgniter\Shield\Filters\SessionAuth;

class AdminSessionAuth extends SessionAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $instances = Factories::getComponentInstances('config');

        $instances['aliases']['Auth'] = AdminAuthShield::class;

        Factories::setComponentInstances('config', $instances);

        if (method_exists($request, 'getPath')) {
            if ($request->getPath() == 'admin/login') {
                return;
            }
        }

        return parent::before($request, $arguments);
    }
}
