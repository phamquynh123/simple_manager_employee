@extends('layouts/header')

@section('content')
    <div>hello</div>
    @if(Auth::user()->first_time == config('message.first_time'))
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                   <h2>Đây là Lần đăng nhập đầu tiên. 
                    Yêu cầu đổi mật khẩu.</h2> 
                  </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"><a href="{{ asset('profile') }}">Đổi mật khẩu.</a> </button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('js')
<script>
    $('#exampleModal').modal({backdrop: 'static', keyboard: false})  
</script>
@endsection