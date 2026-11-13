<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\AdminAuthShield\Services;

use BasicApp\AdminAuth\Interfaces\AdminInterface;

class AdminAuth implements AdminInterface
{
    public function getAdminName() : ?string
    {
        return null;
    }

    public function getAdminEmail() : ?string
    {
        return null;
    }

    public function getAdminAvatarImageUrl(?string $default = null) : ?string
    {
        /*
        if ($this->avatar_image_path)
        {
            return base_url($this->avatar_image_path);
        }
        */

        return $default ? base_url($default) : null;
    }

    public function getAdminLogoutUrl() : ?string
    {
        return site_url('admin/logout');
    }

    public function getAdminAccountMenu() : array
    {
        return [
            /*
            'auth-settings' => [
                'label' => lang('Admin.Settings'),
                'url' => site_url('admin/auth-settings'),
                'icon' => 'fa-user'
            ]
            */
        ];
    }
}