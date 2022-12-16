<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
{{-- <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script> --}}
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script>
    $(document).ready(function (){
        $('#logout').on('click', function(){
            $('#btnlogout').click();
        });

        $('#mytable').DataTable({
            responsive: window.innerWidth < 1000 ? true : false,
            searching: true,
            paging: false,
        });

        $('#mytable_filter').find('.form-control').css('height', '0px');
    });
</script>
