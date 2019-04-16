@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
    {{--        @include('admin.sidebar') --}}

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Album {{$album->name}}</div>
                    <div class="card-body">
                      

                    <a href="{{ url('/albums/') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/albums/' . $album->id . '/edit') }}" title="Edit Album"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('albums' . '/' . $album->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete album" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <br/>
                        <br/>

    <!-- Page Content -->
    <div class="container page-top">



        <div class="row">


        <div class="card-deck">

        @if(count($album->pictures)>0)
        @foreach($album->pictures as $item)
        <div class="card">
        <img src="/uploads/photos/{{ $item->photo }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$item->title}}</h5>
            <p class="card-text">{{ $item->description }}</p>
            <p class="card-text"><small class="text-muted">
            
                                <a href="{{ url('/albums/' . $item->id) }}" title="View Album"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                <a href="{{ url('/albums/' . $item->id . '/edit') }}" title="Edit Album"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                <form method="POST" action="{{ url('/albums' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Album" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
            </small></p>
        </div>
        </div>
        @endforeach
        @else
                No Images
        @endif
        </div>
        </div>










        

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
