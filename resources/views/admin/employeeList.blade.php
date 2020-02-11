@extends('layouts/header')

@section('css')
<link rel="stylesheet" href="{{ asset('/bower_components/css/custom.css') }}">
@endsection

@section('namepage')
    Nhân Viên
@endsection

@section('content')
{{-- id="employee-table-seen-by-manager" --}}
    <table class="table table-hover col-12"  data-url="{{ route('listEmployeeByRoom') }}" style="background-color: white; text-align: center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên </th>
                <th>Email</th>
                <th>Ảnh Đại Diện</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['user'] as $key => $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['name'] }}</td>
                    <td>{{ $value['email'] }}</td>
                    <td>
                        @if ($value['avatar'] == null)
                            <img class="img-avatar" src=" {{ asset('') . config('message.IMGdefault') }} "/>
                        @else
                            <img class="img-avatar" src=" {{ asset('') . '/' . $value['avatar'] }} "/>
                        @endif
                    </td>
                    <td>{{ $value['created_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection 

@section('js')
    <script src="{{ asset('bower_components/js/employee.js') }}"></script>
@endsection
