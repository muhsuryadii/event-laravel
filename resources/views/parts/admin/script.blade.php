<!--   Core JS Files   -->
<script src={{ asset('argon/js/core/popper.min.js') }}></script>
<script src={{ asset('argon/js/core/bootstrap.min.js') }}></script>
<script src={{ asset('argon/js/plugins/perfect-scrollbar.min.js') }}></script>
<script src={{ asset('argon/js/plugins/smooth-scrollbar.min.js') }}></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src={{ asset('argon/js/argon-dashboard.min.js?v=2.0.2') }}></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script> --}}

<script>
    /*     var konten = document.getElementById("ckeditor");
    CKEDITOR.replace(konten, {
        language: 'en-gb'
    });
    CKEDITOR.config.allowedContent = true; */

    ClassicEditor
        .create(document.querySelector('#ckeditor'), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'CKTable', 'EasyImage', 'Image',
                'ImageCaption', 'ImageStyle',
                'ImageToolbar', 'ImageUpload', 'MediaEmbed', 'insertTable '
            ],

        })
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
