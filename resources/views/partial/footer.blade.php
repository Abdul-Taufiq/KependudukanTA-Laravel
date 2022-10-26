<!-- Bootstrap core JavaScript-->
    <script src="{{ asset('style/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('style/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('style/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('style/js/sb-admin-2.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/select2/dist/js/select2.min.js') }}" defer></script>

    <script src="{{ asset('assets/dist/air-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>

<script type="text/javascript">
     $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: 'true',
    });
</script> 

<script>
    $(document).ready(function() {
        $('.combobox').select2();
    });    
</script>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "order": [[ 1, "asc" ]],
        // "lengthMenu": [[]],
        "aLengthMenu": [[ 5, 10, 20, 50, 100, -1], [5, 10, 20, 50, 100, "Semua"]],

    	"scrollX": true,
        "columnDefs" : [{
            "targets": 0,
            "searchable":false,
            "sortable":false
        }]
    });
} );
</script>



</body>

</html>