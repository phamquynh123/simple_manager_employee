@extends('layouts/header')

@section('namepage')
    Bộ Phận
@endsection

@section('content')
    <button class="btn btn-info float-right" data-toggle="modal" data-target="#ModalAdd">Thêm Mới</button>
    {{-- <div class="row" style="background-color: white"> --}}
    <table class="table table-hover col-12" id="roomtable" data-url="{{ route('room.table') }}" style="background-color: white; text-align: center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Display Name </th>
                <th>Description</th>
                <th>created_at</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    {{-- </div> --}}


{{-- Modal Add --}}
<div class="modal fade " id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Bộ Phận</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" role="form" id="add">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input type="text" class="form-control" id="" placeholder="Input field" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Tên Hiển Thị </label>
                        <input type="text" class="form-control" id="" placeholder="Input field" name="display_name">
                    </div>
                    <div class="form-group">
                        <label for="">Miêu Tả</label>
                        <input type="text" class="form-control" id="" placeholder="Input field" name="description">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Detail --}}
<div class="modal fade " id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xem Chi Tiết Bộ Phận : <span id="name-room" ></span> - <span id="description"></span></h5>
                <br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Danh Sách Nhân Viên</p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody class="content-detail-room">
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade " id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa Thông Tin Bộ Phận</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" role="form" id="edit">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input type="text" class="form-control" id="edit-name" placeholder="Input field" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Tên Hiển Thị </label>
                        <input type="text" class="form-control" id="edit-display" placeholder="Input field" name="display_name">
                    </div>
                    <div class="form-group">
                        <label for="">Miêu Tả</label>
                        <input type="text" class="form-control" id="edit-description" placeholder="Input field" name="description">
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
    <script src="{{ asset('bower_components/js/room.js') }}"></script>
@endsection
