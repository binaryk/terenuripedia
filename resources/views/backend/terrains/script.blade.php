<link rel="stylesheet" href="{!! asset('packages/datatables/css/1.10.4/datatable.css') !!}" />
<script src="{!! asset('packages/datatables/js/1.10.4/datatable.js') !!}"></script>
<script>
    $(document).ready(function(){
       var dt = $('#terrains').DataTable();

        $('.aprobare').click(function(){
            var id = $(this).closest('tr').data('id');
            $.ajax({
                method: "POST",
                url: "{!! route('admin.terrain.aprobare') !!}",
                data: {id: id}
            }).done(function(res){
              console.log(res);
              dt.draw();
              location.reload();
            })
        })
    });
</script>