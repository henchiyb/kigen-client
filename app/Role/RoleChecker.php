<?php

namespace App\Role;

use App\User;

/**
 * Class RoleChecker
 * @package App\Role
 */
class RoleChecker
{
    /**
     * @param User $user
     * @param string $role
     * @return bool
     */
    public static function check(User $user, string $role)
    {
        // User::where('id', $user->id)->update(array('role' => Role::ROLE_FARM_MANAGER));
        // $user->save();
        // Admin has everything
        // dd($user);
        if ($user->hasRole(Role::ROLE_ADMIN) || $user->hasRole(Role::ROLE_MAIN_MANAGER)) {
            return true;
        }
        else if($user->hasRole(Role::ROLE_FARM_MANAGER)) {
            $managementRoles = Role::getAllowedRoles(Role::ROLE_FARM_MANAGER);
            if (in_array($role, $managementRoles)) {
                return true;
            }
        }
        else if($user->hasRole(Role::ROLE_TRANSPORTATION_MANAGER)) {
          $managementRoles = Role::getAllowedRoles(Role::ROLE_TRANSPORTATION_MANAGER);
          if (in_array($role, $managementRoles)) {
              return true;
          }
        }
        else if($user->hasRole(Role::ROLE_STORE_MANAGER)) {
          $managementRoles = Role::getAllowedRoles(Role::ROLE_STORE_MANAGER);
          if (in_array($role, $managementRoles)) {
              return true;
          }
        }
        else if($user->hasRole(Role::ROLE_FARMER)) {
            $managementRoles = Role::getAllowedRoles(Role::ROLE_FARMER);
            if (in_array($role, $managementRoles)) {
                return true;
            }
          }
          else if($user->hasRole(Role::ROLE_STORE_EMPLOYER)) {
            $managementRoles = Role::getAllowedRoles(Role::ROLE_STORE_EMPLOYER);
            if (in_array($role, $managementRoles)) {
                return true;
            }
          }
          else if($user->hasRole(Role::ROLE_TRANSPORTATION_EMPLOYER)) {
            $managementRoles = Role::getAllowedRoles(Role::ROLE_TRANSPORTATION_EMPLOYER);
            if (in_array($role, $managementRoles)) {
                return true;
            }
          }
        return $user->hasRole($role);
    }
}