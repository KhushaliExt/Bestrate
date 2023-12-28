@extends('layouts.adminheader')
@section('content')
      <div class="body d-flex py-3">  
                <div class="container-xxl"> 
                    <div class="row align-items-center"> 
                        <div class="border-0 mb-4"> 
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">User Role</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row g-3 mb-3"> 
                        <div class="col-md-12">
                            <div class="card"> 
                                <div class="card-body"> 
                                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">  
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i=1;
                                            ?>
                                            @foreach($roles as $role)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$role->name}}</td>
                                            	<td><div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <a href="{{route('rolepermission',$role->id)}}" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                    </div></td>
                                            </tr>
                                            <?php 
                                                $i++;
                                            ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                </div>
            </div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add User Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="deadline-form">
                            <form>
                                <div class="row g-3 mb-3">
                                    <div class="col-sm-12">
                                        <label for="item" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="item" placeholder="Enter Name" name="name">
                                    </div>
                                </div>
                                
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>

                                
                            </form>
            </div>
        </div>
    </div>
@endsection