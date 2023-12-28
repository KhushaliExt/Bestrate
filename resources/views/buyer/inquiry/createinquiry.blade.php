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

                            <button type="button" class="btn-close btn-close-white ms-auto me-2" data-bs-dismiss="toast" aria-label="Close"></button>

                        </div>



                        @section('javascript')

                        <script>

                            $(document).ready(function () {

                                $("#myToast").fadeOut(5000).attr('style','display: none !important');

                            });

                        </script>

                        @endsection

                    @endif



                    @if (session('warningsmsg'))

                        <div class="toast d-flex align-items-center text-white bg-danger border-0" role="alert" style="float:right;" id="myToastwarning">

                            <div class="toast-body">

                                {{ session('warningsmsg') }}

                            </div>

                            <button type="button" class="btn-close btn-close-white ms-auto me-2" data-bs-dismiss="toast" aria-label="Close"></button>

                        </div>



                        @section('javascript')

                        <script>

                            $(document).ready(function () {

                                $("#myToastwarning").fadeOut(5000).attr('style','display: none !important');

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

                                <h3 class="fw-bold mb-0">Create Inquiries</h3>

                            </div>

                        </div>

                    </div> <!-- Row end  -->



                    <div class="row align-item-center">

                        <div class="col-md-12">

                            <div class="card mb-3">

                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">

                                    <h6 class="mb-0 fw-bold ">Create Inquiries</h6> 

                                </div>

                                <div class="card-body">

                                    <form method="post" action="{{route('postbuyerinquiries')}}" enctype="multipart/form-data">

                                        @csrf

                                        <div class="row g-3 align-items-center">

                                            <div class="col-md-12">

                                                <label for="firstname" class="form-label">Products</label>

                                                <select class="form-control"  name="keyword_id" required>

                                                <option value="" selected disabled>Select Products</option>

                                                    @foreach($keyword as $keywords)

                                                        <option value="{{$keywords->id}}">{{$keywords->name}}</option>

                                                    @endforeach

                                                </select>

                                            </div>

                                            <div class="col-md-6">

                                                <label for="lastname" class="form-label">Quantity</label>

                                                <input type="number" class="form-control" id="lastname" required placeholder="Enter Quantity" name="quantity" step="1" onkeypress="return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57" min="0">

                                            </div>

                                            <div class="col-md-3">

                                                <label  class="form-label">Budget Min</label>

                                                <input type="number" class="form-control" id="budgetMin" required placeholder="Budget Min" name="budget_start" step="1" onkeypress="return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57" min="0">

                                            </div>

                                            <div class="col-md-3">

                                            	<label  class="form-label">Budget Max</label>

                                            		<input type="number" class="form-control" id="budgetMax" required placeholder="Budget Max" name="budget_end" step="1" onkeypress="return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57" min="0" >

                                            	</div>	

                                            </div>



                                            <div class="col-md-12">

                                                <label for="emailaddress" class="form-label">Description</label>

                                                <textarea class="form-control" name="description"></textarea>

                                            </div>



                                            <div class="col-md-6">

                                                <label for="formFileMultiple" class="form-label"> File Upload</label>

                                                <input class="form-control" type="file" id="formFileMultiple"  name="file[]" multiple>

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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var budgetMinInput = document.getElementById("budgetMin");
        var budgetMaxInput = document.getElementById("budgetMax");

        // Add event listener to "Budget Min" field
        budgetMinInput.addEventListener("input", function () {
            if (parseInt(budgetMinInput.value) > parseInt(budgetMaxInput.value)) {
                // If Budget Min is greater than Budget Max, set Budget Min to Budget Max
                budgetMinInput.value = budgetMaxInput.value;
            }
        });

        // Add event listener to "Budget Max" field
        budgetMaxInput.addEventListener("input", function () {
            if (parseInt(budgetMaxInput.value) < parseInt(budgetMinInput.value)) {
                // If Budget Max is less than Budget Min, set Budget Max to Budget Min
                budgetMaxInput.value = budgetMinInput.value;
            }
        });
    });
</script>
@endsection




