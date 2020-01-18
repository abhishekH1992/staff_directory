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
                            <img src="{{$d->image}}" height="150">
                        @else
                            <img src="assets/img/profile-image.jpg" height="150">
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
<div class="pagination"> 
    {!! $data->appends(Request::except('page'))->render() !!}
</div>