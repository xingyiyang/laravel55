<?php
/**
 * Created by PhpStorm.
 * User: xing
 * Date: 2018/3/17
 * Time: 21:41
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu extends Model
{
    const SEX_UN = 1; //未知
    const SEX_B = 2; //男
    const SEX_G = 3; //女

    protected $table = 'student';

    protected $fillable = ['name','age','sex'];

    public $timestamps = true;

    public function freshTimestamp()
    {
        return time();
    }

    public function fromDateTime($value)
    {
        return $value;
    }

    protected  function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }

    public function getSex($ind = null)
    {
        $arr = [
            self::SEX_UN => '未知',
            self::SEX_B => '男',
            self::SEX_G => '女',
        ];
        if ($ind != null){
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::SEX_UN];
        }

        return $arr;
    }
}