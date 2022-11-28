<script>
    function confirmation(ev) {
        ev.preventDefault()
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            ButtonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Do You Want To Deleted ?',
            text: 'Changes can not be reversed'
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes Deleted',
            cancelButtonText: 'No, Cancel it',
            reverseButtons: true
        }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlToRedirect;
                } else if ( /*Read more about handling dismissals below*/ result.dismiss === Swal.DismissReason
                    .cancel) {
                    swalWithBootstrapButtons.fire('')
                }

            }
        })
</script>
