<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="/assets/js/plugins.js"></script>
<script src="/assets/js/main.js"></script>


<script src="/assets/js/lib/data-table/datatables.min.js"></script>
<script src="/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="/assets/js/lib/data-table/jszip.min.js"></script>
<script src="/assets/js/lib/data-table/pdfmake.min.js"></script>
<script src="/assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="/assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="/assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="/assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="/assets/js/lib/data-table/datatables-init.js"></script>

<script src="/js/bootstrap-durationpicker.min.js"></script>
<script src="/js/datepicker.min.js"></script>
<script src="/js/datepicker.en.js"></script>
<script src="/js/timer.js"></script>

<script src="/js/script.js"></script>
@if (\Auth::check() && auth()->user()->hasRole('manager'))
    <script src="/js/issue_script.js"></script>
@endif



<script type="text/javascript">
    $(document).ready(function() {
     //   $('#bootstrap-data-table-export').DataTable();
    } );
</script>
