<script>
  var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{asset(('public/backend'))}}/js/jquery.min.js"></script>
<script src="{{asset(('public/backend'))}}/js/bootstrap.min.js"></script>
<script src="{{asset(('public/backend'))}}/js/wow.min.js"></script>
<script src="{{asset(('public/backend'))}}/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="{{asset(('public/backend'))}}/js/jquery.scrollTo.min.js"></script>
<script src="{{asset(('public/backend'))}}/assets/jquery-detectmobile/detect.js"></script>
<script src="{{asset(('public/backend'))}}/assets/fastclick/fastclick.js"></script>
<script src="{{asset(('public/backend'))}}/assets/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="{{asset(('public/backend'))}}/assets/jquery-blockui/jquery.blockUI.js"></script>


<!-- CUSTOM JS -->
<script src="{{asset(('public/backend'))}}/js/jquery.app.js"></script>

<!-- TOASTR SCRIPT -->
<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
{{-- ajax cdn here --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- sweet alert cdn -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $('.swal-confirm').click(function(){
      let id = $(this).data('id');
      swal({
        title: "Are you sure?"+id,
        text: "delete this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });
          $('#delete'+id).submit();
        }
      });
  });
</script> 

<script src="{{asset(('public/backend'))}}/assets/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset(('public/backend'))}}/assets/datatables/dataTables.bootstrap.js"></script>



<script type="text/javascript">
  $(document).ready(function() {
      $('#datatable').dataTable();
  } );
</script>

@stack('js')
