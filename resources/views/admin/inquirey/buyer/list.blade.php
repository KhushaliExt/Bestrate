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

                                <h3 class="fw-bold mb-0">Manage Buyers</h3>

                               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="icofont-plus-circle me-2 fs-6"></i> Create Buyer</button>

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

                                                <th>Buyer Name</th>

                                                <th>Contact Number</th>

                                                <th>No of Inquiries</th>

                                                <th>Joining Date</th>

                                                <th>Status</th>

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                                $i=1;

                                            ?>

                                            @foreach($buyer as $buyers)

                                            <tr>

                                                <td>{{$i}}</td>

                                                <td>{{$buyers->first_name}} {{$buyers->last_name}}</td>

                                                <td>{{$buyers->mobile_number}}</td>

                                                    @php
                                                        $buyerQueries = $sellerquery->where('buyer_id', $buyers->id);
                                                        $queryCount = $buyerQueries->count();
                                                    @endphp
                                                 <td>{{ $queryCount }}</td>

                                                <td>{{$buyers->created_at->format('d/m/Y')}}</td>

                                                <td>

                                                  @if($buyers->status ==1)

                                                <span class="badge bg-success">Active</span>

                                                @else

                                                <span class="badge bg-danger">InActive</span>

                                                @endif   

                                                </td>

                                                <td> <div class="btn-group" role="group" aria-label="Basic outlined example">

                                                       <a href="javascript:void(0);" 

                                                           data-id="{{$buyers->id}}" data-fname="{{$buyers->first_name}}" data-lname="{{$buyers->last_name}}" data-mobile="{{$buyers->mobile_number}}" data-email="{{$buyers->email}}" data-businessname="{{$buyers->business_name}}" data-gst="{{$buyers->gst}}" data-pincode="{{$buyers->pincode}}" data-area="{{$buyers->area}}" data-entity="{{$buyers->entity}}" class="btn btn-outline-secondary editbuyer">

                                                            <i class="icofont-edit text-success"></i>

                                                        </a>

                                                        <a href="{{route('admin.buyerdelete',$buyers->id)}}" class="btn btn-outline-secondary deleterow" onclick="return confirm('Are you sure Delete this Recored ?')"><i class="icofont-ui-delete text-danger"></i></a>

                                                    </div>

                                                   <div class="btn-group">

                                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">status</button>

                                                        <ul class="dropdown-menu border-0 shadow bg-primary">

                                                            @if($buyers->status ==0)

                                                            <li><a class="dropdown-item text-light" href="{{ route('admin.buyerstatus', ['id' => $buyers->id, 'status' => '1']) }}">Active</a></li>

                                                            @else

                                                            <li><a class="dropdown-item text-light" href="{{ route('admin.buyerstatus', ['id' => $buyers->id, 'status' => '0']) }}">InActive</a></li>

                                                            @endif

                                                        </ul>

                                                    </div>

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

            </div>



