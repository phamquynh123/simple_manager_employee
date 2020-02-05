<?php

namespace App\Repositories\Role;

use App\Model\Role;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Role::class;
    }

}
