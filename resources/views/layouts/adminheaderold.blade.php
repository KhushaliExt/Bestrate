<!doctype html>

<html class="no-js" lang="en" dir="ltr">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>BestRate</title>

    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->

    <link rel="stylesheet" href="{{asset('assets/plugin/datatables/responsive.dataTables.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugin/datatables/dataTables.bootstrap5.min.css')}}">

    <!-- project css file  -->

    <link rel="stylesheet" href="{{asset('assets/css/ebazar.style.min.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/plugin/prism/prism.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/multipleselect.css')}}">

</head>

<style type="text/css">

    .tawk-button

    {

        display: none !important;

    }
    .modal-backdrop {
        z-index: -1;
    }
</style>

<body>

    <div id="ebazar-layout" class="theme-blue">

        

        <!-- sidebar -->

        <div class="sidebar px-4 py-4 py-md-4 me-0">

            <div class="d-flex flex-column h-100">

                <a href="{{route('admin.index')}}" class="mb-0 brand-icon">

                    <span class="logo-icon">

                        <i class="bi bi-bag-check-fill fs-4"></i>

                    </span>

                    <span class="logo-text">Best Rate</span>

                </a>

                

                <!-- Menu: main ul -->

                <ul class="menu-list flex-grow-1 mt-3">

                    <li><a class="m-link {{ request()->is('/') ? 'active' : '' }}" href="{{route('admin.index')}}"><i class="icofont-home fs-5"></i> <span>Dashboard</span></a></li>



                    @if(Auth::user()->role == 1)

                    <li class="collapsed">

                        <a class="m-link {{ request()->is('admin/keyword_Request')  || request()->is('admin/keyword') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-product" href="#">

                            <i class="icofont-chart-flow fs-5"></i> <span>Manage Product</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>



                            <!-- Menu: Sub menu ul -->

                            <ul class="sub-menu collapse" id="menu-product">

                                @if(Auth::user()->role == 1)

                                <li><a class="ms-link {{ request()->is('admin/keyword_Request') ? 'active' : '' }}" href="{{route('admin.viewkeywordrequest')}}">View Request Received</a></li>

                                @endif

                                @if(Auth::user()->role == 1)

                                <li><a class="ms-link {{ request()->is('admin/keyword') ? 'active' : '' }}" href="{{route('admin.keyword')}}">Products</a></li>

                                @endif

                            </ul>

                    </li>

                    @endif

                    

                    @if(Auth::user()->role == 1)

                    <li><a class="m-link {{ request()->is('admin/seller') ? 'active' : '' }}" href="{{route('admin.seller')}}"><i class="icofont-users fs-5"></i> <span>Manage Sellers</span></a></li>

                    <li><a class="m-link {{ request()->is('admin/buyer') ? 'active' : '' }}" href="{{route('admin.buyer')}}"><i class="icofont-user fs-5"></i> <span>Manage Buyers</span></a></li>

                    <li><a class="m-link {{ request()->is('admin/inqury') ? 'active' : '' }}" href="{{route('admin.inquiry')}}"><i class="icofont-notepad fs-5"></i> <span>Inquiries</span></a></li>

                    



                    <li class="collapsed">

                    <a class="m-link {{ request()->is('admin/keywordrepoert')  || request()->is('admin/sellerrepoert') || request()->is('admin/buyerrepoert') || request()->is('admin/inquiryrepoert') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-repoerts" href="#">

                            <i class="icofont-law-document fs-5"></i> <span>Reports</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>

                            <ul class="sub-menu collapse" id="menu-repoerts">

                                <li><a class="ms-link {{ request()->is('admin/keywordrepoert') ? 'active' : '' }}" href="{{route('keywordrepoert')}}">Products</a></li>

                                <li><a class="ms-link {{ request()->is('admin/sellerrepoert') ? 'active' : '' }}" href="{{route('sellerrepoert')}}">Sellers</a></li>

                                <li><a class="ms-link {{ request()->is('admin/buyerrepoert') ? 'active' : '' }}" href="{{route('buyerrepoert')}}">Buyers</a></li>

                                <li><a class="ms-link {{ request()->is('admin/inquiryrepoert') ? 'active' : '' }}" href="{{route('inquieryrepoert')}}">Inquiry</a></li>

                            </ul>

                    </li>



                    <li><a class="m-link {{ request()->is('admin/userrole') ? 'active' : '' }}" href="{{route('userrole')}}"><i class="icofont-ui-user-group fs-5"></i> <span>User Role</span></a></li>

                    @endif



                    @if(Auth::user()->role == 2 || Auth::user()->role == 4)

                    <li class="collapsed">

                    <a class="m-link {{ request()->is('buyer/inquiry')  || request()->is('buyer/createinquiry') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-inquiries" href="#">

                            <i class="icofont-papers fs-5"></i> <span>My Inquiries</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>

                            <ul class="sub-menu collapse" id="menu-inquiries">

                                <li><a class="ms-link {{ request()->is('buyer/inquiry') ? 'active' : '' }}" href="{{route('viewbuyerinquiry')}}">Manage Inquiries</a></li>

                                <li><a class="ms-link {{ request()->is('buyer/createinquiry') ? 'active' : '' }}" href="{{route('createinquiry')}}">Create Inquiries</a></li>

                            </ul>

                    </li>

                     @endif



                     @if(Auth::user()->role == 2)

                    <li><a class="m-link {{ request()->is('buyer/buyerprofile') ? 'active' : '' }}" href="{{route('buyerprofile')}}"><i class="icofont-ui-user-group fs-5"></i> <span>My Profile</span></a></li>

                    @endif



                    @if(Auth::user()->role == 3 || Auth::user()->role == 4)



                    <li><a class="m-link {{ request()->is('seller/sellerbid') ? 'active' : '' }}" href="{{route('sellerbid')}}"><i class="icofont-notepad fs-5"></i> <span>My Bids</span></a></li>

                    

                    <li><a class="m-link {{ request()->is('seller/sellerprofile') ? 'active' : '' }}" href="{{route('sellerprofile')}}"><i class="icofont-ui-user-group fs-5"></i> <span>My Profile</span></a></li>

                    @endif

                </ul>

                <!-- Menu: menu collepce btn -->

                <button type="button" class="btn btn-link sidebar-mini-btn text-light">

                    <span class="ms-2"><i class="icofont-bubble-right"></i></span>

                </button>

            </div>

        </div>



        <!-- main body area -->

        <div class="main px-lg-4 px-md-4">



            <!-- Body: Header -->

            <div class="header">

                <nav class="navbar py-4">

                    <div class="container-xxl">



                        <!-- header rightbar icon -->

                        <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">

                           

                           

                            <div class="dropdown notifications">

                                <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">

                                    <i class="icofont-alarm fs-5"></i>

                                    <span class="pulse-ring"></span>

                                </a>

                                <div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-md-end p-0 m-0 mt-3">

                                    <div class="card border-0 w380">

                                        <div class="card-header border-0 p-3">

                                            <h5 class="mb-0 font-weight-light d-flex justify-content-between">

                                                <span>Notifications</span>

                                                <span class="badge text-white">0</span>

                                            </h5>

                                        </div>

                                        <div class="tab-content card-body">

                                            <div class="tab-pane fade show active">

                                                <ul class="list-unstyled list mb-0">

							

                                                    <lable>No Data Found</lable>

                                                </ul>

                                            </div>

                                        </div>

                                        <a class="card-footer text-center border-top-0" href="#"> View all notifications</a>

                                    </div>

                                </div>

                            </div>

                            <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">

                                <div class="u-info me-2">

                                    <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold">{{ Auth::user()->name }}</span></p>

                                </div>

                                <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">

                                    <img class="avatar lg rounded-circle img-thumbnail" src="{{asset('assets/images/profile_av.svg')}}" alt="profile">

                                </a>

                                <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">

                                    <div class="card border-0 w280">

                                        <div class="card-body pb-0">

                                            <div class="d-flex py-1">

                                                <img class="avatar rounded-circle" src="{{asset('assets/images/profile_av.svg')}}" alt="profile">

                                                <div class="flex-fill ms-3">

                                                    <p class="mb-0"><span class="font-weight-bold">{{ Auth::user()->name }}</span></p>

                                                    <small class="">{{ Auth::user()->email }}</small>

                                                </div>

                                            </div>

                                            

                                            <div><hr class="dropdown-divider border-dark"></div>

                                        </div>

                                        <div class="list-group m-2 ">

                                            @if(Auth::user()->role == 1)

                                            <a href="{{route('adminprofile')}}" class="list-group-item list-group-item-action border-0 "><i class="icofont-ui-user fs-5 me-3"></i>Profile Page</a>

                                            @endif

                                            @if(Auth::user()->role == 2)
                                            <a href="{{route('switchseller')}}" class="list-group-item list-group-item-action border-0 "><i class="icofont-ui-user fs-5 me-3"></i>Switch to Seller</a>
                                            @endif

                                            @if(Auth::user()->role == 3)
                                            <a href="{{route('switchbuyer')}}" class="list-group-item list-group-item-action border-0 "><i class="icofont-ui-user fs-5 me-3"></i>Switch to Buyer</a>
                                            @endif
                                            
                                            <a href="javascript:void" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-5 me-3"></i>Signout</a>



                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                                                 @csrf

                                    </form>

                                    </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            

                        </div>

                            

                        <!-- menu toggler -->

                        <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">

                            <span class="fa fa-bars"></span>

                        </button>

        

                        <!-- main menu Search-->

                        <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">

                          

                        </div>

        

                    </div>

                </nav>



            </div>





            <!-- Body: Body -->

        <div class="body d-flex py-3"> 

           

            @yield('content')

        </div>
        </div>

    

    </div>

 <div class="modal fade" id="modalforquery" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">

        <audio style="display:none;" id="source" src="{{ asset('/beep.mp3') }}" type="audio/mpeg" ></audio>
        <input type="hidden" id="source_check" value="0">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalCenterTitle">New Query</h5>

                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->

                </div>

                <div class="modal-body">

                    <div class="deadline-form">

                                <div class="row g-3 mb-3">

                                    <div class="col-sm-12" >

                                        <label style="float:right">Timer: <span id="modalinquirytime"></span></label>

                                    </div>



                                    <div class="col-sm-12">

                                        <label for="item" class="form-label"><b>Keyword:</b>  <span id="modalkeyword"></span></label>

                                    </div>

                                     <div class="col-sm-12">

                                        <label for="item" class="form-label"><b>Qty:</b>  <span id="modalquantity"></span></label>

                                    </div>

                                     <div class="col-sm-12">

                                        <label for="item" class="form-label"><b>Budget:</b> <span id="modalbudget"></span></label>

                                    </div>

                                </div>

                                

                        </div>

                </div>

                <div class="modal-footer">



                    <a href="javascript:void(0)" class="btn btn-success text-white btn-accept">Accept</a>

                    <a href="javascript:void(0)" class="btn btn-warning text-white btn-reject">Reject</a>

                </div>

            </div>

        </div>

    </div>

    <!-- Jquery Core Js -->

    <script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>



    <script src="{{ asset('assets/plugin/select2/select2.full.js') }}"></script>

    <script src="{{ asset('assets/plugin/prism/prism.js')}}"></script>

    <!-- Plugin Js -->

    <script src="{{asset('assets/bundles/apexcharts.bundle.js')}}"></script>

    <script src="{{asset('assets/bundles/dataTables.bundle.js')}}"></script>  



    <!-- Jquery Page Js -->

    <script src="{{asset('js/template.js')}}"></script>

    <script src="{{asset('js/page/index.js')}}"></script> 

    <script src="{{asset('js/multipleselect.js')}}"></script>

    <script>

        $('#myDataTable')

        .addClass( 'nowrap')

        .dataTable( {

            responsive: true,

            columnDefs: [

                { targets: [-1, -3], className: 'dt-body-right' }

            ]

        });

    </script>

    <script type="text/javascript">

