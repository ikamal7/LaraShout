@extends('layout')


@section('status')
    @foreach ($status as $item)
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="status shadow-sm" class="">
                        <div class="row p-3 pb-2">
                            <div class="col-md-2">
                            <img style="width:50px;" src="{{ $avatar }}" class="mt-3 rounded-circle img-thumbnail mx-auto d-block" alt="">
                            </div>
                            <div class="col-md-10 p-3 pr-5">
                                <p class="author">
                                <strong>{{ $name }}</strong> Said
                                <span class="date">{{ date('H:i A, dS M Y', strtotime($item->created_at)) }}</span>
                                </p>
                                <p class="content">
                                    {{$item['status']}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('action')
    @if ($displayAction)
    <a class="text-white" href="{{ route('shout.addfriend', $friendID) }}">Add friend</a>|
    <a class="text-white" href="{{ route('shout.unfriend', $friendID) }}">Unfriend</a>
    @endif
@endsection

@section('script')

@endsection