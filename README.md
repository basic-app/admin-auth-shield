# admin-auth-shield

### Install

1. Install Shield

2. Run
```
composer require basic-app/admin-auth-shield
```

3. Add to "Config/Routes.php"
```
helper(['admin_auth_shield']);
if (!admin_auth_shield_routes($routes))
{
    // default auth routes
    service('auth')->routes($routes);
}
```

4. Add to "Config/Filters.php"
```
    public array $aliases = [
        /* other aliases here... */
        'adminsession'  => \BasicApp\AdminAuthShield\Filters\AdminSessionAuth::class,
        'admingroup'    => \BasicApp\AdminAuthShield\Filters\AdminGroupFilter::class
    ];
    
    public array $filters = [
        /* other filters here... */
        'adminsession' => [
            'before' => ['admin', 'admin/*']
        ],
        'admingroup:admin' => [
            'before' => ['admin', 'admin/*']
        ]
    ];
```

5. Add to ".env"

```
AdminAuth.credentialClass="BasicApp\AdminAuthShield\Services\AdminAuth"
```

6. Add to "Config\Autoload"
```
public $helpers = [
    /* other helpers here... */
    'auth', 
    'setting'
];
```

7. Add to ".env"

```
Security.csrfProtection="session"
```

In some cases, this step can be skipped.

8. Run
```
php spark migrate -all
php spark db:seed "BasicApp\AdminAuthShield\Database\Seeds\DemoSeeder"
```

Access backend by opening `http://localhost:8080/index.php/admin` in a browser.
```
login: admin@example.org
password: admin
```

You need to restart the Spark server so the new settings take effect.
