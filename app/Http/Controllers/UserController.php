<?php

namespace App\Http\Controllers;

use App\User;

use Exception;
use Session;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;



class UserController extends Controller
{
    //
    public function validatelogin(Request $request){

        $_username = ($request->username != null) ? $request->username : $_COOKIE['username'];
        $_password = ($request->password != null) ? md5($request->password) : $_COOKIE['password'];
        $_user = User::where('username',$_username)->where('password',$_password)->first();
        
        if($_user == null){
            $message = 'ไม่สามารถเข้าสู่ระบบได้โปรดตรวจสอบ Username และ Password';
            $status = 0;
            Session::put('status',$status);
            Session::put('message',$message);
        }else{
            $message = 'ได้';  
            $status = 1;
            $user = $request->only('username','password');
            setcookie('user', json_encode($_user));
            
            return redirect()->route("home")->with('user',$_user);
        }

        
        // dd($message);
        return redirect()->route("login")->with('message',$message);
        
    }

    public function validateregister(Request $request){

        // dd($request);
        // SET INFO
        $_username = $request->username;
        $_password = md5($request->password);
        $_firstname = $request->fname;
        $_lastname = $request->lname;

        // SET IMG
        $_path = $_username;
        $_img = $request->file("profile_img");
        $_imgname = 'profile_img.png';
        if (!is_dir(public_path("file/".$_path))) {
            mkdir(public_path("file/".$_path), 777, true);
        }
        $image = Image::make($_img);
        // dd($image);
        $image->save(public_path("file/".$_path.'/'.$_imgname));

        $_profile_img = $_path.'/'.$_imgname;

        // SET OBJECT
        $_user = new User();
        $_user->username = $_username;
        $_user->password = $_password;
        $_user->fname = $_firstname;
        $_user->lname = $_lastname;
        $_user->profile_img = $_profile_img;

        $_check = User::where('username',$_username)->first();
        if($_check == null){
            try{
                $_user->save();
                $message = 'สมัครสมาชิกสำเร็จ';
                $status = 1;
                Session::put('status',$status);
                Session::put('message',$message);
                return redirect()->route('login')->with('message',$message);
            }catch(Exception $e){
                $status = 0;
                $message = 'สมัครไม่สำเร็จกรุณาลองใหม่';
                Session::put('status',$status);
                Session::put('message',$message);
                return redirect()->route('register')->with('message',$message);
            }
        }else{
            $status = 0;
            $message = 'มีชื่อผู้ใช้นี้อยู่แล้ว';
            Session::put('status',$status);
            Session::put('message',$message);
            return redirect()->route('register')->with('message',$message);
        }
        
        
    }

    public function editprofile(Request $request){

        $_check = user::where('username',$request->username)->first();
        $message = '';
        $_flag = false;
        $_check_password = md5($request->password);
        if($_check->old_password != null){
            $_old_password = explode('|',$_check->old_password);
        }else{
            $_old_password = array($_check->password);
        }
        // dd($_check,$request);
        if($_check != null){
            
            if($_check->password != $_check_password){
                $message = $message.'- รหัสผ่านไม่ถูกต้อง';
                $_flag = true;
            }
            if($request->new_password    != $request->new_password_confirmation){
                $message = $message.'- รหัสผ่านไม่ตรงกับรหัสยืนยัน';
                $_flag = true;
            }else{
                $_check_log = array_search(md5($request->new_password),$_old_password);
                if(is_int($_check_log) || md5($request->new_password) ==$_check->password){
                    $message = $message.'- รหัสผ่านใหม่ซ้ำกับรหัสที่เคยตั้ง';
                    $_flag = true;
                }else{
                    $_new_password = '';
                    $_count = sizeof($_old_password);
                    if($_count<5){
                        if($_count==1){
                            $_new_password = $_old_password[0].'|'.md5($request->new_password);
                        }else{
                            for($_i = 0;$_i<$_count;$_i++){
                                if($_i==0){
                                    $_new_password = $_old_password[$_i];
                                }elseif($_i<$_count-1){
                                    $_new_password = $_new_password.'|'.md5($request->new_password);
                                }else{
                                    $_new_password = $_new_password.'|'.$_old_password[$_i];
                                }
                            }
                        }
                    }else{
                        $_new_password = $_old_password[1].'|'.$_old_password[2].'|'.$_old_password[3].'|'.$_old_password[4].'|'.md5($request->new_password);
                    }
                    // dd($_new_password,$_check->password,$_old_password,$_count);
                }
            }
        }else{
            $_flag = true;
        }
        
        if($_flag == false){
            if(isset($request->profile_img)){

                $_path = $_check->username;
                $_img = $request->file("profile_img");
                $_imgname = 'profile_img.png';
                if (!is_dir(public_path("file/".$_path))) {
                    mkdir(public_path("file/".$_path), 777, true);
                }

                if(file_exists(public_path("file/".$_path.'/'.$_imgname))){

                    unlink(public_path("file/".$_path.'/'.$_imgname));
              
                }

                $image = Image::make($_img);
                // dd($image);
                $image->save(public_path("file/".$_path.'/'.$_imgname));
    
                $_profile_img = $_path.'/'.$_imgname;
            }else{
                $_profile_img = $_check->profile_img;
            }
            // dd($_new_password);
            $_username = $request->username;
            $_password = md5($request->new_password);
            $_firstname = $request->fname;
            $_lastname = $request->lname;
            $_user = user::where('username',$request->username);
            $_update = DB::select("
                UPDATE users
                SET password = '".$_password."',fname = '".$_firstname."',lname = '".$_lastname."',old_password = '".$_new_password."'
                WHERE username = '".$_username."'
            ");
            $message = $message.'แก้ไขโปรไฟล์เรียบร้อย';
            $status = 1;
        }else{
            $status = 0;
        }
        Session::put('status',$status);
        Session::put('message',$message);
        // dd($status,$message);

        return redirect()->back()->with('message',$message);

    }
}
