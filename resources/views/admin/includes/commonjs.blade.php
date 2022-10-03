<script>
    function sweetalertDelete(id){
        event.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                        button: false,
                        timer: 2000
                    });
                    $("#deleteButton" + id).submit();
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    };
</script>


