@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
    {{--        @include('admin.sidebar') --}}

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Albums</div>
                    <div class="card-body">
                        <a href="{{ url('/albums/create') }}" class="btn btn-success btn-sm" title="Add New Album">
                            <i class="fa fa-plus" aria-hidden="true"></i> upload image in this album
                        </a>

                        <form method="GET" action="{{ url('/albums') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>

    <!-- Page Content -->
    <div class="container page-top">



        <div class="row">


        <div class="card-deck">

        @foreach($albums as $item)
        <div class="card">
        <img src="/uploads/albums/{{ $item->cover_image }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$item->name}}</h5>
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

        </div>
        </div>










           {{--             <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Description</th><th>Cover Image</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($albums as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td><td>{{ $item->description }}</td>
                                        <td> <img src="/uploads/albums/{{ $item->cover_image }}" width="200px" height="150px" style="border-radius:50px;50px;"/> </td>
                                        <td>
                                            <a href="{{ url('/albums/' . $item->id) }}" title="View Album"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/albums/' . $item->id . '/edit') }}" title="Edit Album"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/albums' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Album" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $albums->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>--}}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
