<?php
/**
 * Created by PhpStorm.
 * User: xing
 * Date: 2018/3/17
 * Time: 14:55
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //指定表名
    protected $table = 'student';

    //指定主键
    protected $primaryKey = 'id';

    //指定允许批量赋值
    protected $fillable = ['name','age'];

    //指定不允许批量赋值字段
    protected $guarded = [];

    //自动维护时间戳
    public $timestamps = true;

    protected function getDateFormat()
    {
        return time();
    }

//    protected function asDateTime($value)
//    {
//        return $value;
//    }
}