$(document).ready(function(){

  

    $('.form-select' ).select2( {

        theme: "bootstrap-5",

        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '50%' : 'style',

        placeholder: $( this ).data( 'placeholder' ),

        closeOnSelect: false,   

    });

    

  

});

</script>

<script type="text/javascript">



    $(document).ready(function() {

    function fetchData() {

        $.ajax({

            url: "{{ route('loadquerymodel') }}",

            type: "POST",

            data: {

                _token: '{{ csrf_token() }}',

            },

            dataType: 'json',

            success: function(result) {

                result.sellerquery.forEach(function(dataItem) {

                    openModalWithData(dataItem);

                });

            }

        });

    }

    setInterval(fetchData, 1000);


    function openModalWithData(dataItem) {



            // Create a unique identifier for each modal instance, e.g., appending the record ID

            var modalId = 'modalforquery_' + dataItem.id;



            // Create a copy of the modal template

            var modalClone = $('#modalforquery').clone();



            // Set the ID for the cloned modal

            modalClone.attr('id', modalId);
            modalClone.attr('data-backdrop', 'static');



            // modalClone.find('#modalinquirytime').text(dataItem.inquiry_time);

            modalClone.find('#modalkeyword').text(dataItem.keyword.name);

            modalClone.find('#modalquantity').text(dataItem.inquery.quantity);

            modalClone.find('#modalbudget').text(dataItem.inquery.budget_start + ' - ' + dataItem.inquery.budget_end);



            modalClone.find('.btn-accept').attr('data-id', + dataItem.id);

            modalClone.find('.btn-reject').attr('data-id', + dataItem.id);

            $('#'+modalId).modal({
                backdrop: 'static',
                keyboard: false
            })

            // Update modal content based on dataItem

            modalClone.find('.form-label').text(dataItem.someField);



            var countdownTime = dataItem.timer; // seconds

            var countdownElement = modalClone.find('#modalinquirytime');



            function updateCountdown() {
                
                countdownElement.text(countdownTime);

                countdownTime--;



                if (countdownTime < 0) {

                    modalClone.modal('hide');
                    clearInterval(countdownInterval);

                }

                var check = $('#source_check').val();
                if(check == 0){
                     $('#source_check').val(1);
                    $('#source').get(0).load();
                    $('#source').get(0).play();
                }
                console.log("Audio is Playing");
            }

            

            updateCountdown();

            var countdownInterval = setInterval(updateCountdown, 1000); // Update every 1 second



            modalClone.appendTo('body');



            modalClone.modal('show');
            modalClone.modal({
                backdrop: 'static',
                keyboard: false
            });
            
            
            setTimeout(function() {

                modalClone.modal('hide');
                var id =  dataItem.id;

                 $.ajax({

                        url: "{{route('selfsellerqueryreject')}}",

                        type: "POST",

                        data: {

                            id: id,

                            _token: '{{csrf_token()}}'

                        },

                        dataType: 'json',

                        success: function(result) {

                        }

                    });
                    
            }, countdownTime);

        }

    });

</script>





<script type="text/javascript">

    $(document).ready(function(){



        $(document).on('click','.btn-accept' , function(){

            var id = $(this).data('id');

             $.ajax({

                        url: "{{route('sellerqueryaccept')}}",

                        type: "POST",

                        data: {

                            id: id,

                            _token: '{{csrf_token()}}'

                        },

                        dataType: 'json',

                        success: function(result) {

   

                        var modalId = '#modalforquery_' + result.id;
                        
                        $(modalId).modal('hide');
                      //  $('#source_check').val('1');
                        $('#source').get(0).pause();
                        }

                    });

        });

    });

</script>



<script type="text/javascript">

    $(document).ready(function(){



        $(document).on('click','.btn-reject' , function(){

            var id = $(this).data('id');

             $.ajax({

                        url: "{{route('sellerqueryreject')}}",

                        type: "POST",

                        data: {

                            id: id,

                            _token: '{{csrf_token()}}'

                        },

                        dataType: 'json',

                        success: function(result) {

                        var modalId = '#modalforquery_' + result.id;

                         $(modalId).modal('hide');
                         // $('#source_check').val('1');
                         $('#source').get(0).pause();
                        }

                    });

        });

    });

</script>

@yield('javascript')

