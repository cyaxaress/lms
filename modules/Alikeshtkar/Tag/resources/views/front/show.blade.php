@extends('Front::layout.master')

@section('content')
    <main id="index">
        <div class="container">
            <div class="box-filter">
                <div class="b-head">
                    <h2>دوره های برچسب  {{ $tag->title }}</h2>
                </div>
                <div class="posts">
                    @foreach($tag->courses as $courseItem)
                        @include('Front::layout.singlecourseBox')
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
