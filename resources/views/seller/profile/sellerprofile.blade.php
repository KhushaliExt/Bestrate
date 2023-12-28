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



                    <!-- Row end  -->



<div class="row align-item-center">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <div class="row">



                        <div class="col-md-3">

                                    <ul class="nav flex-column nav-pills" role="tablist">

                                @if($rolePermissions)
                                    @foreach($rolePermissions as $rolePermission)
                                        @if($rolePermission->permission->url == 'manage-buyers')
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#review" role="tab">Profile</a></li>
                                    @endif
                                @endforeach
                            @endif
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#descriptions" role="tab">Products</a></li>

                                    </ul>

                        </div>



                        <div class="col-md-9">

                            <div class="tab-content">

                                <div class="tab-pane fade show active" id="review">

                                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">

                          

                                        <div class="card-body">

                             <h6 class="mb-0 fw-bold mb-4">Seller Information Details</h6> 

                                    <form method="post" action="{{route('sellerprofileupdate')}}">

                                        @csrf



                                        <input type="hidden" name="id" value="{{$user->id}}">

                                        <input type="hidden" name="seller_id" value="{{ $seller->id ?? '1' }}">



                                        <div class="row g-3 mb-3">

                                            <div class="col-md-6">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">First Name</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="dataScaleY" placeholder="First Name" name="first_name" value="{{ isset($seller->first_name) ? $seller->first_name : '' }}" required>



                                                </div>

                                            </div>  



                                              <div class="col-md-6">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Last Name</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="dataScaleY" placeholder="Last Name" name="last_name" value="{{ isset($seller->last_name) ? $seller->last_name : '' }}" required>

                                                </div>

                                            </div>



                                            <div class="col-md-6">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Mobile Number</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="dataScaleY" placeholder="Mobile Number" name="mobile_number" value="{{ isset($seller->mobile) ? $seller->mobile : '' }}" required size="10" maxlength="10" minlength="10" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

                                                </div>

                                            </div>


                                            <div class="col-md-6">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Email Address</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="email" placeholder="Email Address" name="email" value="{{ isset($seller->email) ? $seller->email : '' }}" required oninput="validateEmail()">

                                                </div>

                                            </div>

                                             <div class="col-md-6">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Area</span>

                                                    </div>

                                                    <!-- <input type="text" class="form-control" id="dataScaleY" placeholder="Area" name="area" value="{{ isset($seller->area) ? $seller->area : '' }}"> -->



                                                    <select name="area" class="form-control full-width-select" required id="sellerarea">

                                                        <option value="" selected disabled>Select Area</option>

                                                        @foreach($area as $areas)

                                                        <option value="{{$areas->location}}" {{($areas->location == $seller->area) ? 'selected' : ''}}>{{$areas->location}}</option>

                                                        @endforeach

                                                    </select>

                                                </div>

                                            </div>



                                            <div class="col-md-6">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Pin Code</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="sellerpincode" placeholder="Pin Code" name="pincode" value="{{ isset($seller->pincode) ? $seller->pincode : '' }}" readonly>

                                                </div>

                                            </div>



                                             <div class="col-md-6">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Seller Category</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="dataScaleY" placeholder="Seller Category">

                                                </div>

                                            </div>

                                            

                                            <div class="form-group">

                                            <span>Is the Seller an Businees Entity?</span>

                                            <div class="maxl">

                                                <label class="radio inline"> 

                                                    <input type="radio" name="entity"  value="yes"  onclick="showsellerBusinessName()" {{ $seller->entity == 'yes' ? 'checked' : '' }}>

                                                    <span> Yes </span> 

                                                </label>

                                                <label class="radio inline"> 

                                                    <input type="radio" name="entity" value="no" onclick="hidesellerBusinessName()" {{ $seller->entity == 'no' ? 'checked' : '' }}>

                                                    <span> No </span> 

                                                </label>

                                            </div>

                                            </div>





                                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">

                                                <h6 class="mb-0 fw-bold " id="sellerbusinessdetails">Seller Business Details</h6> 

                                            </div>


                                            
                                            <div class="col-md-6 sellerbusinessname" id="sellerbusinessname">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Business Name</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="dataScaleY" placeholder="Business Name" name="business_name" value="{{ isset($seller->business_name) ? $seller->business_name : '' }}">

                                                </div>

                                            </div>




                                            <div class="col-md-6 sellergst" id="sellergst">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">GSTIN</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="gstedit" placeholder="GSTIN" name="gst" value="{{ isset($seller->gst) ? $seller->gst : '' }}" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="updatePatternedit()" size="15" maxlength="15" minlength="15">

                                                </div>
                                            </div>



                                             <div class="col-md-6 sellerarea" id="sellerbusinessareadiv">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Area</span>

                                                    </div>

                                                    <!-- <input type="text" class="form-control" id="dataScaleY" placeholder="Area" name="business_area" value="{{ isset($seller->business_area) ? $seller->business_area : '' }}"> -->



                                                    <select name="business_area" class="form-control full-width-select"  id="sellerbuyerarea">

                                                        <option value="" selected disabled>Select Area</option>

                                                        @foreach($area as $areas)

                                                        <option value="{{$areas->location}}" {{($areas->location == $seller->business_area) ? 'selected' : ''}}>{{$areas->location}}</option>

                                                        @endforeach

                                                    </select>

                                                </div>

                                            </div>



                                            <div class="col-md-6 sellerpincode" id="sellerbusinesspincodediv">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Pincode</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="sellerbusinesspincode" placeholder="Pincode" name="business_pincode" value="{{ isset($seller->business_pincode) ? $seller->business_pincode : '' }}">

                                                </div>

                                            </div>

                                        </div>

                                        

                                        <button type="submit" class="btn btn-primary mt-4">Submit</button>

                                    </form>

                                </div>

                                    </div>

                                </div>



        <!-- newtab -->

        <div class="tab-pane fade" id="descriptions">
            <div class="card-body"> 
                <h6 class="mb-0 fw-bold mb-4">Products</h6>
                    <div class="row g-3 mb-5">
                        <form method="post" action="{{route('sellerkeywordadd')}}">
                            @csrf

                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Products</span>
                                    </div>
                                    <select class="form-control" required name="keyword">
                                        <option value="">Search Products</option>
                                            @foreach($keyword as $keywords)
                                            <option value="{{$keywords->id}}">{{$keywords->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4">Add Product</button>
                            <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Request Product</button>
                        </form>
                    </div>

                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title" id="exampleModalCenterTitle">Add Products</h5>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                        </div>

                                            <div class="modal-body">

                                                <div class="deadline-form">

                                                        <form method="post" action="{{route('store.sellerkeyword')}}">

                                                            @csrf

                                                            <div class="row g-3 mb-3">

                                                                <div class="col-sm-12">

                                                                    <label for="item" class="form-label">Enter Product Name</label>

                                                                    <input type="text" class="form-control" id="item" placeholder="Enter Product Name" name="name" required>

                                                                </div>

                                                            </div>

                                                            

                                                    </div>

                                            </div>

                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary">Send</button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">  

                                        <thead>

                                            <tr>

                                                <th>Sr No.</th>

                                                <th>Product</th>

                                                <th>Added Date</th>

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                            $i=1;

                                            ?>

                                            @if(isset($sellerkeyword))

                                            @foreach($sellerkeyword as $sellerkeywords)

                                            <tr>

                                                <td>{{$i}}</td>

                                                 <?php

                                                    $i++;

                                                ?>

                                                <td>

                                                    @if($sellerkeywords->keyword !==null)

                                                    {{$sellerkeywords->keyword->name}}

                                                    @else

                                                    NA

                                                    @endif

                                                </td>

                                                <td>{{$sellerkeywords->created_at->format('d-m-Y')}}</td>

                                                <td> <div class="btn-group" role="group" aria-label="Basic outlined example">

                                                    <a href="{{route('sellerkeyworddelete',$sellerkeywords->id)}}" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></a>

                                                    </div> </td>

                                            </tr>

                                            @endforeach

                                            @endif

                                           

                                        </tbody>

                                    </table>

                                </div>

                            </div>



                            </div>

                        </div>



                </div>

            </div>

        </div>

    </div>

</div>

  </div>



@endsection

@section('javascript')



<script type="text/javascript">

function updatePatternedit() {
        var gstInput = document.getElementById('gstedit');
        var gstValue = gstInput.value.trim();

        // Check if GST value is present
        if (gstValue.length > 0) {
            gstInput.setAttribute('pattern', '[0-9]{15}');
            gstInput.setAttribute('title', 'GSTIN should be a 15-digit number');
        } else {
            // Remove pattern attribute if GST is not provided
            gstInput.removeAttribute('pattern');
            gstInput.removeAttribute('title');
        }
    }

 function validateEmail() {
        var emailInput = document.getElementById('email');
        var email = emailInput.value;

        // Check if the email ends with ".com" or ".in"
        if (email.endsWith('.com') || email.endsWith('.in')) {
            // Valid email, remove any previous error message
            emailInput.setCustomValidity('');
        } else {
            // Invalid email, set a custom error message
            emailInput.setCustomValidity('Email must end with .com or .in');
        }
    }
    
    $( document ).ready(function() {

            $('#sellerarea').change(function(){



            var area = $('#sellerarea :selected').val();



                $.ajax({

                        url: "{{route('findpincode')}}",

                        type: "POST",

                        data: {

                            area: area,

                            _token: '{{csrf_token()}}'

                        },

                        dataType: 'json',

                        success: function(result) {

                         var pincode = result.area;

                         $("#sellerpincode").val(pincode);

                        }

                    });

            });

        });



       $( document ).ready(function() {

            $('#sellerbuyerarea').change(function(){



            var area = $('#sellerbuyerarea :selected').val();



                $.ajax({

                        url: "{{route('findpincode')}}",

                        type: "POST",

                        data: {

                            area: area,

                            _token: '{{csrf_token()}}'

                        },

                        dataType: 'json',

                        success: function(result) {

                         var pincode = result.area;

                         $("#sellerbusinesspincode").val(pincode);

                        }

                    });

            });

        });

</script>



<script type="text/javascript">

    function showsellerBusinessName()

    {

        document.getElementById('sellerbusinessname').style.display = 'block';

        document.getElementById('sellerbusinessareadiv').style.display = 'block';

        document.getElementById('sellergst').style.display = 'block';

        document.getElementById('sellerbusinesspincodediv').style.display = 'block';

        document.getElementById('sellerbusinessdetails').style.display='block';

    }

    function hidesellerBusinessName()

    {

        document.getElementById('sellerbusinessname').style.display = 'none';

        document.getElementById('sellerbusinessareadiv').style.display = 'none';

        document.getElementById('sellergst').style.display = 'none';

        document.getElementById('sellerbusinesspincodediv').style.display = 'none';

        document.getElementById('sellerbusinessdetails').style.display = 'none';

    }

    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('input[name="entity"][value="yes"]').checked) {
            showsellerBusinessName();
        } else {
            hidesellerBusinessName();
        }

        // Attach event listeners to the radio buttons
        document.querySelector('input[name="entity"][value="yes"]').addEventListener('click', showsellerBusinessName);
        document.querySelector('input[name="entity"][value="no"]').addEventListener('click', hidesellerBusinessName);
    });
</script>

@endsection