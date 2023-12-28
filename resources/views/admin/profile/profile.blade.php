@extends('layouts.adminheader')
@section('content')
<div class="body d-flex py-3">
     <div class="row">
                <div class="col-sm-12">
         
                     @include('layouts.msg')
                </div>
                </div>  
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">My Profile</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->

                    <div class="row align-item-center">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Admin Profile</h6> 
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{route('adminupdateprofile')}}">
                                        @csrf
                                        <div class="row g-3 mb-3">
                                            <div class="col-md-12">
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Name</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="dataScaleY" placeholder="Name" name="name" value="{{ isset($user->name) && !empty($user->name) ? $user->name : '' }}">

                                                </div>
                                            </div>

                                       

                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Mobile Number</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="dataScaleY" placeholder="Mobile Number" name="mobile" value="{{ isset($user->mobile) && !empty($user->mobile) ? $user->mobile : '' }}" size="10" maxlength="10" minlength="10" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                </div>
                                            </div>

                                            

                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Email Address</span>
                                                    </div>
                                                    <input type="email" class="form-control" id="dataScaleY" placeholder="Email Address" name="email" value="{{ isset($user->email) && !empty($user->email) ? $user->email : '' }}" readonly>
                                                </div>
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