<?php
declare(strict_types=1);

namespace BasicApp\AdminAuthShield\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use BasicApp\AdminAuthShield\Config\AdminAuthShield;
use CodeIgniter\Config\Factories;
use CodeIgniter\Shield\Filters\SessionAuth;

class AdminSessionAuth extends SessionAuth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $instances = Factories::getComponentInstances('config');
        
        $instances['aliases']['Auth'] = AdminAuthShield::class;
        
        Factories::setComponentInstances('config', $instances);  

        if ($request->getPath() == 'admin/login')
        {
            return;
        }

        return parent::before($request, $arguments);
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) : void
    {
        parent::after($request, $response, $arguments);
    }
}
