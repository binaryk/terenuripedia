<div class="panel">
    <div class="panel-body">
        <table class="table table-bordered" id="terrains">
            <thead>
            <th>Titlu teren</th>
            <th>Aprobat</th>
            </thead>
            <tbody>
            @foreach($terrains as $k => $terrain)
                <tr data-id="{!! $terrain->id !!}">
                    <td> {!! $terrain->title !!} </td>
                    <td><input class="aprobare" type="checkbox" @if($terrain->aprobat) checked  @endif value="{!! $terrain->id !!}"> </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>