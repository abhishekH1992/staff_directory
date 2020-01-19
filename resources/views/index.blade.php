@extends('layouts.app')
@section('title', 'Index')
@section('content')

<body>
    @include('layouts.menu')

    <div class="header-spacer"></div>

    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
        @endif

        <div class="ui-block">
            <div class="ui-block-content">
                <div class="row">
                    <div class="col col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" id="search" placeholder="Start typing staff name.." name="search">
                        </div>
                    </div>
                    <div class="col col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="form-group">
                            <select id="department" class="form-control">
                                <option value="0">All Departments</option>
                                @foreach($department as $d)
                                <option value="{{$d->id}}">{{$d->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>        
            </div>
        </div>

        <div id="filter">
            <?php
                $count = count($data);//dd($data);
            ?>
            @if($count > 0)
                @foreach($data as $d)
                    <div class="ui-block">
                        <div class="ui-block-content">
                            <div class="row">
                                <div class="col col-lg-2 col-md-2 col-sm-12 col-12">
                                    @if($d->image != null)
                                        <img src="{{$d->image}}" height="150" width="150">
                                    @else
                                        <img src="assets/img/profile-image.jpg" height="150" width="150">
                                    @endif
                                </div>
                                <div class="col col-lg-10 col-md-10 col-sm-12 col-12">
                                    <div class="heading">
                                        {{$d->fname}} {{$d->lname}}
                                    </div>
                                    <span class="tp-margin small">
                                        {{$d->departments->name}}
                                    </span>
                                    <p class="tp-margin">
                                        {{$d->profile}}
                                    </p>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <hr/>
                                    <form action="{{ route('staff.destroy', $d->id)}}" method="post" class="float-right">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('staff.edit',$d->id)}}" class="btn btn-warning float-right right-margin">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <span class="small">
                                        Created on: {{date('d,M Y', strtotime($d->created_at))}} 
                                        @if($d->created_at != $d->updated_at)
                                            | Updated on: {{date('d,M Y', strtotime($d->updated_at))}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>    
                @endforeach
            @else
                <div class="ui-block">
                    <div class="ui-block-content">
                        <div class="row">
                            <div class="col col-lg-2 col-md-2 col-sm-12 col-12">
                                No data found
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="pagination"> 
                {{ $data->appends(Request::except('page'))->links() }}
            </div>
        </div>
    </div>

    <!-- Department Modal -->
    <div class="modal fade" id="departmentModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Department</h4>
                </div>
                <form class="content" id="new-department-form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="control-label">Department Name</label>
                                <input class="form-control" name="name" type="text">
                                <span id="nameErr"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div> 
        </div>
    </div>

    <!-- CSV Uplaod -->
    <div class="modal fade" id="csvModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Import Staff</h4>
                </div>
                <form class="content" id="new-csv-form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="control-label">File</label>
                                <input class="form-control" name="file" type="file">
                                <span id="fileErr"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Import</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div> 
        </div>
    </div>
</body>
@endsection
