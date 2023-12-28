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

                                    <h6 class="mb-0 fw-bold ">Buyer Information Details</h6> 

                                </div>

                                <div class="card-body">

                                    <form method="post" action="{{route('updatebuyerprofile')}}">

                                        @csrf

                                        <div class="row g-3 mb-3">

                                            <div class="col-md-6">

                                                <input type="hidden" name="id" value="{{$user->id}}">

                                                <input type="hidden" name="buyerid" value="{{$buyer->id}}">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">First Name</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="dataScaleY" placeholder="First Name" name="first_name" value="{{ isset($buyer->first_name) && !empty($buyer->first_name) ? $buyer->first_name : '' }}" required>



                                                </div>

                                            </div>



                                            <div class="col-md-6">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Last Name</span>

                                                    </div>

                                                   <input type="text" class="form-control" id="dataScaleY" placeholder="Last Name" name="last_name" value="{{ isset($buyer->last_name) && !empty($buyer->last_name) ? $buyer->last_name : '' }}" required>

                                                </div>

                                            </div>



                                            <div class="col-md-6">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Mobile Number</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="dataScaleY" placeholder="Mobile Number" name="mobile_number" value="{{ isset($buyer->mobile_number) && !empty($buyer->last_name) ? $buyer->mobile_number : '' }}" required size="10" maxlength="10" minlength="10" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

                                                </div>

                                            </div>


                                            <div class="col-md-6">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Email Address</span>

                                                    </div>

                                                    <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" value="{{ isset($buyer->email) && !empty($buyer->email) ? $buyer->email : '' }}" required oninput="validateEmail()">

                                                </div>

                                            </div>

                                             <div class="col-md-6">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Area</span>

                                                    </div>

                                                    <!-- <input type="text" class="form-control" id="dataScaleY" placeholder="Area" name="area" value="{{ isset($buyer->area) && !empty($buyer->area) ? $buyer->area : '' }}" > -->



                                                    <select name="area" class="form-control full-width-select" required id="buyerarea">

                                                    <option value="" selected disabled>Select Area</option>

                                                    @foreach($area as $areas)

                                                    <option value="{{$areas->location}}" {{($areas->location == $buyer->area) ? 'selected' : ''}}>{{$areas->location}}</option>

                                                    @endforeach

                                                    </select>

                                                </div>

                                            </div>



                                            <div class="col-md-6">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Pin Code</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="buyerpincode" placeholder="PinCode" name="pincode" value="{{ isset($buyer->pincode) && !empty($buyer->pincode) ? $buyer->pincode : '' }}" >

                                                </div>

                                            </div>



                                            <div class="col-md-6">

                                                <label  class="form-label">Is the Buyer an Business Entity?</label>

                                                <div class="row">

                                                    <div class="col-md-3">

                                                        <div class="form-check">

                                                            <input class="form-check-input" type="radio" name="entity" id="exampleRadios11" onclick="showsellerBusinessName()" value="yes"  {{ $buyer->entity == 'yes' ? 'checked' : '' }} >

                                                            <label class="form-check-label" for="exampleRadios11">

                                                            Yes

                                                            </label>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-3">

                                                        <div class="form-check">

                                                            <input class="form-check-input" type="radio" name="entity" id="exampleRadios22" onclick="hidesellerBusinessName()" value="no" {{ $buyer->entity == 'no' ? 'checked' : '' }} >

                                                            <label class="form-check-label" for="exampleRadios22">

                                                            No

                                                            </label>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>



                                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">

                                                <h6 class="mb-0 fw-bold ">Business Details</h6> 

                                            </div>


                                            <div class="col-md-6" id="businessnamediv">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">Business Name</span>

                                                    </div>

                                                    <input type="text" class="form-control" id="dataScaleY" placeholder="Business Name" name="business_name" value="{{ isset($buyer->business_name) && !empty($buyer->business_name) ? $buyer->business_name : '' }}">

                                                </div>

                                            </div>



                                            <div class="col-md-6" id="businessgstdiv">

                                                <div class="input-group">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">GSTIN</span>

                                                    </div>

                                                    <input type="text" class="form-control" name="gst" id="gst" placeholder="GSTIN" value="{{ isset($buyer->gst) && !empty($buyer->gst) ? $buyer->gst : '' }}" size="15" maxlength="15" oninput="updatePattern()" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

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



@section('javascript')

<script type="text/javascript">

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

</script>

<script type="text/javascript">

    function showsellerBusinessName()

    {

        document.getElementById('businessnamediv').style.display = 'block';

        document.getElementById('businessgstdiv').style.display = 'block';

    }

    function hidesellerBusinessName()

    {

        document.getElementById('businessnamediv').style.display = 'none';

        document.getElementById('businessgstdiv').style.display = 'none';

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