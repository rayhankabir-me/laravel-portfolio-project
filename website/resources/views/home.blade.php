@extends('Layout.app')
@section('title', 'Home')
@section('content')


@include('Component.HomeBanner')
@include('Component.HomeService')
@include('Component.HomeCourse')
@include('Component.HomeProjects')
@include('Component.HomeContact')



@endsection