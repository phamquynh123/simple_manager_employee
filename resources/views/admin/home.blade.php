@extends('layouts/header')

@section('content')
    <div>hello</div>

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
               <h2>Đây là Lần đăng nhập đầu tiên. 
                Yêu cầu đổi mật khẩu.</h2> 
              </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#exampleModal').modal({backdrop: 'static', keyboard: false})  
</script>
@endsection