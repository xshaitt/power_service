<?php

namespace App\Http\Controllers;

use App\Enterprise;
use Illuminate\Http\Request;

class EnterController extends Controller
{
    public function create(Request $request)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '创建企业成功';
        $data = $request->all();
        $enterprise = Enterprise::create($data);
        if ($enterprise) {
            $jsonData['data'] = $enterprise->toArray();
        } else {
            $jsonData['status'] = 300;
            $jsonData['message'] = '创建企业失败';
        }
        return response()->json($jsonData);
    }

    public function delete($id)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '删除成功！';
        $enterprise = Enterprise::find($id);
        if ($enterprise) {
            if (!$enterprise->delete()) {
                $jsonData['status'] = 300;
                $jsonData['message'] = '删除失败';
            }
        } else {
            $jsonData['status'] = 404;
            $jsonData['message'] = '不存在此条记录';
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
        $jsonData['data'] = Enterprise::offset($offset)->limit($limit)->get()->toArray();
        $jsonData['total'] = Enterprise::all()->count();
        return response()->json($jsonData);
    }

    public function alls()
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '查询成功！';
        $jsonData['data'] = Enterprise::all()->toArray();
        return response()->json($jsonData);
    }

    public function show(Request $request, $id)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '查询成功！';
        $enterprise = Enterprise::find($id);
        if ($enterprise) {
            $jsonData['data'] = $enterprise->toArray();
        } else {
            $jsonData['status'] = 404;
            $jsonData['message'] = '不存在此记录！';
        }
        return response()->json($jsonData);
    }

    public function put(Request $request, $id)
    {
        $jsonData['status'] = 200;
        $jsonData['message'] = '修改成功！';
        $enterprise = Enterprise::find($id);
        if ($enterprise) {
            $enterprise->name = $request->get('name','');
            $enterprise->address = $request->get('address','');
            $enterprise->contacts = $request->get('contacts','');
            $enterprise->phone = $request->get('phone','');
            if (!$enterprise->save()) {
                $jsonData['status'] = 300;
                $jsonData['message'] = '修改失败！';
            }
        } else {
            $jsonData['status'] = 404;
            $jsonData['message'] = '不存在此条记录!';
        }
        return response()->json($jsonData);
    }
}
