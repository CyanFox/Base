<?php

namespace App\Policies;

use App\Models\PublicSetting;

class PublicSettingsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, PublicSetting $publicSetting): bool
    {
        if (!$publicSetting->auth) {
            return true;
        }

        if ($user) {
            if ($publicSetting->permission) {
                return $user->can($publicSetting->permission);
            }
            if ($publicSetting->group) {
                return $user->hasGroup($publicSetting->group);
            }
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        if ($user && $user->can('internal.public_settings.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, PublicSetting $publicSetting): bool
    {
        if ($user && $user->can('internal.public_settings.update')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, PublicSetting $publicSetting): bool
    {
        if ($user && $user->can('internal.public_settings.delete')) {
            return true;
        }
        return false;
    }
}
