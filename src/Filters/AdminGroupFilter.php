<?php

declare(strict_types=1);

namespace BasicApp\AdminAuthShield\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Shield\Filters\GroupFilter;

class AdminGroupFilter extends GroupFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (method_exists($request, 'getPath')) {
            if (array_search($request->getPath(), ['admin/login', 'admin/logout']) !== false) {
                return;
            }
        }

        return parent::before($request, $arguments);
    }
}
