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
                        <div class="img-center" style="width:100%; height:100%">
                            <img src="{{$d->image}}" height="150" width="150">
                        </div>
                        @else
                        <div class="img-center" style="width:100%; height:100%">
                            <img src="assets/img/profile-image.jpg" height="150" width="150">
                        </div>
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
    {{ $data->links() }}
</div>