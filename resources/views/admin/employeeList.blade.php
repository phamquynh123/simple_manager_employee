@extends('layouts/header')

@section('css')
<link rel="stylesheet" href="{{ asset('/bower_components/css/custom.css') }}">
@endsection

@section('namepage')
    Nhân Viên
@endsection

@section('content')
    <table class="table table-hover col-12" id="employee-table-seen-by-manager" data-url="{{ route('listEmployeeByRoom') }}" style="background-color: white; text-align: center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên </th>
                <th>Email</th>
                <th>Ảnh Đại Diện</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
    </table>
@endsection 

@section('js')
    <script src="{{ asset('bower_components/js/employee.js') }}"></script>
@endsection