<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Buyer</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="deadline-form">

                            <form method="post" action="{{route('admin.storebuyer')}}">

                                @csrf

                                <h5><b>Buyer Information Details</b></h5>

                                <div class="row g-3 mb-3">

                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">First Name</span>

                                            </div>

                                            <input type="text" class="form-control" id="dataScaleY" placeholder="First Name" name="first_name" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'  required>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Last Name</span>

                                            </div>

                                            <input type="text" class="form-control" id="dataScaleY" placeholder="Last Name" name="last_name" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'>

                                        </div>

                                    </div>



                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Mobile Number</span>

                                            </div>

                                            <input type="text" class="form-control" id="dataScaleY" placeholder="Mobile Number" name="mobile_number" required size="10" maxlength="10" minlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

                                        </div>

                                    <label><span><small style="color:red">Mobile Number is used for Login</small></span></label>

                                    </div>

                                    

                                    

                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Email Address</span>

                                            </div>

                                            <input type="text" class="form-control" id="email" placeholder="Email Address" name="email" oninput="validateEmail()" required>



                                        </div>
                                    </div>



                                    



                                    <div class="col-md-6">

                                                <label  class="form-label">Is the Buyer on Business Entity?</label>

                                                <div class="row">

                                                    <div class="col-md-3">

                                                        <div class="form-check">

                                                            <input class="form-check-input" type="radio" name="entity" id="exampleRadios11" value="yes"  onclick="showBusinessName()" checked>

                                                            <label class="form-check-label" for="exampleRadios11">

                                                            Yes

                                                            </label>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-3">

                                                        <div class="form-check">

                                                            <input class="form-check-input" type="radio" name="entity" id="exampleRadios22" value="no" onclick="hideBusinessName()">

                                                            <label class="form-check-label" for="exampleRadios22">

                                                            No

                                                            </label>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>



                                </div>



                                <h5 id="businessdetails"><b>Business Details</b></h5>

                                <div class="row g-3 mb-3">

                                    <div class="col-md-6" id="businessname">

                                        <div class="input-group" >

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Business Name</span>

                                            </div>

                                            <input type="text" class="form-control"  placeholder="Business Name" name="business_name">

                                        </div>

                                    </div>



                                   <div class="col-md-6" id="businessgst">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">GSTIN</span>

                                            </div>
                                            <input type="text" class="form-control" id="gst" placeholder="GSTIN" name="gst" size="15" maxlength="15" oninput="updatePattern()">
                                        </div>

                                    </div>



                                    <h5><b>Address and Geo-location Details</b></h5>

                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Area</span>

                                            </div>

                                            <!-- <input type="text" class="form-control" id="dataScaleY" placeholder="Area" name="area"> -->

                                            <select name="area" class="form-control full-width-select" required id="buyerarea">

                                                <option value="" selected disabled>Select Area</option>

                                                @foreach($area as $areas)

                                                <option value="{{$areas->location}}">{{$areas->location}}</option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    

                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">PinCode</span>

                                            </div>

                                            <input type="text" class="form-control" id="buyerpincode" placeholder="PinCode" name="pincode">

                                        </div>

                                    </div>





                                    <div class="col-md-12">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Search Geo Location</span>

                                            </div>

                                            <input type="text" class="form-control" id="dataScaleY" placeholder="Search Geo Location">

                                        </div>

                                    </div>



                                     <div class="col-md-12">

                                    <div id="map-container">

                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18906.129712753736!2d6.722624160288201!3d60.12672284414915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x463e997b1b6fc09d%3A0x6ee05405ec78a692!2sJ%C4%99zyk%20trola!5e0!3m2!1spl!2spl!4v1672239918130!5m2!1spl!2spl" width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                                    </div>

                                </div>

                                </div>

                                

                        </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    <button type="submit" class="btn btn-primary">Save</button>

                </div>



                                

                            </form>

            </div>

        </div>

    </div>





<div class="modal fade editbuyermodal" id="editbuyermodal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Buyer</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="deadline-form">

                            <form method="post" action="{{route('admin.updatebuyer')}}">

                                @csrf

                                <h6><b>Buyer Information Details</b></h6>

                                <div class="row g-3 mb-3">

                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">First Name</span>

                                            </div>

                                            <input type="hidden" name="id" id="editid">

                                            <input type="text" class="form-control" id="editfname" placeholder="First Name" name="first_name">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Last Name</span>

                                            </div>

                                            <input type="text" class="form-control" id="editlname" placeholder="Last Name" name="last_name">

                                        </div>

                                    </div>



                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Mobile Number</span>

                                            </div>

                                            <input type="text" class="form-control" id="editmobile" placeholder="Mobile Number" name="mobile_number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' size="10" maxlength="10">

                                        </div>
                                        <label><span><small style="color:red">Mobile Number is used for Login</small></span></label>
                                    </div>



                                   

                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Email Address</span>

                                            </div>

                                            <input type="text" class="form-control" id="editbuyeremail" placeholder="Email Address" name="email" oninput="validateEmail()" readonly>

                                        </div>

                                    </div>



                                    <div class="col-md-6">

                                                <label  class="form-label">Is the Buyer on Business Entity?</label>

                                                <div class="row">

                                                    <div class="col-md-3">

                                                        <div class="form-check">

                                                            <input class="form-check-input" type="radio" name="entity" id="radioyes" value="yes" checked onclick="showBusinessNameedit()">

                                                            <label class="form-check-label" for="exampleRadios11">
                                                            Yes
                                                            </label>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-3">

                                                        <div class="form-check">

                                                            <input class="form-check-input" type="radio" name="entity" id="radiono" value="no" onclick="hideBusinessNameedit()">

                                                            <label class="form-check-label" for="exampleRadios22">

                                                            No

                                                            </label>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>



                                </div>



                                <h6><b>Business Details</b></h6>

                                <div class="row g-3 mb-3">

                                    <div class="col-md-6" id="businessnameedit">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Business Name</span>

                                            </div>

                                            <input type="text" class="form-control" id="editbusinessname" placeholder="Business Name" name="business_name">

                                        </div>

                                    </div>



                                   <div class="col-md-6" id="businessgstedit">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">GSTIN</span>

                                            </div>

                                            <input type="text" class="form-control" id="gstedit" placeholder="GSTIN" name="gst" size="15" maxlength="15" oninput="updatePatternedit()">
                                        </div>

                                    </div>



                                    <h6><b>Address and Geo-location Details</b></h6>

                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Area</span>

                                            </div>

                                            <!-- <input type="text" class="form-control" id="editarea" placeholder="Area" name="area"> -->

                                            <select name="area" class="form-control full-width-select" required id="buyerareaedit">

                                                <option value="" selected disabled>Select Area</option>

                                                @foreach($area as $areas)

                                                <option value="{{$areas->location}}">{{$areas->location}}</option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    

                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">PinCode</span>

                                            </div>

                                            <input type="text" class="form-control" id="editpincode" placeholder="PinCode" name="pincode">

                                        </div>

                                    </div>





                                    <div class="col-md-12">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Search Geo Location</span>

                                            </div>

                                            <input type="text" class="form-control" id="dataScaleY" placeholder="Search Geo Location">

                                        </div>

                                    </div>



                                     <div class="col-md-12">

                                    <div id="map-container">

                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18906.129712753736!2d6.722624160288201!3d60.12672284414915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x463e997b1b6fc09d%3A0x6ee05405ec78a692!2sJ%C4%99zyk%20trola!5e0!3m2!1spl!2spl!4v1672239918130!5m2!1spl!2spl" width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                                    </div>

                                </div>

                                </div>

                                

                        </div>

                </div>

                <div class="modal-footer">



                    <button type="submit" class="btn btn-primary">Save</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                </div>



                                

                            </form>

            </div>

        </div>

    </div>



