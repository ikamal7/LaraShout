@extends('layout')

@section('form')
<div class="container mb-5 mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row">
                <div class="col-6">
                    <img class="mw-100" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                </div>
                <div class="col-6 align-middle">
                    <h2>{{ Auth::user()->name }}</h2>
                    <h4>{{ Auth::user()->nickname }}</h4>
                    <a class="btn btn-primary" href="{{route('shout.profileEdit')}}">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')

@endsection