<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @param $value
     * @param string $column
     * @return Builder|Model|object|null
     */
    public function findUser($value, $column = 'id')
    {
        return User::query()->where($column, 'LIKE', "%{$value}")->first();
    }
}
