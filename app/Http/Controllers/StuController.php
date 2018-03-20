<?php
/**
 * Created by PhpStorm.
 * User: xing
 * Date: 2018/3/17
 * Time: 21:16
 */

namespace App\Http\Controllers;

use App\Stu;
use Illuminate\Http\Request;

class StuController extends Controller
{
    public function index()
    {
        $students = Stu::paginate(3);
        return view('stu.index', [
            'students' => $students,
        ]);
    }

    public function create(Request $request)
    {
        $stu = new Stu();
        if ($request->isMethod('POST')){

            //控制器验证
//            $this->validate($request,[
//               'Stu.name' => 'required|min:2|max:20',
//                'Stu.age' => 'required|integer',
//                'Stu.sex' => 'required|integer',
//            ], [
//                'required' => ':attribute 必填项',
//                'min' => 'attribute 长度不符合要求',
//                'integer' => ':attribute 必须为整数',
//            ],[
//                'Stu.name' => '姓名',
//                'Stu.age' => '年龄',
//                'Stu.sex' => '性别',
//            ]);

            //validator类验证
            $validator = \Validator::make($request->input(),[
                'Stu.name' => 'required|min:2|max:20',
                'Stu.age' => 'required|integer',
                'Stu.sex' => 'required|integer',
            ], [
                'required' => ':attribute 必填项',
                'min' => 'attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ],[
                'Stu.name' => '姓名',
                'Stu.age' => '年龄',
                'Stu.sex' => '性别',
            ]);

            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('Stu');
            if (Stu::create($data)){
                return redirect('stu/index')->with('success','添加成功');
            }else{
                return redirect()->back();
            }
        }
        return view('stu.create',[
            'student' => $stu
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->input('Stu');
        $stu = new Stu();
        $stu->name = $data['name'];
        $stu->age = $data['age'];
        $stu->sex = $data['sex'];

        if($stu->save()){
            return redirect('stu/index');
        }else{
            return redirect()->back();
        }

    }

    public function update(Request $request, $id)
    {
        $stu = Stu::find($id);

        if($request->isMethod('POST'))
        {
            $this->validate($request,[
                'Stu.name' => 'required|min:2|max:20',
                'Stu.age' => 'required|integer',
                'Stu.sex' => 'required|integer',
            ], [
                'required' => ':attribute 必填项',
                'min' => 'attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ],[
                'Stu.name' => '姓名',
                'Stu.age' => '年龄',
                'Stu.sex' => '性别',
            ]);

            $data = $request->input('Stu');
            $stu->name = $data['name'];
            $stu->age = $data['age'];
            $stu->sex = $data['sex'];

            if($stu->save()){
                return redirect('stu/index')->with('success', '修改成功-'.$id);
            }
        }

        return view('stu.update', [
            'student' => $stu
        ]);
    }

    public function detail($id)
    {
        $stu = Stu::find($id);
        return view('stu.detail', [
            'student' => $stu
        ]);
    }

    public function delete($id)
    {
        $stu = Stu::find($id);
        if ($stu->delete()){
            return redirect('stu/index')->with('success', '删除成功-'.$id);
        }else{
            return redirect('stu/index')->with('error', '删除失败-'.$id);

        }
    }
}