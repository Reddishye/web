<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('has_permission')) {
    function has_permission($permission)
    {
        $user = Auth::user();
        if ($user) {
            $permissions = $user->permissions;
            if (is_array($permissions)) {
                if (in_array('*', $permissions) || in_array($permission, $permissions)) {
                    return true;
                }
                // Check permissions with a single asterisk, like 'account.*'
                $permissionParts = explode('.', $permission);
                array_pop($permissionParts);
                $parentPermission = implode('.', $permissionParts).'.*';
                if (in_array($parentPermission, $permissions)) {
                    return true;
                }
                // Check permissions with double asterisks, like 'account.**'
                if (substr($permission, -2) === '**') {
                    $section = str_replace('**', '', $permission);
                    foreach ($permissions as $userPermission) {
                        if (strpos($userPermission, $section) === 0) {
                            return true;
                        }
                    }
                }
                if (str_starts_with($permission, 'group.')) {
                    // TODO: check for group's permision
                }
            }
        }

        return false;
    }
}
