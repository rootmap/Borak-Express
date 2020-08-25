<!-- jQuery -->
<script src="{{url('admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('https://cdn.jsdelivr.net/npm/sweetalert2@9')}}"></script>
<script>

    
        function swaloRDERSuccessMsg(msg) {
            Swal.fire({
                icon: 'success',
                title: '<h3 class="text-success">Order Successful</h3>',
                html: '<h4>' + msg + '</h4>'
            });
        }
    
        @if(Session::has('booking_id'))
            swaloRDERSuccessMsg("Your order id : {{Session::get('booking_id')}} <br> Please Keep it for further query.");
            <?php 
                \Session::forget('booking_id');
            ?>
        @endif
    
    </script>
<!-- Bootstrap 4 -->
<script src="{{ url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ url('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
