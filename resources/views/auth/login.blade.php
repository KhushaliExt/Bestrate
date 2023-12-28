<!doctype html>

<html class="no-js" lang="en" dir="ltr">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Best Rate - Signin </title>

    <link rel="icon" href="../favicon.ico" type="image/x-icon"> <!-- Favicon-->



    <!-- project css file  -->

    <link rel="stylesheet" href="{{asset('assets/css/ebazar.style.min.css')}}">

</head>

<body>

    <div id="ebazar-layout" class="theme-blue">



        <!-- main body area -->

        <div class="main p-2 py-3 p-xl-5 ">

            

            <!-- Body: Body -->

            <div class="body d-flex p-0 p-xl-5">

                <div class="container-xxl">



                    <div class="row g-0">

                        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">

                            <div style="max-width: 25rem;">

                                <div class="text-center mb-5">

                                    <i class="bi bi-bag-check-fill  text-primary" style="font-size: 90px;"></i>

                                </div>

                                <div class="mb-5">

                                    <h2 class="color-900 text-center">Best Rate </h2>

                                </div>

                                <!-- Image block -->

                                <div class="">

                                    <img src="{{asset('assets/images/login-img.svg')}}" alt="login-img">

                                </div>

                            </div>

                        </div>



                        <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">

                            <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;">

                                <!-- Form -->

                                <form class="row g-1 p-3 p-md-4" method="POST" id="mobile_form">

                                    @csrf



                                    <div class="col-12 text-center mb-5">

                                        <h1>Sign in</h1>

                                        <!-- <span>Free access to our dashboard.</span> -->

                                    </div>



                                    <div class="col-12">

                                        <div class="mb-2">

                                            <label class="form-label">Mobile Number</label>



                                            <input id="mobile" type="text" class="form-control form-control-lg mobile" placeholder="Enter Moblie Number" name="mobile"   required size="10" maxlength="10" minlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

                                            <span id="mobileerror" style="color: red;font-weight:bold;"></span>



                                        </div>

                                    </div>



                                    <div class="col-12 text-center mt-4">

                                        <button type="button" class="btn btn-primary " id="save_ajax_data">Request OTP</button>

                                    </div>

                                </form>

                                <!-- End Form -->



                                <form class="row g-1 p-3 p-md-4" method="POST" id="otp_form">

                                    @csrf



                                    <div class="col-12 text-center mb-5">

                                        <h1>Sign in</h1>

                                        <!-- <span>Free access to our dashboard.</span> -->

                                    </div>



                                    <div class="col-12">

                                        <div class="mb-2">

                                            <label class="form-label">Enter OTP</label>

                                            <input type="hidden" name=""id="mobileinput">

                                            <input id="otp" type="text" class="form-control form-control-lg otp" required placeholder="Enter OTP" name="otp">

                                            <span id="otperror" style="color: red;font-weight:bold;"></span>

                                        </div>

                                    </div>



                                    <div class="col-12 text-center mt-4">

                                        <button type="button" class="btn btn-primary " id="verify_otp">Submit</button>

                                    </div>

                                </form>



                                    <div class="col-sm-12 text-center">

                                        Don't have any account? <a href="{{route('customregister')}}">Register Now</a>

                                    </div>

                                

                            </div>

                        </div>

                    </div> <!-- End Row -->

                    

                </div>

            </div>



        </div>



    </div>



    <!-- Jquery Core Js -->

<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>

<script type="text/javascript">



    $(document).ready(function(){

        $("#otp_form").hide();



        //insert

              $(document).on('click','#save_ajax_data',function() //id(button)
              {
                var mobile=$('.mobile').val();

                var mobileErrorSpan = $('#mobileerror');

                if (mobile.trim() === "") {

                    mobileErrorSpan.text("Mobile number cannot be blank.");

                } else {

                    mobileErrorSpan.text("");

                    $.ajax(
                    {
                        url:"{{route('customlogin')}}",
                        type: "POST",
                        data: {
                                mobile: mobile,
                                _token: '{{csrf_token()}}'
                        },

                      success: function(data)

                      {

                        if (data.status == 1) 

                        {

                             $("#mobileinput").val(data.mobile);

                            $("#mobile_form").hide();

                            $("#otp_form").show();

                        }
                        if(data.status == 2)
                        {
                           mobileErrorSpan.text("User is not able to login.");
                        }
                        if(data.status == 0)
                        {
                           mobileErrorSpan.text("Mobile Number not exist.");
                        }
                        else

                        {

                            mobileErrorSpan.text("Enter Valid Mobile Number.");

                        }

                      }

                    })

                }

              });

        //end insert


        //otp verify

              $(document).on('click','#verify_otp',function() //id(button)

              {

                var otp=$('.otp').val();

                var mobile=$('#mobileinput').val();



                var otpErrorSpan = $('#otperror');

                if (otp.trim() === "") {

                    otpErrorSpan.text("OTP cannot be blank.");

                } else {

                    otpErrorSpan.text("");

                    $.ajax(

                    {

                        url:"{{route('otpverify')}}",

                        type: "POST",

                        data: {

                            mobile: mobile, otp:otp,

                            _token: '{{csrf_token()}}'

                        },

                      success: function(data)

                      {

                        if (data.status == 1) 

                        {

                            window.location.href = "{{ route('admin.index') }}";

                        }

                        else if(data.status == 0)

                        {

                            otpErrorSpan.text("Enter OTP.");

                        }

                        else

                        {

                             otpErrorSpan.text("Verify Your Account");

                        }

                      }

                    })

                }

              });

        //end otp verify

    });

    

</script>