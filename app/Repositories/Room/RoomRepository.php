<?php

namespace App\Repositories\Room;

use App\Model\Room;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\BaseRepository;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Room::class;
    }

}
