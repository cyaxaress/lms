<div class="box-filter">
    <div class="b-head">
        <h2>دوره های پیشنهادی</h2>
        <a href="all-courses.html">مشاهده همه</a>
    </div>
    <div class="posts">
        @foreach($popularCourses as $courseItem)
            @include('Front::layout.singleCourseBox')
        @endforeach
    </div>
</div>
