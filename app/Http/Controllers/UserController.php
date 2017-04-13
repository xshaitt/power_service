<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '创建用户成功！';
        $data = $request->all();
        $data['password'] = Hash::make($request->get('password'));
        $user = User::create($data);
        if ($user) {
            $jsonData['data'] = $user->toArray();
        } else {
            $jsonData['status'] = 300;
            $jsonData['message'] = '创建用户成功！';
        }
        return response()->json($jsonData);
    }

    public function delete($id)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '删除成功！';
        $user = User::find($id);
        if ($user) {
            if (!$user->delete()) {
                $jsonData['status'] = 300;
                $jsonData['message'] = '删除失败';
            }
        } else {
            $jsonData['status'] = 404;
            $jsonData['message'] = '不存在此条记录';
        }
        return response()->json($jsonData);
    }

    public function show(Request $request, $id)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '查询成功！';
        $user = User::find($id);
        if ($user) {
            $jsonData['data'] = $user->toArray();
        } else {
            $jsonData['status'] = 404;
            $jsonData['message'] = '不存在此记录！';
        }
        return response()->json($jsonData);
    }

    public function all(Request $request, $page, $limit)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '查询成功！';
        $limit = $limit > 100 ? 100 : $limit;
        --$page;
        $page = $page < 0 ? 0 : $page;
        $offset = $page * $limit;
        $jsonData['data'] = User::offset($offset)->limit($limit)->get()->toArray();
        $jsonData['total'] = User::all()->count();
        return response()->json($jsonData);
    }

    public function put(Request $request, $id)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '修改成功！';
        $user = User::find($id);
        if ($user) {
            if (!$user->update($request->all())) {
                $jsonData['status'] = 300;
                $jsonData['message'] = '修改失败！';
            }
        } else {
            $jsonData['status'] = 404;
            $jsonData['message'] = '不存在此条记录!';
        }
        return response()->json($jsonData);
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $jsonData['status'] = 200;
        $jsonData['message'] = '登录成功！';
        if (Auth::attempt($data)) {
            $jsonData['data'] = Auth::user();
        } else {
            $jsonData['status'] = 300;
            $jsonData['message'] = '登录失败，请检查用户名与密码';
            $jsonData['data'] = [];
        }
        return response()->json($jsonData);
    }
}
