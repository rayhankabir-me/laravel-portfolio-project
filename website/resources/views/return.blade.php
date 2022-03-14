@extends('Layout.app')
@section('title', 'Return Policy')
@section('content')

<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
                <img class=" page-top-img fadeIn" src="images/knowledge.svg">
                <h1 class="page-top-title mt-3">- Return Policy -</h1>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">


        <div class="col-md-12 p-1">
            
            <div class="text-contain">
                <h2>Issuance of Refunds</h2>
                <ul>
                    <li>The processing time of your refund depends on the type of refund and the payment method you used.</li>
                    <li>The refund period / process starts when Daraz has processed your refund according to your refund type.</li>
                    <li>The refund amount covers the item price and shipping fee for your returned product.</li>
                </ul>

                <h2>Refund Types</h2>
                <p>rkDynamic will process your refund according to the following refund types</p>
                <ul>
                    <li>Refund from returns - Refund is processed once your item is returned to the warehouse and QC is completed (successful). To learn how to return an item, read our Return Policy.</li>
                    <li>Refunds from cancelled orders - Refund is automatically triggered once cancelation is successfully processed.</li>
                    <li>Refunds from failed deliveries - Refund process starts when the item has reached the seller. Please take note that this may take more time depending on the area of your shipping address. Screen reader support enabled.</li>
                </ul>

            </div>
        </div>


    </div>
</div>



@endsection