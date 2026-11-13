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
            'before' => [
                'admin',
                'admin/*'
            ]
        ],
        'admingroup:admin' => [
            'before' => [
                'admin',
                'admin/*'
            ]
        ]
    ];
```

5. Add to "Config/Services.php"

```
     public static function adminAuth($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance(__FUNCTION__);
         }
         
         return new \BasicApp\AdminAuthShield\Services\AdminAuth;
     }
```

6. Add to ".env"

```
Security.csrfProtection="session"
```

7. Add to "Config\Autoload"
```
public $helpers = [
    /* other helpers here... */
    'auth', 
    'setting'];
```


