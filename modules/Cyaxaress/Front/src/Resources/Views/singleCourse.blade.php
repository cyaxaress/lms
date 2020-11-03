@extends('Front::layout.master')

@section('content')
    <main id="single">
    <div class="container">
        <article class="article">
            @include('Front::layout.header-ads')
            <div class="h-t">
                <h1 class="title"> {{ $course->title }}</h1>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="/" title="خانه">خانه</a></li>
                        @if($course->category->parentCategory)
                            <li><a href="{{ $course->category->parentCategory->path() }}" title="{{ $course->category->parentCategory->title }}">
                                    {{ $course->category->parentCategory->title }}</a>
                            </li>
                        @endif
                        <li><a href="{{ $course->category->path() }}" title="{{ $course->category->title }}">{{ $course->category->title }}</a></li>
                    </ul>
                </div>
            </div>
        </article>
    </div>
    </main>
@endsection
