@props([
    'url' => '',
    'thead' => []
])

<table class="table dt-responsive nowrap" id="index-dataTable" data-url="{{ $url }}" style="width: 100%">
    <thead>
    <tr>
        @foreach($thead as $th)
        <th>{{ $th }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
