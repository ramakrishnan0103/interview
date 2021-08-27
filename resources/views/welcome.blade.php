@extends('layouts.app')

@section('content')

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <div class="row">
                @foreach($media as $key=>$value)
                    <div class="card">
                        <h2>{{$value->title}}</h2>
                        <img src="{{$value->file_path}}" width="100">
                    </div>
                @endforeach
                </div>
            </div>
@endsection