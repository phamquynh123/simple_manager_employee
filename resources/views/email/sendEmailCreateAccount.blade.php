<!DOCTYPE html>
<html>
<head>
    <title>Sending password of your Account</title>
</head>

<body>
{{-- {{ dd($data) }} --}}
    <h1>Sending password of your Account</h1>
    <h1>Mail from TQuynh</h1>
    <h3>Tài Khoản được tạo thành công</h3>
    <p>Thông tin tài khoản của : {{ $data['name'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Password: {{ $data['password'] }}</p>

    <p>Thank you, {{ $data['name'] }}</p>

</body>

</html>