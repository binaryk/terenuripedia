<table class="table table-bordered" id="terrains">
    <thead>
    <th>Titlu teren</th>
    <th>Aprobat</th>
    </thead>
    <tbody>
    @foreach($terrains as $k => $terrain)
    <tr data-id="{!! $terrain->id !!}">
        <td> {!! $terrain->title !!} </td>
        <td class="aprobare"><a href="">{!! \Easy\Form\StringHelper::Checked($terrain->aprobat) !!}</a> </td>
    </tr>
    @endforeach
    </tbody>
</table>