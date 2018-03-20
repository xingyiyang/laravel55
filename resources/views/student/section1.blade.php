@extends('layouts')

@section('header')
    @parent
    header
@stop

@section('sidebar')
    sidebar
@stop

@section('content')
    content

    {{--<p>{{$name}}</p>--}}

    {{--<!-- 模板中调用php 代码-->--}}
    {{--<p>{{time()}}</p>--}}
    {{--<p>{{date('Y-m-d H:i:s', time())}}</p>--}}

    {{--<p>{{in_array($name, $arr) ? 'true':'false'}}</p>--}}

    {{--<!-- 原样输出 -->--}}
    {{--<p>@{{ $name }}</p>--}}

    {{-- 模板中的注释 --}}

    {{-- 引入子视图 --}}

    {{--@include('student.common1', ['message' => 'i am message'])--}}

    {{--<br>--}}
    {{--@if ($name == 'xing')--}}
        {{--i am xing--}}
    {{--@elseif($name == 'imooc')--}}
        {{--i am imooc--}}
    {{--@else--}}
        {{--who am i--}}
    {{--@endif--}}

    {{--<br>--}}
    {{--@foreach($students as $student)--}}
        {{--<p>{{$student->name}}</p>--}}
    {{--@endforeach--}}
    <br>
    <a href="{{url('url')}}">my url()</a>
    <br>
    <a href="{{route('url')}}">my route()</a>

    <br>
    <a href="{{action('StudentController@url')}}">my action()</a>


@stop