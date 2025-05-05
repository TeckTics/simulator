<!-- Bootstrap core JavaScript-->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

</body>



<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
{{-- <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script> --}}

<script>
    $(document).ready(function() {
        $('.close-modal-button').on('click', function() {
            let name = $(this).attr('name');
            let expendEvent = document.getElementById(name);
            // $(name).attr('hidden', 'false');
            // alert(expendEvent.innerHTML)
            expendEvent.hidden = true;
        });
        $('.show-formation-detail').on('click', function() {
            // alert(1)
            let name = $(this).attr('name');
            let expendEvent = document.getElementById(name);
            // $(name).attr('hidden', 'false');
            // alert(expendEvent.innerHTML)
            expendEvent.hidden = false;
        });
        $('.show-formation-edit').on('click', function() {
            let name = $(this).attr('name');
            let expendEvent = document.getElementById(name);
            // $(name).attr('hidden', 'false');
            // alert(expendEvent.innerHTML)
            expendEvent.hidden = false;
        });

        $('.show-type-unite-card').on('click', function() {
            let name = $(this).attr('name');
            let expendEvent = document.getElementById(name);
            // $(name).attr('hidden', 'false');
            // alert(expendEvent.innerHTML)
            expendEvent.hidden = false;
        });
        // $('.btn').on('click', function() {
        //     alert(1)
        //     // let name = $(this).attr('name');
        //     // let expendEvent = document.getElementById(name);
        //     // $(name).attr('hidden', 'false');
        //     // alert(expendEvent.innerHTML)
        //     // expendEvent.hidden = false;
        // });
        // $('.show-modal-unite-pay').on('click', function() {
        //     alert(1)
        //     let name = $(this).attr('name');
        //     let expendEvent = document.getElementById(name);
        //     // $(name).attr('hidden', 'false');
        //     // alert(expendEvent.innerHTML)
        //     expendEvent.hidden = false;
        // });
        $('.close-type-unite-card').on('click', function() {
            $('.expend-type-unite-card').attr('hidden', true)
        });
    })
    // const showEvents = document.querySelectorAll('.show-event');
    // showEvents.forEach(element => {
    //     element.addEventListener('click', () => {
    //         alert(1)
    //     })
    // });
</script>

</html>
