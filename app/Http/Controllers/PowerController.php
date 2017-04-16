<?php

namespace App\Http\Controllers;

use App\Power;
use Illuminate\Http\Request;

class PowerController extends Controller
{
    public function create(Request $request)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '创建电源管家成功！';
        $data = $request->all();
        $power = Power::create($data);
        if ($power) {
            $jsonData['data'] = $power->toArray();
        } else {
            $jsonData['status'] = 300;
            $jsonData['message'] = '创建电源管家失败！';
        }
        return response()->json($jsonData);
    }

    public function delete($id)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '删除成功！';
        $power = Power::find($id);
        if ($power) {
            if (!$power->delete()) {
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
        $power = Power::find($id);
        if ($power) {
            $jsonData['data'] = $power->toArray();
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
        $jsonData['data'] = Power::offset($offset)->limit($limit)->get()->toArray();
        $jsonData['total'] = Power::all()->count();
        return response()->json($jsonData);
    }

    public function put(Request $request, $id)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '修改成功！';
        $power = Power::find($id);
        if ($power) {
            if (!$power->update($request->all())) {
                $jsonData['status'] = 300;
                $jsonData['message'] = '修改失败！';
            }
        } else {
            $jsonData['status'] = 404;
            $jsonData['message'] = '不存在此条记录!';
        }
        return response()->json($jsonData);
    }

    public function allWhere(Request $request)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '查询成功！';
        $where = $request->get('where', []);
        $jsonData['data'] = Power::where($where)->get()->toArray();
        $jsonData['total'] = Power::all()->count();
        return response()->json($jsonData);
    }
}
