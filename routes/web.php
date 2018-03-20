<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('basic1', function(){
    return 'hello world';
});

Route::post('basic2', function(){
   return 'basic2';
});

/*多请求路由*/
Route::match(['get', 'post'], 'multy1', function(){
    return 'multy1';
});

/*响应所有类型路由*/
Route::any('multy2', function(){
    return 'multy2';
});

/*路由参数*/
Route::get('user/{id}', function($id){
   return 'user -id- '.$id;
});

/*路由默认参数*/
Route::get('user/{name?}', function($name = 'xing'){
    return 'user -name- '.$name;
});

/*正则表达式路由*/
Route::get('user/{id}/{name?}', function($id, $name = 'xing'){
    return 'User-id-'.$id.'-name-'.$name;
})->where(['id' => '[0-9]+', 'name' => '[A-Za-z]+']);

/*路由别名, 可以访问到路由地址*/
Route::get('alias/member-center',['as' => 'center', function(){
    return route('center');
}]);

/*路由群组*/
Route::group(['prefix' => 'member'], function(){
   Route::get('user/center', ['as' => 'center', function(){
       return route('center');
   }]) ;

    Route::any('multy2', function(){
        return 'member-multy2';
    });
});

//路由中的输出视图
Route::get('view', function () {
    return view('welcome');
});

Route::get('member/info', 'MemberController@info');

//Route::get('member/info',[ 'uses' => 'MemberController@info']);

//Route::any('member/info',[
//    'uses' => 'MemberController@info',
//    'as' => 'memberinfo'
//]);

Route::any('test1', 'StudentController@test1');

Route::any('query1', 'StudentController@query1');

Route::any('query2', 'StudentController@query2');

Route::any('query3', 'StudentController@query3');

Route::any('query4', 'StudentController@query4');

Route::any('query5', 'StudentController@query5');

Route::any('orm1', 'StudentController@orm1');

Route::any('orm2', 'StudentController@orm2');

Route::any('orm3', 'StudentController@orm3');

Route::any('orm4', 'StudentController@orm4');

Route::any('section1', 'StudentController@section1');

Route::any('url', ['as' => 'url', 'uses' =>  'StudentController@url']);

Route::any('request1', 'StudentController@request1');

Route::group(['middleware' => ['web']], function(){
    Route::any('session1', 'StudentController@session1');
    Route::any('session2', 'StudentController@session2');
    Route::any('response', 'StudentController@response');

});

Route::any('activity0', 'StudentController@activity0');

Route::group(['middleware' => ['activity']], function (){
    Route::any('activity1', 'StudentController@activity1');
    Route::any('activity2', 'StudentController@activity2');
} );

Route::group(['middleware' => ['web']], function (){
    Route::get('stu/index', ['uses' => 'StuController@index']);
    Route::any('stu/create', ['uses' => 'StuController@create']);
    Route::any('stu/save', ['uses' => 'StuController@save']);
    Route::any('stu/update/{id}', ['uses' => 'StuController@update']);
    Route::any('stu/detail/{id}', ['uses' => 'StuController@detail']);
    Route::any('stu/delete/{id}', ['uses' => 'StuController@delete']);

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
