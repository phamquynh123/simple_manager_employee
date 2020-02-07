<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Model\Room;
use App\Model\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Mail;
use DB;
use App\Mail\SendEmailCreateAccount;
use App\Mail\ResetPasswordMail;


class UserController extends Controller
{
    protected $UserRepo;
    protected $RoomRepo;

    public function __construct( 
        UserRepositoryInterface $UserRepo,
        RoomRepositoryInterface $RoomRepo
    ) {
        $this->UserRepo = $UserRepo;
        $this->RoomRepo = $RoomRepo;
    }

    public function showProfile()
    {
        return view('admin/profile');
    }

    public function editprofile(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            // File này có thực, bắt đầu đổi tên và move
            $fileExtension = $request->file('avatar')->getClientOriginalName(); // Lấy . của file
            // Filename cực shock để khỏi bị trùng
            $fileName = time() . "." . $fileExtension;
            // Thư mục upload
            $uploadPath = public_path('bower_components/upload/'); // Thư mục upload
            // Bắt đầu chuyển file vào thư mục
            $request->file('avatar')->move($uploadPath, $fileName);
            $data['avatar'] = config('message.linkIMGdefault') . $fileName;

        }

        $data = $this->UserRepo->update(Auth::user()->id, $data);

        return response()->json(['success' => 'Cập Nhật Thành Công', 'error' => false]);
        dd($data);
    }


    public function changepass(ChangePasswordRequest $request){
        $data = $request->all();
        try{
            DB::beginTransaction();
            $data['id'] = Auth::user()->id;
            $oldpass = Auth::user()->password;
            if (Hash::check($data['oldpass'], $oldpass)) {
                //sent email
                $user = Auth::user();
                $user['password'] = $data['newpass'];
                Mail::to($user['email'])->send(new ResetPasswordMail($user));
                // hash and save to DB
                $data['password'] = Hash::make($data['newpass']);
                $data['first_time'] = 1;
                $data = $this->UserRepo->update($data['id'], $data);

                return response()->json(['success' => 'Thay Đổi Mật Khẩu Thành Công', 'error' => false]);
            } else {
                return response()->json(['success' => 'Mật Khẩu Cũ Sai!', 'error' => true]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

    }

    public function index()
    {
        $roles = Role::all();
        $rooms = Room::all();

        return view('admin/employee', compact(['roles', 'rooms']));
    }

    public function employeeDatatable()
    {
        $data = $this->UserRepo->getAll()->load(['room','role']);

        return Datatables::of($data)
            ->addColumn('action', function ($item) {
               
                return '<a href="' . route('nv.repass', $item->id) . '" class="btn btn-sm btn-warning reset-pass-one btn-xs" data-id="' . $item->id . '"  data-toggle="modal" data-target="#ModalResetPassOne"><i class="fa fa-user-lock"></i></a> <a href="#" class="btn btn-sm btn-info employee-edit btn-xs" data-id="' . $item->id . '"  data-toggle="modal" data-target="#ModalEditEmployeeInfor" title=""><i class="fa fa-edit"></i></a> <a href="#" class="btn btn-sm btn-danger btn-xs remove" data-id="' . $item->id . '" title="' . trans('validation.exist') . '"><i class="fa fa-trash"></i></a>';
            })
            ->editColumn('avatar', function($item) {
                $image = "";
                if ($item->avatar == null) {
                    $image = asset('') . config('message.IMGdefault');
                } else {
                    $image = asset('') . '/' . $item->avatar;
                }
                // dd($image);
                return '<img class="img-avatar" src=" ' . $image . ' "/>';
            })
            ->editColumn('role', function($item) {
                return $item['role']['display_name'];
            })
            ->editColumn('room', function($item) {
                return $item['room']['display_name'];
            })
            ->rawColumns([ 
                'action', 'avatar', 'role', 'room',
            ])
            ->make(true);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();

            if ($request->hasFile('avatar')) {
                // File này có thực, bắt đầu đổi tên và move
                $fileExtension = $request->file('avatar')->getClientOriginalName(); // Lấy . của file
                // Filename cực shock để khỏi bị trùng
                $fileName = time() . "." . $fileExtension;
                // Thư mục upload
                $uploadPath = public_path('bower_components/upload/'); // Thư mục upload
                // Bắt đầu chuyển file vào thư mục
                $request->file('avatar')->move($uploadPath, $fileName);
                $data['avatar'] = config('message.linkIMGdefault') . $fileName;
            }
            Mail::to($data['email'])->send(new SendEmailCreateAccount($data));
            $data['password'] = Hash::make($data['password']);
            $data = $this->UserRepo->create($data);

            DB::commit();

            return response()->json(['success' => 'Thêm Mới Nhân Viên Thành Công!']);
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function ResetPassOne(ResetPasswordRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $user = $this->UserRepo->find($id);
            $user['password'] = $data['password'];
            Mail::to($user['email'])->send(new ResetPasswordMail($user));

            $data['password'] = Hash::make($data['password']);
            $respon = $this->UserRepo->update($id, $data);
            DB::commit();

            return response()->json(['success' => 'Đổi Mật Khẩu' . config('message.success')]);
        } catch (Exception $e) {
            DB::rollback();
        }
       
    }

    public function getinfoToChangePass()
    {
        $data = $this->UserRepo->getUserNotRoot('role_id', config('message.root'));

        return $data;
    }

    public function resetPassGroup(ResetPasswordRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            foreach ($data['resetpass'] as $key => $value) {
                $user = $this->UserRepo->find($value);
                $user['password'] = $data['password'];
                Mail::to($user['email'])->send(new ResetPasswordMail($user));
                $newpass['password'] = Hash::make($data['password']);
                $respon = $this->UserRepo->update($value, $newpass);
            }
            DB::commit();

            return response()->json(['success' => 'Đổi Mật Khẩu Thành Công']);
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function editinfo($id)
    {
        $data = $this->UserRepo->find($id);

        return $data;
    }

    public function updateinfo(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $respon = $this->UserRepo->update($id, $request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return response()->json(['success' => 'Đổi Thoong tin Thành Công']);
    }

    //get User By rooom. Seen by manager.
    public function employeeList()
    {
        $data = $this->RoomRepo->find(Auth::user()->role_id)->load('user');
        return view('admin.employeeList', compact('data'));
    }

    public function listEmployeeByRoom()
    {
        $data = $this->RoomRepo->find(Auth::user()->role_id)->load('user');
        // dd($data['user']);
        $user = $data['user'];

        return Datatables::of($user)
            ->editColumn('avatar', function($item) {
                $image = "";
                if ($item->avatar == null) {
                    $image = asset('') . config('message.IMGdefault');
                } else {
                    $image = asset('') . '/' . $item->avatar;
                }
                // dd($image);
                return '<img class="img-avatar" src=" ' . $image . ' "/>';
            })
            ->rawColumns([ 
                'avatar'
            ])
            ->make(true);
    }
}
