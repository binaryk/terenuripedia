<link rel="stylesheet" href="{!! asset('packages/datatables/css/1.10.4/datatable.css') !!}" />
<script src="{!! asset('packages/datatables/js/1.10.4/datatable.js') !!}"></script>
<script src="{!! asset('custom/js/Confirm.js') !!}"></script>
<script>
    var aprob = new App.Confirm('{!! \Easy\Form\StringHelper::Checked(0) !!}', '{!! \Easy\Form\StringHelper::Checked(1) !!}', "{!! route('admin.terrain.aprobare') !!}")
    aprob.handle();
    $(document).ready(function(){
        var dt = $('#terrains').DataTable();
    });
</script>