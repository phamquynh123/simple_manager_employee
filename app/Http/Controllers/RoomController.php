<?php

namespace App\Http\Controllers;

use App\Model\Room;
use Illuminate\Http\Request;
use App\Http\Requests\RoomRequest;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Yajra\Datatables\Datatables;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $RoomRepo;
    protected $UserRepo;
    public function __construct(
        RoomRepositoryInterface $RoomRepo,
        UserRepositoryInterface $UserRepo
    ) {
        $this->RoomRepo = $RoomRepo;
        $this->UserRepo = $UserRepo;
    }

    public function index()
    {
        return view('admin/room');
    }

    public function roomDatatable()
    {
        $room = $this->RoomRepo->getAll();

        // dd($room);

        return Datatables::of($room)
            ->addColumn('action', function ($item) {
               
                return '<a href="' . route('room.detail', $item->id) . '" class="btn btn-sm btn-warning room-detail btn-xs" data-id="' . $item->id . '"  data-toggle="modal" data-target="#ModalDetail"><i class="fa fa-eye"></i></a> <a href="#" data-id="' . $item->id .'" class="btn btn-sm btn-info room-edit btn-xs" data-id="' . $item->id . '"  data-toggle="modal" data-target="#ModalEdit" title=""><i class="fa fa-edit"></i></a> <a href="#" class="btn btn-sm btn-danger btn-xs remove" data-id="' . $item->id . '" title="' . trans('validation.exist') . '"><i class="fa fa-trash"></i></a>';
            })
            ->rawColumns([ 
                'action',
            ])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        // dd($request->all());
        $response = $this->RoomRepo->create($request->all());

        return response()->json(['success' => 'Thêm Mới Thành Công !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $data = $this->RoomRepo->find($id)->load('user')->toArray();

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->RoomRepo->find($id);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, $id)
    {
        $data = $request->all();
        $respon = $this->RoomRepo->update($id, $data);

        return response()->json(['success' => 'Sửa Thông Tin Thành Công!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->RoomRepo->find($id)->load('user');
        $this->RoomRepo->delete($id);
        $room['room_id'] = 0;
        foreach ($data['user'] as $value) {
            $this->UserRepo->update($value['id'], $room);
        }

        return response()->json(['success' => 'Xóa Bộ Phận Thành Công.']);
    }
}
