<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $UserRepo;

    public function __construct(UserRepositoryInterface $UserRepo)
    {
        $this->UserRepo = $UserRepo;
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
        $data['id'] = Auth::user()->id;
        $oldpass = Auth::user()->password;
        if (Hash::check($data['oldpass'], $oldpass)) {
            $data['password'] = Hash::make($data['newpass']);
            $data['first_time'] = 1;
            $data = $this->UserRepo->update($data['id'], $data);

            return response()->json(['success' => 'Thayy Đổi Mật Khẩu Thành Công', 'error' => false]);
        } else {
            return response()->json(['success' => 'Mật Khẩu Cũ Sai!', 'error' => true]);
        }
    }
}