@endsection

@section('javascript')

<script>
    function updatePattern() {
        var gstInput = document.getElementById('gst');
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

        function updatePatternedit() {
        var gstInput = document.getElementById('editgst');
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
</script>

<script type="text/javascript">



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



    function showBusinessName() {

        document.getElementById('businessname').style.display = 'block';

        document.getElementById('businessgst').style.display = 'block';

        document.getElementById('businessdetails').style.display = 'block';

    }


    function hideBusinessName() {

        document.getElementById('businessname').style.display = 'none';

        document.getElementById('businessgst').style.display = 'none';

        document.getElementById('businessdetails').style.display = 'none';

    }

    function showBusinessNameedit(){
        document.getElementById('businessnameedit').style.display = 'block';

        document.getElementById('businessgstedit').style.display = 'block';
    }

    function hideBusinessNameedit()
    {
        document.getElementById('businessnameedit').style.display = 'none';

        document.getElementById('businessgstedit').style.display = 'none';
    }  

    $(document).ready(function(){

    $(document).on('click','.editbuyer' , function(){

            var id = $(this).data('id');

            var fname = $(this).data('fname');

            var lname = $(this).data('lname');

            var mobile = $(this).data('mobile');

            var email = $(this).data('email');

            var businessname =$(this).data('businessname');

            var area =$(this).data('area');

            var gst =$(this).data('gst');

            var pincode =$(this).data('pincode');
            var entity = $(this).data('entity');

            if (entity === 'yes') {
                $('#radioyes').prop('checked', true);
                $('#radiono').prop('checked', false);
                     document.getElementById('businessnameedit').style.display = 'block';
                    document.getElementById('businessgstedit').style.display = 'block';
                } else if (entity === 'no') {
                    $('#radioyes').prop('checked', false);
                    $('#radiono').prop('checked', true);

                            document.getElementById('businessnameedit').style.display = 'none';
                            document.getElementById('businessgstedit').style.display = 'none';
                }

            $('#editid').val(id);

            $('#editfname').val(fname);

            $('#editlname').val(lname);

            $('#editmobile').val(mobile);

            $('#editbuyeremail').val(email);

            $('#editbusinessname').val(businessname);

            $('#buyerareaedit').val(area);

            $('#gstedit').val(gst);

            $('#editpincode').val(pincode);

            $('#editbuyermodal').modal('show'); // Updated modal ID to match your actual modal ID

        });

    });

</script>



<script type="text/javascript">

    $( document ).ready(function() {

            $('#buyerarea').change(function(){



            var area = $('#buyerarea :selected').val();

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

                         $("#buyerpincode").val(pincode);

                        }

                    });

            });

        });



    $( document ).ready(function() {

            $('#buyerareaedit').change(function(){



            var area = $('#buyerareaedit :selected').val();

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

                         $("#editpincode").val(pincode);

                        }

                    });

            });

        });

</script>

@endsection