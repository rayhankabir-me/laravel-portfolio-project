<div class="container section-marginTop text-center">
    <h1 class="section-title">কোর্স সমূহ </h1>
    <h1 class="section-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
    <div class="row">


        @foreach($coursesData as $courseData)

        <div class="col-md-4 thumbnail-container">
                <img src="{{$courseData->course_img}}" alt="Avatar" class="thumbnail-image">
                <div class="thumbnail-middle">
                    <h1 class="thumbnail-title">{{$courseData->course_name}}</h1>
                    <h1 class="thumbnail-subtitle">{{$courseData->course_desc}}</h1>
                    <a href="{{$courseData->course_link}}" target="_blank" class="normal-btn btn">Start Now</a>
                </div>
        </div>

        @endforeach


    </div>
</div>