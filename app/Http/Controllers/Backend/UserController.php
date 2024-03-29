<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use Hash;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = DB::table('users')->count();
      $listUser = User::orderBy('id','DESC')->search()->paginate(6);
      return view('admin.user.list',compact('listUser','users'));
    }

    /**
     Thêm mới người dùng
     */
     public function add(Request $request)
     {
      $listUser=User::all();
      return view('admin.user.add',compact('listUser'));
    }

    /**
     Thêm mới người dùng
     */
     public function store(Request $request)
     {



      $this->validate($request,[
        'name'=>'required',
        'email'=>'required|email|unique:users,email',
        'password'=>'required|min:6',
        're_password'=>'required|same:password',
        'phone'=>'required',


      ],[
        'name.required'=>'Tên người dùng không được để trống!',
        'email.required'=>'Email không được để trống!',
        'email.unique'=>'Tên email đã bị trùng!',
        'email.email'=>'Email không đúng định dạng!',
        'password.required'=>'Mật khẩu không được để trống!',
        'password.min'=>'Mật khẩu ít nhất có 6 ký tự!',
        're_password.required'=>'Phải nhập lại mật khẩu!',
        're_password.same'=>'Mật khẩu nhập lại không trùng khớp!',
        'phone.required'=>'Số điện thoại không được để trống!',




      ]);
      $user= new User();
      $user->name=$request->name;
      $user->email=$request->email;
      $user->password=Hash::make($request->password);
      $user->level=$request->level;
      $user->gender=$request->gender;
      $user->phone=$request->phone;
      $user->birthday=$request->birthday;
      $user->remember_token=$request->_token;
      $user->save();


      return redirect()->route('tai-khoan')->with(['level'=>'success','message'=>'Đã thêm mới người dùng thành công!']);
    }

    /**
     Sửa thông tin người dùng
     */
     public function edit($id)
     {
       $listUsers = User::find($id);


       return view('admin.user.edit',['listUsers'=>$listUsers]);
     }

    /**
    Cập nhật thông tin người dùng
     */
    public function update( $id,Request $request)
    {  
      $this->validate($request,[
        'name'=>'required',
        'email'=>'required|email|unique:users,email,'.$id,
        'password'=>'required|min:6',
        're_password'=>'required|same:password',
        'phone'=>'required'
      ],[
        'name.required'=>'Tên người dùng không được để trống!',
        'email.required'=>'Email không được để trống!',
        'email.unique'=>'Tên email đã bị trùng!',
        'email.email'=>'Email không đúng định dạng!',
        'password.required'=>'Mật khẩu không được để trống!',
        'password.min'=>'Mật khẩu ít nhất có 6 ký tự!',
        're_password.required'=>'Phải nhập lại mật khẩu!',
        're_password.same'=>'Mật khẩu nhập lại không trùng khớp!',
        'phone.required'=>'Số điện thoại không được để trống!',

      ]); 
      $user = User::find($id);  
      $user->update([       
        'name' => $request->get('name'), 
        'email'=> $request->get('email'),
        'password'=>bcrypt($request->password),
        'level'=> $request->get('level'),
        'birthday'=> $request->get('birthday'),
        'gender'=> $request->get('gender'),
        'phone'=> $request->get('phone'),
                 ]);


   

      return redirect()->route('tai-khoan')->with(['level'=>'success','message'=>'Cập nhật thành viên thành công!']);
    }

    /**
    Xóa người dùng
     */
    public function destroy($id)
    {
      User::destroy($id);
      return redirect()->route('tai-khoan')->with(['level'=>'success','message'=>'Xóa tài khoản thành công!']);
    }
  }
