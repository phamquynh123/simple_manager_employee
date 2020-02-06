@extends('layouts/header')

@section('css')
<link rel="stylesheet" href="{{ asset('/bower_components/css/custom.css') }}">
@endsection

@section('namepage')
    Nhân Viên
@endsection

@section('content')
    <button class="btn btn-info float-right" data-toggle="modal" data-target="#ModalAdd">Thêm Mới</button>
    <button class="btn btn-warning float-right reset-password-group" data-toggle="modal" data-target="#ResetPasswordGroup">Đổi Mật Khẩu Theo Nhóm</button>

    <table class="table table-hover col-12" id="employeetable" data-url="{{ route('nv.table') }}" style="background-color: white; text-align: center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên </th>
                <th>Email</th>
                <th>Ảnh Đại Diện</th>
                <th>Chức vụ</th>
                <th>Bộ Phận</th>
                <th>Ngày tạo</th>
                <th>Hành Động</th>
            </tr>
        </thead>
    </table>



{{-- Modal Add --}}
<div class="modal fade " id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Nhân Viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" role="form" id="add">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên *</label>
                        <input type="text" class="form-control" id="" placeholder="Input field" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label for="">Email * </label>
                        <input type="text" class="form-control" id="" placeholder="Input field" name="email" value="">
                    </div>
                    <div class="form-group">
                        <label for="">Mật Khẩu * </label>
                        <input type="text" class="form-control" id="" placeholder="Input field" name="password" value="123456">
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh Đại Diện </label>
                        <input type="file" class="form-control" id="" placeholder="Input field" name="avatar">
                    </div>
                    <div class="form-group">
                        <label for="">Chức Vụ</label>
                        <select name="role_id" id="" class="form-control">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"> {{ $role->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Phòng</label>
                        <select name="room_id" id="" class="form-control">
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}"> {{ $room->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Change Password One People --}}
<div class="modal fade " id="ModalResetPassOne" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" role="form" id="ResetPassOne">
                    @csrf
                    <div class="form-group">
                        <label for="">Mật Khẩu Mới</label>
                        <input type="text" class="form-control" id="pass-one" placeholder="Input field" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Change Password Group People --}}
<div class="modal fade " id="ResetPasswordGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" role="form" id="ResetPassGroup">
                    @csrf
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Check</th>
                                <th>Tên</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody class="tb-reset-pass">
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label for="">Mật Khẩu Mới</label>
                        <input type="text" class="form-control"  placeholder="Input field" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Modal edit --}}
<div class="modal fade " id="ModalEditEmployeeInfor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa Thông tin Nhân Viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" role="form" id="edit-infor-employee">
                    @csrf
                    <div class="form-group">
                        <label for="">Chức Vụ</label>
                        <select name="role_id" id="role-edit" class="form-control">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"> {{ $role->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Phòng</label>
                        <select name="room_id" id="room-edit" class="form-control">
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}"> {{ $room->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection 

{{-- Add New --}}
<!-- Modal -->



@section('js')
    <script src="{{ asset('bower_components/js/employee.js') }}"></script>
@endsection
