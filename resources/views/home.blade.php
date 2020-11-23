@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       you are Moderator <br>
                        <a href="{{ route('reddit.search') }}"> Reddit Search API</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


