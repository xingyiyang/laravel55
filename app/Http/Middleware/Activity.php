<?php
/**
 * Created by PhpStorm.
 * User: xing
 * Date: 2018/3/17
 * Time: 20:38
 */

namespace App\Http\Middleware;

use Closure;

class Activity
{
    public function handle($request, Closure $next)
    {
        if (time() < strtotime('2018-03-16')){
            return redirect('activity0');
        }

        return $next($request);
    }
}