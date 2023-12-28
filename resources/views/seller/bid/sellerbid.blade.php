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

                                <h3 class="fw-bold mb-0">Bids</h3>

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

                                                <th>Keywords</th>

                                                <th>Qty</th>

                                                <th>Budget</th>

                                                <th>Request Date</th>

                                                <th>Response Date</th>

                                                <th>Amount</th>

                                                <th>Timer to send Quotation</th>

                                                <th>Status</th>

                                                <th>Quotation</th>

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                            $i=1;

                                            ?>

                                            @if(isset($sellerquerys))

                                            @foreach($sellerquerys as $bids)

                                            <tr>

                                            	<td>{{$i}}</td>

                                                  <?php

                                                        $i++;

                                                ?>

                                            	<td>{{$bids->inquery->keyword->name}}</td>

                                            	<td>{{$bids->inquery->quantity}}</td>

                                                <td>{{$bids->inquery->budget_start}} - {{$bids->inquery->budget_end}}</td>

                                            	<td>{{$bids->created_at->format('d-m-Y')}}</td>

                                                <td>{{$bids->response_date}}</td>

                                                <td>{{$bids->amount}}</td>

                                                <td>

                                                    @if($bids->quotation_time_start !== null && $bids->quotation_time_end !== null)

                                                        @php

                                                            $startTime = \Carbon\Carbon::parse($bids->quotation_time_start);

                                                            $endTime = \Carbon\Carbon::parse($bids->quotation_time_end);

                                                            $timeDifference = $endTime->diffInMinutes($startTime);

                                                        @endphp

                                                        <span>{{ $timeDifference }} minutes</span>

                                                    @else

                                                        -

                                                    @endif

                                                </td>

                                                <td>{{$bids->inquirystatus->name}}</td>

                                                <td>

                                                    @if($bids->inquery_status == "2" || $bids->inquery_status == "4" || $bids->inquery_status == '5' || $bids->inquery_status == "6")

                                                    <a href="javascript:void(0)" data-id="{{$bids->id}}"class="btn btn-primary viewquotation">Quotation</a>

                                                    @else

                                                    -

                                                    @endif

                                                </td>

                                            	<td> 

                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">

                                                        <a href="{{route('deletesellerquery',$bids->id)}}" class="btn btn-outline-secondary deleterow" onclick="return confirm('Are you sure Delete this Recored ?')"><i class="icofont-ui-delete text-danger"></i></a>

                                                        

                                                    </div> </td>

                                            </tr>

                                            @endforeach

                                            @endif

                                          

                                        </tbody>

                                    </table>



                                    

                                </div>

                            </div>

                        </div>

                    </div> <!-- Row end  -->

                </div>

            </div>

<div class="modal fade quotationmodal" id="quotationmodal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalCenterTitle">Quotation</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body modelview" id="modelview">

                 

                </div>      

            </div>

        </div>

    </div>

@endsection

@section('javascript')

<script type="text/javascript">



    $(document).ready(function(){

        $(document).on('click','.viewquotation' , function(){

            var id = $(this).data('id');

            $.ajax({

                        url: "{{route('findquotation')}}",

                        type: "POST",

                        data: {

                            id: id,

                            _token: '{{csrf_token()}}'

                        },

                        dataType: 'json',

                        success: function(result) {

                         $("#modelview").html(result.html);

                         $('.quotationmodal').modal('show');

                        }

                    });

        });

    });

</script>







@endsection



