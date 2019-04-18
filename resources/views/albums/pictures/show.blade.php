@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Picture {{ $picture->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/albums/pictures') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/albums/pictures/' . $picture->id . '/edit') }}" title="Edit Picture"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('albums/pictures' . '/' . $picture->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Picture" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $picture->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $picture->title }} </td></tr>
                                    
                                    <tr><th> Description </th><td> {{ $picture->description }} </td></tr>
                                    <tr><th> Cover Image </th>
                                    <td> <img src="/uploads/photos/{{ $picture->photo }}" width="200px" height="150px" style="border-radius:50px;50px;"/> </td>
                                    </tr>

                                    <tr><th> album </th><td> {{ $picture->album->name }} </td></tr>

                                    
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
