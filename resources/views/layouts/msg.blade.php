                @if (session('successmsg'))
                        <div class="toast d-flex align-items-center text-white bg-success border-0" role="alert" style="float:right;" id="myToast">
                            <div class="toast-body">
                                {{ session('successmsg') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white ms-auto me-2" id="successCloseToast" aria-label="Close"></button>
                        </div>

                        <script>
                            // Fade out and hide the toast after 2000 milliseconds (2 seconds)
                            setTimeout(function(){
                                $('#myToast').fadeOut('slow', function(){
                                    $(this).remove(); // Remove the element from the DOM
                                });
                            }, 1000);

                            // Close the toast when the close button is clicked
                            $('#successCloseToast').click(function(){
                                $('#myToast').fadeOut('slow', function(){
                                    $(this).remove(); // Remove the element from the DOM
                                });
                            });
                        </script>
                @endif  

                @if (session('warningsmsg'))
                        <div class="toast d-flex align-items-center text-white bg-danger border-0" role="alert" style="float:right;" id="warningmyToast">
                            <div class="toast-body">
                                {{ session('warningsmsg') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white ms-auto me-2" id="warningCloseToast" aria-label="Close"></button>
                        </div>

                        <script>
                            // Fade out and hide the toast after 2000 milliseconds (2 seconds)
                            setTimeout(function(){
                                $('#warningmyToast').fadeOut('slow', function(){
                                    $(this).remove(); // Remove the element from the DOM
                                });
                            }, 1000);

                            // Close the toast when the close button is clicked
                            $('#warningCloseToast').click(function(){
                                $('#warningmyToast').fadeOut('slow', function(){
                                    $(this).remove(); // Remove the element from the DOM
                                });
                            });
                        </script>
                @endif