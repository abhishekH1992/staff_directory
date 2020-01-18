@extends('layouts.app')
@section('title', 'Index')
@section('content')

<body>
    @include('layouts.menu')

    <div class="header-spacer"></div>

    <div class="container">

        <div class="ui-block">
            <div class="ui-block-content">
                <div class="row">
                    <div class="col col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" id="search" placeholder="Start typing keyword.." name="search">
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
                $count = count($data);//dd($data[0]->fname);
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
        </div>
    </div>

</body>
@endsection
