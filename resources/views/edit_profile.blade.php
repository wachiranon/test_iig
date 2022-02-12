<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale())}}">
    <head>

        <title>test iig</title>
        @include('layouts.include')
        <link rel='stylesheet' type="text/css" href="css/style.css" >
        <script src="{{asset('js/validate_ediprofile.js')}}" defer></script>
    </head>
    <body>
        @include('layouts.app')
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header blue_bg text-white">แก้ไขโปรไฟล์</div>
                        <div class="card-body">
                            <form autocomplete="off" name="profile" id="profile" method="POST" action="{{route('edit_profile')}}"  enctype="multipart/form-data">
                                @csrf
                                @if(Session::has('message'))
                                    <div>
                                        <div class="alert @if(Session::pull('status') == 1) alert-success @else alert-danger @endif mb-3" style="margin-top: 10px">
                                            {{Session::pull('message') ?? ''}}
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">ชื่อบัญชีผู้ใช้</label>

                                    <div id="input_username" class="col-md-6">
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" maxlength="12" name="username" value="{{ $user->username ?? '' }}" readonly autocomplete="username" autofocus>
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname" class="col-md-4 col-form-label text-md-right">ชื่อผู้ใช้</label>

                                    <div class="col-md-6">
                                        <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ $user->fname ?? '' }}" required autocomplete="fname">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lname" class="col-md-4 col-form-label text-md-right">นามสกุล</label>

                                    <div class="col-md-6">
                                        <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ $user->lname ?? '' }}" required autocomplete="lname">
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <div class="col-md-4 text-md-right">
                                        <label class="col-form-label ">ภาพประจำตัว</label>
                                    </div>
                                    <div id="input_profile_img"  class="col-md-6">
                                        <div class="custom-file">
                                            <label class="custom-file-label">Profile image</label>
                                            <input id="profile_img" type="file" class="custom-file-input" name="profile_img">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">รหัสผ่านเก่า</label>

                                    <div id="input_password" class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_password" class="col-md-4 col-form-label text-md-right">รหัสผ่านใหม่</label>

                                    <div id="input_new_password" class="col-md-6">
                                        <input id="new_password" type="password" class="form-control"  name="new_password" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_password_confirm" class="col-md-4 col-form-label text-md-right">ยืนยันรหัสผ่านใหม่</label>

                                    <div id="input_new_password_confirm" class="col-md-6">
                                        <input id="new_password_confirm" type="password" class="form-control"  name="new_password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <a id="validate_editProfile" class="btn btn-primary" type="submit">
                                            แก้ไขโปรไฟล์
                                        </a>
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
