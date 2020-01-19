@extends('layouts.app')
@section('title', 'Edit Staff')
@section('content')

<body>
    @include('layouts.menu')

    <div class="header-spacer"></div>
    <div class="container"> 
	    @if ($errors->any())
	      <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	              <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	      </div><br />
	    @endif

	    <div class="ui-block">
	    	<div class="ui-block-title">
	    		Edit Staff
	    	</div>
	    	<div class="ui-block-content">
	            <form class="content" id="edit-staff-form" enctype="multipart/form-data" action="{{ route('staff.update',$data->id)}}">
	                {{ csrf_field() }}
	                @method('PATCH')
					<div class="row">
	    				<div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
	        				<div class="form-group">
	            				<label class="control-label">First Name</label>
	            				<input class="form-control" name="fname" type="text" value="@if(old('fname')!= "")old('fname')@elseif(isset($data->fname)){{$data->fname}}@endif">
	            				<span id="fnameErr"></span>
	        				</div>
	    				</div>
						<div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
	        				<div class="form-group">
	            				<label class="control-label">Last Name</label>
	            				<input class="form-control" name="lname" type="text" value="@if(old('lname')!= "")old('lname')@elseif(isset($data->lname)){{$data->lname}}@endif">
	            				<span id="lnameErr"></span>
	        				</div>
	    				</div>
						<div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
	        				<div class="form-group">
	            				<label class="control-label">Profile Image</label>
	            				<input class="form-control" name="image" type="file" accept="image/png, image/jpg, image/jpeg">
	            				<span id="imageErr"></span>
	        				</div>
	    				</div>
	    				<div class="col col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
	                        <div class="form-group">
	                        	<label class="control-label">Department</label>
	                            <select name="department" class="form-control">
	                                <option disabled="" selected="true">Select Department</option>
	                                @foreach($department as $d)
	                                <option value="{{$d->id}}" @if($data->department == $d->id)selected="selected"@elseif(old('department') == $d->id)selected="selected"@endif>{{$d->name}}</option>
	                                @endforeach
	                            </select>
	                            <span id="departmentErr"></span>
	                        </div>
	                    </div>
	                    <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                        <div class="form-group">
	                        	<label class="control-label">Profile Description</label>
	                            <textarea rows="5" name="profile" class="form-control">@if(old('profile') != "")old('profile')@else{{$data->profile}}@endif{{old('profile')}}</textarea>
	                            <span id="profileErr"></span>
	                        </div>
	                    </div>
	                    <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                        <a href="/" class="btn btn-default float-right ">Cancel</a>
	                        <button type="submit" class="btn btn-primary float-right right-margin">Edit</button>
	                    </div>
	                </div>
	            </form>
	        </div>
		</div>
	</div>
</body>
@endsection