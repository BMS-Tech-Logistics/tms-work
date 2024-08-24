<?php 

    $getFooterSql = $objOperationAdmin-> getFooterText();
    $footerData=mysqli_fetch_array($getFooterSql);

?>


    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.1
        </div>
        <strong>Copyright &copy; <?php echo $footerData['text']; ?>.</strong> All rights reserved.
    </footer>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>





    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.min.js"></script>
    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Select Transport Rent',
                theme: 'bootstrap4',
                tags: true,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select3').select2({
                placeholder: 'Select Status',
                theme: 'bootstrap4',
                tags: true,
            });
        });
        
        $(document).ready(function() {
            // Initialize Select2 with Bootstrap4 theme
            $('.select4').select2({
                placeholder: 'Select vehicle category',
                theme: 'bootstrap4',
                tags: false, // Set to false since tags aren't used here
            });

            // Store all size options
            var allSizeOptions = $('#size option');

            // Function to update size dropdown
            function updateSizeDropdown() {
                var selectedCategory = $('#category').val();
                $('#size').html(''); // Clear existing options
                var filteredOptions = allSizeOptions.filter(function() {
                    var category = $(this).data('category');
                    return $(this).val() === "" || category === selectedCategory;
                });
                $('#size').append(filteredOptions).trigger('change.select2');
                // Retain the selected value if it exists
                var selectedSize = $('#vehicle_size').val();
                if (selectedSize!=null) {
                    $('#size').val(selectedSize).trigger('change.select2');
                } else {
                    $('#size').val(null).trigger('change.select2');
                }
                //$('#size').val(null).trigger('change');
            }

            // Enable or disable size dropdown based on category selection
            function toggleSizeDropdown() {
                var categorySelected = $('#category').val() !== "";
                $('#size').prop('disabled', !categorySelected);
                if (categorySelected) {
                    updateSizeDropdown();
                }
            }

            // Bind change event to category dropdown
            $('#category').change(toggleSizeDropdown);

            // Initial check on page load
            toggleSizeDropdown();
        });

        
        
        $(document).ready(function() {
            $('.select5').select2({
                placeholder: 'Select Vendor Size/Capacity',
                theme: 'bootstrap4',
                tags: true,
            });
        });
        
        $(document).ready(function() {
            $('.select6').select2({
                placeholder: 'Select Vehicle Registration zone',
                theme: 'bootstrap4',
                tags: true,
            });
        });
        
        $(document).ready(function() {
            $('.select7').select2({
                placeholder: 'Select Vehicle Registration Serial',
                theme: 'bootstrap4',
                tags: true,
            });
        });
        
        $(document).ready(function() {
            $('.select8').select2({
                placeholder: 'Select Vendor Name',
                theme: 'bootstrap4',
                tags: true,
                minimumResultsForSearch: Infinity,
            });
        });
        
        $(document).ready(function() {
            $('.select9').select2({
                placeholder: 'Select District',
                theme: 'bootstrap4',
                tags: true,
            });
        });
        
        $(document).ready(function() {
            $('.select10').select2({
                placeholder: 'Select Uset Type',
                theme: 'bootstrap4',
                tags: true,
                minimumResultsForSearch: Infinity,
            });
        });
    </script>

    <!-- bs-custom-file-input -->
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
    $(function () {
      bsCustomFileInput.init();
    });
    </script>

    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Ekko Lightbox -->
    <script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- Filterizr-->
    <script src="plugins/filterizr/jquery.filterizr.min.js"></script>
    <!--Gallery Page specific script -->
    <script>
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>



    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/dashboard3.js"></script>

    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- jquery-validation -->
    <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="plugins/jquery-validation/additional-methods.min.js"></script>


    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/dashboard.js"></script><!-- fullCalendar 2.2.5 -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/fullcalendar/main.js"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>

    <!-- AdminLTE for demo purposes -->

    <!-- Page specific script -->
    <script>
        $(function() {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function() {

                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0 //  original position after the drag
                    })

                })
            }

            ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                    };
                }
            });

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                //Random default events
                events: [{
                        title: 'All Day Event',
                        start: new Date(y, m, 1),
                        backgroundColor: '#f56954', //red
                        borderColor: '#f56954', //red
                        allDay: true
                    },
                    {
                        title: 'Long Event',
                        start: new Date(y, m, d - 5),
                        end: new Date(y, m, d - 2),
                        backgroundColor: '#f39c12', //yellow
                        borderColor: '#f39c12' //yellow
                    },
                    {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false,
                        backgroundColor: '#0073b7', //Blue
                        borderColor: '#0073b7' //Blue
                    },
                    {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false,
                        backgroundColor: '#00c0ef', //Info (aqua)
                        borderColor: '#00c0ef' //Info (aqua)
                    },
                    {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        allDay: false,
                        backgroundColor: '#00a65a', //Success (green)
                        borderColor: '#00a65a' //Success (green)
                    },
                    {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'https://www.google.com/',
                        backgroundColor: '#3c8dbc', //Primary (light-blue)
                        borderColor: '#3c8dbc' //Primary (light-blue)
                    }
                ],
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                }
            });

            calendar.render();
            // $('#calendar').fullCalendar()

            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            // Color chooser button
            $('#color-chooser > li > a').click(function(e) {
                e.preventDefault()
                // Save color
                currColor = $(this).css('color')
                // Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
            })
            $('#add-new-event').click(function(e) {
                e.preventDefault()
                // Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                // Create events
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.text(val)
                $('#external-events').prepend(event)

                // Add draggable funtionality
                ini_events(event)

                // Remove event from text input
                $('#new-event').val('')
            })
        })
    </script>

    <script>
        $(function() {
            //Add text editor
            $('#compose-textarea').summernote()
        })
    </script>

    <script>
        $(function() {
            //Enable check and uncheck all functionality
            $('.checkbox-toggle').click(function() {
                var clicks = $(this).data('clicks')
                if (clicks) {
                    //Uncheck all checkboxes
                    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
                    $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
                } else {
                    //Check all checkboxes
                    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
                    $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
                }
                $(this).data('clicks', !clicks)
            })

            //Handle starring for font awesome
            $('.mailbox-star').click(function(e) {
                e.preventDefault()
                //detect type
                var $this = $(this).find('a > i')
                var fa = $this.hasClass('fa')

                //Switch states
                if (fa) {
                    $this.toggleClass('fa-star')
                    $this.toggleClass('fa-star-o')
                }
            })
        })
    </script>

    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>



    <!--Data Table Page PDF/Excel/CSV specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "ordering": true,
                "autoWidth": false,
                "buttons": [ "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": tr,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            
        });
    </script>

    <!--News & Media Form Validation-->
    <script>
        $(function() {
            $('#newsAndMediaForm').validate({
                rules: {
                    news_title: {
                        required: true,
                    },
                    news_link: {
                        required: true,
                    },
                    news_partner: {
                        required: true,
                    },
                    news_date: {
                        required: true
                    },
                    news_image: {
                        required: true
                    }
                },
                messages: {
                    news_title: {
                        required: "Please enter a news title",
                    },
                    news_link: {
                        required: "Please enter a news link",
                    },
                    news_partner: {
                        required: "Please select a news partner",
                    },
                    news_date: {
                        required: "Please enter a publish date",
                    },
                    news_image: {
                        required: "Please input news cover image",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            // Add change event handler to news_image input
            $('#news_image').on('change', function() {
                $('#news_image-error').hide(); // Hide the error message for news_image input
                $('#news_image').removeClass('is-invalid'); // Remove the is-invalid class
            });

            // Add change event handler to news_partner input
            $('#news_partner').on('change', function() {
                $('#news_partner-error').hide(); // Hide the error message for news_partner input
                $('#news_partner').removeClass('is-invalid'); // Remove the is-invalid class
            });
        });
        
        $(function() {
            $('#updateNewsAndMediaForm').validate({
                rules: {
                    news_title: {
                        required: true,
                    },
                    news_link: {
                        required: true,
                    },
                    news_partner: {
                        required: true,
                    },
                    news_date: {
                        required: true
                    }
                },
                messages: {
                    news_title: {
                        required: "Please enter a news title",
                    },
                    news_link: {
                        required: "Please enter a news link",
                    },
                    news_partner: {
                        required: "Please select a news partner",
                    },
                    news_date: {
                        required: "Please enter a publish date",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            // Add change event handler to news_image input
            $('#news_image').on('change', function() {
                $('#news_image-error').hide(); // Hide the error message for news_image input
                $('#news_image').removeClass('is-invalid'); // Remove the is-invalid class
            });

            // Add change event handler to news_partner input
            $('#news_partner').on('change', function() {
                $('#news_partner-error').hide(); // Hide the error message for news_partner input
                $('#news_partner').removeClass('is-invalid'); // Remove the is-invalid class
            });
        });
        
       $(function() {
            // Add onchange event listener to image input
            $('#customFile').on('change', function() {
                var input = this;
                var image = new Image();
                image.src = URL.createObjectURL(input.files[0]);
                image.onload = function() {
                    if (this.width !== 1200 || this.height !== 520) {
                        // Display error message if dimensions are not 1200x520
                        $('#customFile').addClass('is-invalid');
                        $('#customFile').closest('.form-group').find('.invalid-feedback').text('Image dimensions must be (WxH) 1200x520 pixel.');
                        $('#customFile').val(''); // Clear the input field
                        $('#image-preview-container').hide(); // Hide the preview container
                    } else {
                        // Clear any previous error message
                        $('#customFile').removeClass('is-invalid');
                        $('#customFile').closest('.form-group').find('.invalid-feedback').text('');
                        $('#image-preview').attr('src', image.src); // Update image preview
                        $('#image-preview-container').show(); // Show the preview container
                    }
                };
            });

            // Add click event listener to clear button
            $('#clear-image').on('click', function() {
                $('#customFile').val(''); // Clear the input field
                $('#customFile').closest('.custom-file').find('.custom-file-label').text('Choose image'); // Clear the input label
                $('#image-preview-container').hide(); // Hide the preview container
                $('#customFile').removeClass('is-invalid'); // Remove any validation error
                $('#customFile').closest('.form-group').find('.invalid-feedback').text(''); // Clear error message
            });

            $('#slideImageForm').validate({
                rules: {
                    slide_title: {
                        required: true
                    },
                    slide_image: {
                        required: true
                    }
                },
                messages: {
                    slide_title: {
                        required: "Please input title*"
                    },
                    slide_image: {
                        required: "Please select an image file*"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        $(function(){
            $('#galleryImageForm').validate({
                rules: {
                    gallery_id: {
                        required: true
                    },
                    gallery_image: {
                        required: true
                    }
                },
                messages: {
                    gallery_id: {
                        required: "Please select event name*"
                    },
                    gallery_image: {
                        required: "Please select an image file*"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        $(function(){
            $('#galleryVideoForm').validate({
                rules: {
                    video_link: {
                        required: true
                    },
                    video_type: {
                        required: true
                    },
                    video_thum: {
                        required: true
                    }
                },
                messages: {
                    video_link: {
                        required: "Please input video link*"
                    },
                    video_type: {
                        required: "Please select video type*"
                    },
                    video_thum: {
                        required: "Please input thumbnail image*"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        $(function(){
            $('#galleryVideoFormEdit').validate({
                rules: {
                    video_link: {
                        required: true
                    },
                    video_type: {
                        required: true
                    }
                },
                messages: {
                    video_link: {
                        required: "Please input video link*"
                    },
                    video_type: {
                        required: "Please select video type*"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        $(function(){
            $('#galleryEventCreateForm').validate({
                rules: {
                    img_title: {
                        required: true
                    },
                    img_category: {
                        required: true
                    },
                    img_event_date: {
                        required: true
                    }
                },
                messages: {
                    img_title: {
                        required: "Please input event name*"
                    },
                    img_category: {
                        required: "Please select event type*"
                    },
                    img_event_date: {
                        required: "Please select event date*"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        $(function(){
          
            $('#newEventForm').validate({
                rules: {
                    event_name: {
                        required: true
                    },
                    event_type: {
                        required: true
                    },
                    event_category: {
                        required: true
                    }
                },
                messages: {
                    event_name: {
                        required: "Please input event name*"
                    },
                    event_type: {
                        required: "Please select event type*"
                    },
                    event_category: {
                        required: "Please select event category*"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        $(function(){
            $('#userForm').validate({
                rules: {
                    full_name: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    email: {
                        required: false
                    },
                    password: {
                        required: true
                    },
                    confirmPassword: {
                        required: true
                    },
                    type: {
                        required: true
                    }
                },
                messages: {
                    full_name: {
                        required: "Please input full name *"
                    },
                    phone: {
                        required: "Please input mobile number *"
                    },
                    email: {
                        required: "Please input email *"
                    },
                    password: {
                        required: "Please input password *"
                    },
                    confirmPassword: {
                        required: "Please input Confirm password *"
                    },
                    type: {
                        required: "Please select user type *"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        $(function(){
            $('#dealerForm').validate({
                rules: {
                    full_name: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    email: {
                        required: false
                    },
                    password: {
                        required: true,
                        minlength: 6 // Minimum length of 6 characters
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#password" // Must match the password field
                    }
                },
                messages: {
                    full_name: {
                        required: "Please input full name *"
                    },
                    phone: {
                        required: "Please input mobile number *"
                    },
                    email: {
                        required: "Please input email *"
                    },
                    password: {
                        required: "Please input password *",
                        minlength: "Password must be at least 6 characters long"
                    },
                    confirmPassword: {
                        required: "Please input Confirm password *",
                        equalTo: "Passwords do not match"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

    </script>

    <!--News & Media Date And Time Picker-->
    <script>
        $(function(){
            $('#reservationdatetime').datetimepicker({ 
                format: 'MMMM DD, YYYY, hh:mm A',  // Specify the desired format
                icons: { 
                    time: 'far fa-clock' 
                },
                useCurrent: true  // Prevent automatic date/time selection on initialization
            });
            
            // Close datetimepicker on date selection
            $('#reservationdatetime').on('change.reservationdatetime', function() {
                $(this).datetimepicker('hide');
            });
        });
    </script>

    <!--Gallery Event Date Picker-->
    <script>
        $(function(){
            $('#reservationdate').datetimepicker({ 
                format: 'MMMM D, YYYY (dddd)',  // Specify the desired format
                useCurrent: true  // Prevent automatic date/time selection on initialization
            });
            
            // Close datetimepicker on date selection
            $('#reservationdate').on('change.reservationdate', function() {
                $(this).datetimepicker('hide');
            });
        });
    </script>

    <!-- Event Date and Time Picker-->
    <script>
        
        $(function(){
            $('#join_date').datetimepicker({ 
                format: 'DD-MM-YYYY ',  // Specify the desired format
                useCurrent: true  // Prevent automatic date/time selection on initialization
            });
            
            // Close datetimepicker on date selection
            $('#join_date').on('change.datetimepicker', function() {
                $(this).datetimepicker('hide');
            });
        });
        
        //Timepicker
       
        $(function () {
            $('#startTime').datetimepicker({
                format: 'LT'
            });

            $('#endTime').datetimepicker({
                format: 'LT',
                useCurrent: false //Important! See issue #1075
            });

            $("#startTime").on("change.datetimepicker", function (e) {
                $('#endTime').datetimepicker('minDate', e.date);
            });
            $("#endTime").on("change.datetimepicker", function (e) {
                $('#startTime').datetimepicker('maxDate', e.date);
            });
        });
    </script>


    </body>

    </html>