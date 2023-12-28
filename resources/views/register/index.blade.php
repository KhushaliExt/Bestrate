<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bestrate -Signup</title>
    <link rel="icon" href="../favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    <link rel="stylesheet" href="{{asset('assets/css/ebazar.style.min.css')}}">
</head>
<body>
    <div id="ebazar-layout" class="theme-blue">

        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5">
            
            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">

                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                            <div style="max-width: 25rem;">
                                <div class="text-center mb-5">
                                    <i class="bi bi-bag-check-fill  text-primary" style="font-size: 90px;"></i>
                                </div>
                                <!-- Image block -->
                                <div class="">
                                    <img src="../assets/images/login-img.svg" alt="login-img">
                                </div>
                            </div>
                        </div>

                                                <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg">
                            <div class="w-100 p-3 p-md-5 card border-0 shadow-sm">
                                <!-- Form -->
                                <div class="col-12 text-center mb-5">
                                    <h1>Create your account</h1>
                                </div>

                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item text-center">
                                        <a class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Buyer</a>
                                    </li>
                                    <li class="nav-item text-center">
                                        <a class="nav-link btr" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Seller</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <h5 style="text-align:center;">Sign Up as Buyer</h5>
                                    <form method="post" action="{{route('buyerregisted')}}">
                                        @csrf
                                    <div class="row">

                                        <div class="col-sm-6">   
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ old('first_name') }}">
                                        </div> 
                                        </div>

                                        <div class="col-sm-6">   
                                        <div class="form-group">
                                          <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                                        </div> 
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        
                                        <div class="col-sm-6">   
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Your Phone"  name="mobile_number" size="10" maxlength="10" minlength="10" required onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ old('mobile_number') }}">
                                                 @error('email')
                                                    <p style="color:red">{{ $message }}</p>
                                            @enderror
                                        </div> 
                                        </div>

                                        <div class="col-sm-6">   
                                        <div class="form-group">
                                          <input type="email" class="form-control" placeholder="Your Email" name="email" required value="{{ old('email') }}">
                                              @error('email')
                                                    <p style="color:red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                     
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        
                                        <div class="col-sm-6">   
                                        <div class="form-group">
                                           <select name="area" class="form-control full-width-select" required id="buyerarea">
                                                <option value="" selected disabled>Select Area</option>
                                                @foreach($area as $areas)
                                                <option value="{{$areas->location}}">{{$areas->location}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        </div>

                                        <div class="col-sm-6">   
                                        <div class="form-group">
                                           <input type="text" class="form-control" placeholder="Pincode" value="{{ old('pincode') }}"  name="pincode" readonly id="buyerpincode">
                                        </div> 
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <label class="mb-1">Is the Buyer an Businees Entity?</label>
                                        <div class="col-sm-12"> 

                                        <div class="form-group">
                                           <div class="maxl">
                                                <label class="radio inline"> 
                                                <input type="radio" name="entity"  value="yes" checked onclick="showBusinessName()">
                                                    <span> Yes </span> 
                                                </label>
                                                &nbsp;&nbsp;
                                                <label class="radio inline"> 
                                                    <input type="radio" name="entity" value="no" onclick="hideBusinessName()">
                                                    <span> No </span> 
                                                </label>
                                            </div>
                                        </div> 

                                        </div>

                                    </div>

                                    <div class="row mt-3">

                                        <div class="col-sm-6">   
                                        <div class="form-group" id="businessname">
                                            <input type="text" class="form-control" placeholder="Business Name" value=""  name="business_name">
                                        </div> 
                                        </div>

                                        <div class="col-sm-6">   
                                        <div class="form-group" id="businessgst">
                                            <input type="text" class="form-control" placeholder="GSTIN" name="gst" size="15" maxlength="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center mt-4">

                                        <button type="submit" class="btn btn-primary">Submit</button>

                                    </div>
                                    </form>
                                    <div class="col-sm-12 mt-3 text-center">
                                        Already have an account?<a href="{{route('login')}}">Sign in here</a>

                                    </div>
                                    </div>

                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <h5 class="mb-2" style="text-align:center;">Sign Up as Seller</h5>
                                       <form method="post" action="{{route('sellerregisted')}}">
                                            @csrf

                                    <div class="row">

                                        <div class="col-sm-6">   
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="First Name" name="first_name" >
                                        </div> 
                                        </div>

                                        <div class="col-sm-6">   
                                        <div class="form-group">
                                          <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                                        </div> 
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-sm-6">   
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Your Phone"  name="mobile_number" size="10" maxlength="10" minlength="10" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </div> 
                                        </div>

                                        <div class="col-sm-6">   
                                        <div class="form-group">
                                          <input type="email" class="form-control" placeholder="Your Email" name="email" required>
                                        </div> 
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-sm-6">   
                                        <div class="form-group">

                                            <select name="business_area" class="form-control full-width-select"  >
                                                <option value="" selected disabled>Select Area</option>
                                                @foreach($area as $areas)
                                                <option value="{{$areas->location}}">{{$areas->location}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        </div>

                                        <div class="col-sm-6">   
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="PinCode" name="business_pincode" required  readonly>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <label class="mb-1">Is the Seller an Businees Entity?</label>
                                        <div class="col-sm-12"> 

                                        <div class="form-group">
                                            <div class="maxl">

                                                <label class="radio inline"> 

                                                    <input type="radio" name="entity"  value="yes" checked onclick="showsellerBusinessName()">

                                                    <span> Yes </span> 

                                                </label>

                                                <label class="radio inline"> 

                                                    <input type="radio" name="entity" value="no" onclick="hidesellerBusinessName()">

                                                    <span> No </span> 

                                                </label>

                                            </div>
                                        </div> 

                                        </div>

                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-sm-6">   
                                          <div class="form-group" id="sellerbusinessname">

                                            <input type="text" class="form-control" placeholder="Business Name" value=""  name="business_name">

                                        </div>
                                        </div>

                                        <div class="col-sm-6">   
                                        <div class="form-group" id="sellergst">

                                            <input type="text" class="form-control" placeholder="GSTIN" name="gst" size="15" maxlength="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

                                        </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-sm-6">   
                                          <div class="form-group" id="sellerbusinessarea">

                                            <select name="business_area" class="form-control full-width-select"  id="sellerbuyerarea">

                                                <option value="" selected disabled>Select Area</option>

                                                @foreach($area as $areas)

                                                <option value="{{$areas->location}}">{{$areas->location}}</option>

                                                @endforeach

                                            </select>

                                        </div>
                                        </div>

                                        <div class="col-sm-6">   
                                        <div class="form-group" id="sellerbusinesspincode">

                                            <input type="text" class="form-control" placeholder="PinCode" name="business_pincode" required readonly>

                                        </div>
                                        </div>
                                    </div>
                                                                            <div class="col-12 text-center mt-4">

                                        <button type="button" class="btn btn-primary " id="save_ajax_data">Submit</button>

                                    </div>
                                    </form>
                                    <div class="col-sm-12 mt-3 text-center">
                                        Already have an account?<a href="{{route('login')}}">Sign in here</a>

                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Row -->
                    
                </div>
            </div>

        </div>

    </div>
       <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your other scripts -->
    <script src="../assets/bundles/libscripts.bundle.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">

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

    <script>



    function showBusinessName() {

        document.getElementById('businessname').style.display = 'block';

        document.getElementById('businessgst').style.display = 'block';

    }



    function hideBusinessName() {

        document.getElementById('businessname').style.display = 'none';

        document.getElementById('businessgst').style.display = 'none';

    }

    function showsellerBusinessName(){

        document.getElementById('sellerbusinessname').style.display = 'block';

        document.getElementById('sellerbusinessarea').style.display = 'block';

        document.getElementById('sellergst').style.display = 'block';

        document.getElementById('sellerbusinesspincode').style.display = 'block';

    }

    function hidesellerBusinessName()

    {

        document.getElementById('sellerbusinessname').style.display = 'none';

        document.getElementById('sellerbusinessarea').style.display = 'none';

        document.getElementById('sellergst').style.display = 'none';

        document.getElementById('sellerbusinesspincode').style.display = 'none';

    }

</script>

