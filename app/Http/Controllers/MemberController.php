<?php
/**
 * Created by PhpStorm.
 * User: xing
 * Date: 2018/3/17
 * Time: 10:41
 */

namespace App\Http\Controllers;

use App\Member;

class MemberController extends Controller
{
    public function info()
    {
        //return 'member-info';
        //return route('memberinfo');
        //return view('member-info');
        //return view('info');
        //return view('member/info');
//        return view('member/info', [
//            'name' => 'yiyang',
//            'age' => 18
//        ]);
        return Member::getMember();

    }
}