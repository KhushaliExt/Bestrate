 <div class="modal fade" id="modalforquery" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">New Query</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> -->
<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/he.min.js"></script>
 -->
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

            // modalClone.find('#modalinquirytime').text(dataItem.inquiry_time);
            modalClone.find('#modalkeyword').text(dataItem.keyword.name);
            modalClone.find('#modalquantity').text(dataItem.inquery.quantity);
            modalClone.find('#modalbudget').text(dataItem.inquery.budget_start + ' - ' + dataItem.inquery.budget_end);

            modalClone.find('.btn-accept').attr('data-id', + dataItem.id);
            modalClone.find('.btn-reject').attr('data-id', + dataItem.id);

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
            }
            
            updateCountdown();
            var countdownInterval = setInterval(updateCountdown, 1000); // Update every 1 second

            modalClone.appendTo('body');

            modalClone.modal('show');

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
                        }
                    });
        });
    });
</script>
@yield('javascript')