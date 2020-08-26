<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(function () {
        $("#table").DataTable({
          responsive: true,
          autoWidth: false,
          paging:false,
          searching:false,
          info:false,
        });});
        function deleteRecord(id){
        swal({ title: "This record will be deleted permanently!",
        text: "Are you sure to proceed?",
        icon: "warning",
        buttons:{
            cancel:{
                text: "Cancel",
                value: null,
                visible:true
            },
            confirm:{
                text: "Delete",
                value: true,
                className:'confirm-button'
            }
        },

        }).then(isConfirm=>{
        if (isConfirm)
            {
                let url = $(`#delete-route-${id}`).prop('href');
                token = $('input[name="_token"]').val();
                let data={
                    _token:token
                }
                $.ajax({
                    url:url,
                    type:'delete',
                    data:data,
                    success:function(response){
                        if(response.status){
                            swal("Deleted Successfully!", "", "success");
                            $('#record-'+id).remove();
                        }
                        else
                        swal("Something Happened!!", "", "error");
                    }
                })

            }
                });
        }
</script>
