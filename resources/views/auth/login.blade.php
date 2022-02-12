<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale())}}">
    <head>

        <title>test iig</title>
        @include('layouts.include')
        <link rel='stylesheet' type="text/css" href="css/style.css" >
    </head>
    <body>
        @include('layouts.app')
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                        
                        <div class="card-header blue_bg text-white">เข้าสู่ระบบ</div>
                        
                        <div class="card-body">
                            @if(Session::has('message'))
                                <div class="alert @if(Session::pull('status') == 1) alert-success @else alert-danger @endif mb-3" style="margin-top: 10px">
                                    {{Session::pull('message') ?? ''}}
                                </div>
                            @endif
                            <form autocomplete="off" name="login" id="login" method="POST"action="{{ route('validate_login') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">ชื่อบัญชีผู้ใช้</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">รหัสผ่าน</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            เข้าสู่ระบบ
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
