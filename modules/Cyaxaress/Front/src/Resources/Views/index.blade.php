@extends('Front::layout.master')
@section('content')
    <article class="container article">
        @include('Front::layout.header-ads')
        @include('Front::layout.top-info')
        @include('Front::layout.latestCourses')
        @include('Front::layout.popularCourses')
    </article>
    @include('Front::layout.latestArticles')
@endsection
