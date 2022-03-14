<div class="container section-marginTop text-center">
    <h1 class="section-title">Our Services </h1>
    <h1 class="section-subtitle">All the other services we provide, including IT courses, project based source code </h1>
    <div class="row">


    @foreach($servicesData as $servicesData)
        <div class="col-md-3 p-2 ">
            <div class="card service-card text-center w-100">
                <div class="card-body">
                    <img class="service-card-logo " src="{{$servicesData->services_img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-3">{{$servicesData->services_name}}</h5>
                    <h6 class="service-card-subTitle p-0 m-0">{{$servicesData->services_desc}}</h6>
                </div>
            </div>
        </div>

    @endforeach




    </div>
</div>