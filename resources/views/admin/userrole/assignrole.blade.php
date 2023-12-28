@extends('layouts.adminheader')
@section('content')
<div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Assign Permission</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->

                    <div class="row align-item-center">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Assign Permission</h6> 
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{route('updatepermission')}}">
                                    	@csrf
                                        <div class="row g-3 mb-3">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Role</span>
                                                    </div>
                                                    <input type="hidden" name="roleid" value="{{$role->id}}">
                                                    <input type="text" class="form-control" id="dataScaleY" placeholder="Role" value="{{$role->name}}" readonly name="role">
                                                </div>
                                            </div>

                                            <div class="row g-3 mb-3">
                                            	@foreach($permission as $permissions)
                                           		<div class="col-md-3">

                                           			<input type="checkbox" name="permission[]" value="{{$permissions->id}}" {{ $rolepermission->contains('permission_id', $permissions->id) ? 'checked' : '' }}>
                                           			<label>{{$permissions->name}}</label>
                                           		</div>
                                           		@endforeach
                                           	</div>

                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                    </form>
                                </div>
                            </div>
                           
                        </div>
                    </div><!-- Row end  -->

                </div>
            </div>

@endsection