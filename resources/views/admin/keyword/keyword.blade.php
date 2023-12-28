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

                                <h3 class="fw-bold mb-0">Product</h3>
                            
                            @if($rolePermissions)
                                @foreach($rolePermissions as $rolePermission)
                                    @if($rolePermission->permission->url == 'create-product')
                               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="icofont-plus-circle me-2 fs-6"></i> Add Product</button>
                                    @endif
                                @endforeach
                            @endif

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

                                                <th>Product</th>

                                                <th>Request by / Created by</th>

                                                <th>Creation Date</th>

                                                <th>Status</th>

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                                $i=1;

                                            ?>

                                            @foreach($keyword as $keywords)

                                            <tr>

                                                <td>{{$i}}</td>

                                                <td>{{$keywords->name}}</td>



                                                 @if($keywords->type == "seller")

                                                <td>

                                                    @if($keywords->seller !== null)

                                                    {{$keywords->seller->first_name}} {{$keywords->seller->last_name}}

                                                    @else

                                                    NA

                                                    @endif

                                                </td>

                                                @else

                                                <td>{{$keywords->created_by}}</td>

                                                @endif

                                                

                                                <td>{{$keywords->created_at->format('d/m/Y')}}</td>

                                                <td>

                                                    @if($keywords->status ==1)

                                                    <span class="badge bg-success">Active</span>

                                                    @else

                                                    <span class="badge bg-danger">Reject</span>

                                                    @endif

                                                </td>

                                                <td> <div class="btn-group" role="group" aria-label="Basic outlined example">

                                            @if($rolePermissions)
                                                @foreach($rolePermissions as $rolePermission)
                                                    @if($rolePermission->permission->url == 'edit-product')
                                                       <a href="javascript:void(0)" data-id="{{$keywords->id}}" data-name="{{$keywords->name}}" data-status="{{$keywords->status}}" class="btn btn-outline-secondary btn-sm editkeyword viewinquery"><i class="icofont-edit text-success"></i></a>
                                                  @endif
                                                @endforeach
                                            @endif

                                            @if($rolePermissions)
                                                @foreach($rolePermissions as $rolePermission)
                                                    @if($rolePermission->permission->url == 'delete-product')
                                                       <a href="{{route('deletekeyword',$keywords->id)}}" class="btn btn-outline-secondary btn-sm deleterow"  onclick="return confirm('Are you sure Delete this Recored ?')"><i class="icofont-ui-delete text-danger"></i></a>
                                                       @endif
                                                @endforeach
                                            @endif


                                                        

                                                    </div>
                                                    @if($rolePermissions)
                                                     @foreach($rolePermissions as $rolePermission)
                                                    @if($rolePermission->permission->url == 'product-status')
                                                    <div class="btn-group">

                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Status</button>

                                                        <ul class="dropdown-menu border-0 shadow bg-primary">

                                                            @if($keywords->status == 0)

                                                             <li><a class="dropdown-item text-light"  href="{{ route('keywordstatus', ['id' => $keywords->id, 'status' => '1']) }}">Active</a></li>


                                                            <li><a class="dropdown-item text-light"  href="{{ route('keywordstatus', ['id' => $keywords->id, 'status' => '2']) }}">Reject</a></li>

                                                            @elseif($keywords->status == 1)

                                                            <li><a class="dropdown-item text-light"  href="{{ route('keywordstatus', ['id' => $keywords->id, 'status' => '2']) }}">Reject</a></li>

                                                            @elseif($keywords->status == 2)

                                                            <li><a class="dropdown-item text-light"  href="{{ route('keywordstatus', ['id' => $keywords->id, 'status' => '1']) }}">Active</a></li>

                                                             @else

                                                               <li><a class="dropdown-item text-light"  href="{{ route('keywordstatus', ['id' => $keywords->id, 'status' => '1']) }}">Active</a></li>

                                                               <li><a class="dropdown-item text-light"  href="{{ route('keywordstatus', ['id' => $keywords->id, 'status' => '2']) }}">Reject</a></li>

                                                               @endif

                                                        </ul>

                                                    </div>
                                                      @endif
                                                @endforeach
                                            @endif
                                                </td>

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
                



<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Product</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="deadline-form">

                            <form method="post" action="{{route('store.keyword')}}" onsubmit="return validateForm()" id="myForm">

                                @csrf

                                <div class="row g-3 mb-3">

                                    <div class="col-sm-12">

                                        <label for="item" class="form-label">Enter Product Name</label>

                                        <input type="text" class="form-control" id="item" placeholder="Enter Product Name" name="name" required>
                                          <span id="error-msg" class="error" style="color:red"></span>
                                            <br>
                                    </div>

                                </div>

                                

                        </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Save</button>

                </div>

                    </form>

            </div>

        </div>

    </div>





<div class="modal fade editmodel" id="editmodel" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Product</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="deadline-form">

                            <form method="post" action="{{route('updatekeyword')}}"  onsubmit="return validateFormedit()" id="myForm">

                                @csrf

                                <div class="row g-3 mb-3">

                                    <div class="col-sm-12">

                                        <input type="hidden" name="id" id="id">

                                        <label for="item" class="form-label">Product</label>

                                        <input type="text" class="form-control" id="name" placeholder="Enter Product" name="name" required>
                                        <span id="error-msgedit" class="error" style="color:red"></span>
                                            <br>
                                    </div>

                                </div>

                                

                        </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Save</button>

                </div>

                    </form>

            </div>

        </div>

    </div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
  function validateForm() {
    var itemName = document.getElementById("item").value;

    // Check if the input contains only whitespace
    if (itemName.trim() === "") {
      document.getElementById("error-msg").innerHTML = "Product name cannot be empty.";
      return false;
    } else {
      document.getElementById("error-msg").innerHTML = "";
      return true;
    }
  }
    function validateFormedit() {

    var itemName = document.getElementById("name").value;

    // Check if the input contains only whitespace
    if (itemName.trim() === "") {
      document.getElementById("error-msgedit").innerHTML = "Product name cannot be empty.";
      return false;
    } else {
      document.getElementById("error-msgedit").innerHTML = "";
      return true;
    }
  }


    $(document).ready(function(){



    $(document).on('click','.viewinquery' , function(){

    });

    

    $(document).on('click','.viewinquery' , function(){

            var id = $(this).data('id');

            var name = $(this).data('name');



            $('#id').val(id);

            $('#name').val(name);

            $('.editmodel').modal('show');

        });

    });

</script>

