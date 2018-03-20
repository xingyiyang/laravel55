<?php
/**
 * Created by PhpStorm.
 * User: xing
 * Date: 2018/3/17
 * Time: 11:33
 */
namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function test1()
    {
        return 'test1';
        //查询
        //$students = DB::select('select * from student');
        //var_dump($students);

        //新增
        //$bools = DB::insert('insert into student(name, age) VALUES(?, ?) ',
        //   ['yiyang', 18]);
        //var_dump($bools);

        //更新
        //$num = DB::update('update student set age = ? where name = ?',
        //    [20, 'xing']);
        //var_dump($num);

        //查询
        //$students = DB::select('select * from student');
        //dd($students);

        //删除
        //$num = DB::delete('delete from student where id > ?', [1001]);
        //var_dump($num);
    }

    public function query1()
    {
//        $bool = DB::table('student')->insert(
//            ['name' => 'imooc', 'age' => 18]
//        );
//        var_dump($bool);
//          $id = DB::table('student')->insertGetId(
//              ['name' => 'xing', 'age' => 21]
//          );
//          var_dump($id);

        $num = DB::table('student')->insert(
            [['name' => 'name1', 'age' => 21],
            ['name' => 'name2', 'age' => 22],
        ]);
        var_dump($num);
    }

    public function query2()
    {
//        $num = DB::table('student')
//            ->where('id', 1007)
//            ->update(['age' => 23]);
//        $num = DB::table('student')->increment('age');
//          $num = DB::table('student')->increment('age',3);
          $num = DB::table('student')->decrement('age');


        var_dump($num);
    }

    public function query3()
    {
//        $num = DB::table('student')
//            ->where('id',1007)
//            ->delete();

//        $num = DB::table('student')
//            ->where('id','>=',1003)
//            ->get();

        $num = DB::table('student')
            ->whereRaw('id>=? and agr>?', [1003, 18])
            ->get();
        var_dump($num);
    }

    public function query4()
    {
//        $students = DB::table('student')->get();

//        $students = DB::table('student')
//            ->orderby('id','desc')
//            ->first();
//        dd($students);

//          $names = DB::table('student')
//              ->pluck('name');

//          $names = DB::table('student')
//              ->pluck('name', 'id');

//           $names = DB::table('student')
//               ->select('name', 'id', 'age')
//               ->get();
//          dd($names);

            echo '<pre>';
            DB::table('student')
                ->orderBy('id', 'desc')
                ->chunk(2, function($students){
                  var_dump($students);
//                  if(){
//                      return false;
//                  }
            });
    }

    public function query5()
    {
        DB::table('student')->count();
        DB::table('student')->max('age');
        DB::table('student')->min('age');
        DB::table('student')->avg('age');
        DB::table('student')->sum('age');
    }

    public function orm1()
    {
//        $students =  Student::all();
//        $students =  Student::find(1001);
//        $students =  Student::findOrFail(1001);
//        $students =  Student::get();
//        $students =  Student::where(id, '>', 10001)
//        ->orderBy('age','desc')
//        ->first();

//        echo '<pre>';
//         $students = Student::chunk(2, function($students){
//            var_dump($students);
//         });

        $students = Student::where('id','>',1003)->max('age');
        dd($students);
    }

    public function orm2()
    {
//        $student = new Student();
//        $student->name = 'xyy2';
//        $student->age = 19;
//        $bool = $student->save();
//        dd($bool);
          //$student = Student::find(1009);
//          echo $student->created_at;
        //echo date('Y-m-d H:i:s', $student->created_at);
//          $student = Student::create(
//              ['name' => 'imocc', 'age' => 16]
//          );

        //以属性查找用户，没有就新增
//        $student = Student::firstOrCreate(
//            ['name' => 'imoocs']
//        );

        //以属性查找用户，没有就新增,需要save
        $student = Student::firstOrNew(
            ['name' => 'imoocs']
        );
        $student->save();
          dd($student);

    }

    public function orm3()
    {
        //通过模型更新数据
//        $student = Student::find(1011);
//        $student->name = 'kitty';
//        $bool = $student->save();
//        var_dump($bool);
        $num = Student::where('id', '>', 1011)->update(['age' => 14]);
        var_dump($num);
    }

    public function orm4()
    {
        //通过模型删除
        $student = Student::find(1011);
        $bool = $student->delete();

        //通过主键删除
        Student::destroy(1011);

        //删除指定条件的数据
        Student::where('id', '>', 1011)->delete();
    }

    public function section1()
    {
        $name = 'xing';
        $arr = ['yi', 'yang'];
        $students = Student::get();
        return view('student.section1', [
            'name' => $name,
            'arr' =>$arr,
            'students' => $students
            ]);
    }

    public function url()
    {
        return 'urlTest';
    }

    public function request1(Request $request)
    {
        //echo $request->input('name');

//        if ($request->has('name')){
//            echo $request->input('name');
//        }else{
//            echo 'no message';
//        }

        $all = $request->all();
        dd($all);

        echo $request->method();
        $request->isMethod('POST');
        $request->ajax();
        //满足路由格式规则
        $request->is('request1/*');
        $request->url();
    }

    public function session1(Request $request)
    {
        $request->session()->put('key1', 'value1');

//        session()->put('key2','value2');
//        session()->get('key3','default');
//        session()->get('key2');

        //以数组的形式存储数据
//        Session::push('student', 'xing');
//        Session::push('student', 'yiyang');
//        Session::all();
//        Session::forget('key1');
//        Session::flush();
//        Session::flash('key1','value1');
    }

    public function session2(Request $request)
    {
        echo $request->session()->get('key1');
    }

    public function response()
    {
//        $data = [
//            'errCode' => 0,
//            'errMsg' => 'success',
//            'data' => 'xing',
//        ];
//        return response()->json($data);

        //重定向
//        return redirect('session2');
//        return redirect('session2')->with('message','只能用一次');
          return redirect()->back();
    }

    public function activity0()
    {
        return '活动快要开始';
    }

    public function  activity1()
    {
        return '活动进行中';
    }

    public function activity2()
    {
        return '活动结束';
    }
}