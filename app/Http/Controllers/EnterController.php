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
}
