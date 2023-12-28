@extends('layouts.adminheader')

@section('content')

      <div class="body d-flex py-3">  

        

         <div class="row">

                <div class="col-sm-12">

                    @if (session('successmsg'))

                        <div class="toast d-flex align-items-center text-white bg-success border-0" role="alert" style="float:right;" id="myToast">

                            <div class="toast-body">

                                {{ session('successmsg') }}

                            </div>

                            <button type="button" class="btn-close btn-close-white ms-auto me-2" id="sucesscloseToast" aria-label="Close"></button>

                        </div>



                        @section('javascript')

                       <script>

                            $(document).ready(function () {

                                // Click handler for the close button

                                $("#sucesscloseToast").click(function () {

                                    // Immediately hide the toast

                                    $("#myToast").hide();

                                    // Optional: Remove the toast from the DOM

                                    $("#myToast").remove();

                                });



                                // Initial fadeOut after 5 seconds

                                setTimeout(function () {

                                    $("#myToast").fadeOut(200, function () {

                                        // Optional: Remove the toast from the DOM

                                        $(this).remove();

                                    });

                                }, 5000);

                            });

                        </script>



                        @endsection

                    @endif



                    @if (session('warningsmsg'))

                        <div class="toast d-flex align-items-center text-white bg-danger border-0" role="alert" style="float:right;" id="myToastwarning">

                            <div class="toast-body">

                                {{ session('warningsmsg') }}

                            </div>

                            <button type="button" class="btn-close btn-close-white ms-auto me-2" id="warningcloseToast" aria-label="Close"></button>

                        </div>



                        @section('javascript')

                        <script>

                            $(document).ready(function () {

                                // Click handler for the close button

                                $("#warningcloseToast").click(function () {

                                    // Immediately hide the toast

                                    $("#myToastwarning").hide();

                                    // Optional: Remove the toast from the DOM

                                    $("#myToastwarning").remove();

                                });



                                // Initial fadeOut after 5 seconds

                                setTimeout(function () {

                                    $("#myToastwarning").fadeOut(200, function () {

                                        // Optional: Remove the toast from the DOM

                                        $(this).remove();

                                    });

                                }, 5000);

                            });

                        </script>

                        @endsection

                    @endif



                </div>

                </div>  



                <div class="container-xxl"> 

                    <div class="row align-items-center"> 

                        <div class="border-0 mb-4"> 

                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">

                                <h3 class="fw-bold mb-0">Manage Inquiries</h3>

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

                                                <th>Products</th>

                                                <th>Qty</th>

                                                <th>Budget</th>

                                                <th>Request Date</th>

                                                <th>Response Received</th>

                                                <th>Status</th>

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            

                                                <?php

                                                    $i=1;

                                                ?>

                                                @foreach($inquery as $inquerys)

                                                <tr>

                                            	<td>{{$i}}</td>

                                                 <?php 

                                                  $i++;

                                                ?>

                                            	<td>{{$inquerys->keyword->name}}</td>

                                            	<td>{{$inquerys->quantity}}</td>

                                                <td>{{$inquerys->budget_start}} - {{$inquerys->budget_end}}</td>

                                                <td>{{$inquerys->created_at->format('d-m-Y')}}</td>

                                                <td>4</td>

                                            	<td><span class="badge" style="background-color: {{ $inquerys->inquirystatus->color }}">{{$inquerys->inquirystatus->name}}</span></td>

                                            	<td> 

                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">

                                                        <a href="javascript:void(0)" id="viewinquery" class="btn btn-outline-secondary" data-id="{{$inquerys->id}}"><i class="icofont-eye text-success"></i></a>

                                                        <a href="{{route('inquerydelete',$inquerys->id)}}" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></a>

                                                    </div> 

                                                </td>

                                                </tr>

                                                @endforeach

                                               

                                            

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div> <!-- Row end  -->

                </div>

            </div>



<div class="modal fade viewinquery" id="view" data-backdrop="static" data-keyboard="false" tabindex="-1">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="staticBackdropLiveLabel">Inquiry Details</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body" id="modelview">

                 

                </div>

               

            </div>

        </div>

</div>



@endsection

@section('javascript')

<script type="text/javascript">



    $(document).ready(function(){



        $(document).on('click','#viewinquery' , function(){

            var id = $(this).data('id');

            $.ajax({

                        url: "{{route('buyerinqueryfind')}}",

                        type: "POST",

                        data: {

                            id: id,

                            _token: '{{csrf_token()}}'

                        },

                        dataType: 'json',

                        success: function(result) {

                         $("#modelview").html(result.html);

                         $('.viewinquery').modal('show');

                        }

                    });

        });

    });

</script>

@endsection