<?php
declare(strict_types=1);
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\AdminAuthShield\Services;

use BasicApp\AdminAuth\Interfaces\AdminInterface;
use BasicApp\AdminAuth\Config\AdminAuth as AdminAuthConfig;

class AdminAuth implements AdminInterface
{
    protected AdminAuthConfig $authConfig;

    public function __construct(AdminAuthConfig $authConfig)
    {
        $this->authConfig = $authConfig;
    }

    public function getAdminName(): ?string
    {
        return auth()->user()->username;
    }

    public function getAdminEmail(): ?string
    {    
        return auth()->user()->email;
    }

    public function getAdminAvatarImageUrl(?string $default = null): ?string
    {
        $user = auth()->user();

        if (method_exists($user, 'getAvatarImageUrl'))
        {
            return $user->getAvatarImageUrl();
        }

        if ($user->email && $user->email != 'admin@example.org')
        {
            // Trim leading and trailing whitespace from
            // an email address and force all characters
            // to lower case
            $address = strtolower(trim($user->email));

            // Create an SHA256 hash of the final string
            $hash = hash('sha256', $address);

            // Grab the actual image URL
            return 'https://gravatar.com/avatar/' . $hash;
        }

        return $default ? base_url($default): null;
    }

    public function getAdminLogoutUrl(): ?string
    {
        return site_url('admin/logout');
    }

    public function getAdminAccountMenu(): array
    {
        return [];
    }
}