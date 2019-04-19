<?php

namespace App\Role;

use Illuminate\Database\Eloquent\Model;

/***
 * Class Role
 * @package App\Role
 */
class Role extends Model{

    protected $table = 'roles';

    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_MANAGER = 'ROLE_MANAGER';
    const ROLE_MAIN_MANAGER = 'ROLE_MAIN_MANAGER';
    const ROLE_FARM_MANAGER = 'ROLE_FARM_MANAGER';
    const ROLE_TRANSPORTATION_MANAGER = 'ROLE_TRANSPORTATION_MANAGER';
    const ROLE_STORE_MANAGER = 'ROLE_STORE_MANAGER';
    const ROLE_EMPLOYER = 'ROLE_EMPLOYER';
    const ROLE_FARMER = 'ROLE_FARMER';
    const ROLE_TRANSPORTATION_EMPLOYER = 'ROLE_TRANSPORTATION_EMPLOYER';
    const ROLE_STORE_EMPLOYER = 'ROLE_STORE_EMPLOYER';
    const ROLE_GUEST = 'ROLE_GUEST';
    const ROLE_SUPPORT = 'ROLE_SUPPORT';

    /**
     * @var array
     */
    protected static $roleHierarchy = [
        self::ROLE_ADMIN => ['*'],
        self::ROLE_MAIN_MANAGER => ['*'],
        self::ROLE_FARM_MANAGER => [
            self::ROLE_FARMER,
            self::ROLE_MANAGER,
        ],
        self::ROLE_TRANSPORTATION_MANAGER => [
          self::ROLE_TRANSPORTATION_EMPLOYER,
          self::ROLE_MANAGER,
        ],
        self::ROLE_STORE_MANAGER => [
          self::ROLE_STORE_EMPLOYER,
          self::ROLE_MANAGER,
        ],
        self::ROLE_FARMER => [
            self::ROLE_EMPLOYER,
        ],
        self::ROLE_TRANSPORTATION_EMPLOYER => [
            self::ROLE_EMPLOYER,
        ],
        self::ROLE_STORE_EMPLOYER => [
            self::ROLE_EMPLOYER,
        ],
        self::ROLE_GUEST => [],
        self::ROLE_SUPPORT => [],
    ];

    /**
     * @param string $role
     * @return array
     */
    public static function getAllowedRoles(string $role)
    {
        if (isset(self::$roleHierarchy[$role])) {
            return self::$roleHierarchy[$role];
        }

        return [];
    }

    /***
     * @return array
     */
    public static function getRoleList()
    {
        return [
            static::ROLE_ADMIN =>'Admin',
            static::ROLE_MAIN_MANAGER => 'Main Manager',
            static::ROLE_FARM_MANAGER => 'Farm Manager',
            static::ROLE_TRANSPORTATION_MANAGER => 'Transportation Manager',
            static::ROLE_STORE_MANAGER => 'Store Manager',
            static::ROLE_FARMER => 'Farmer',
            static::ROLE_TRANSPORTATION_EMPLOYER => 'Transportation Employer',
            static::ROLE_STORE_EMPLOYER => 'Store Employer',
            static::ROLE_GUEST => 'Guest',
            static::ROLE_SUPPORT => 'Support',
        ];
    }
}