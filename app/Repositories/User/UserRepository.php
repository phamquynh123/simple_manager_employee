<?php

namespace App\Repositories\User;

use App\Model\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    public function getUserNotRoot($name, $cond)
    {
        return $this->_model::whereNotIn($name, [$cond])->get(['id', 'name', 'email']);
    }

}
