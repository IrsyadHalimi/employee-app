@props([
    'name' => 'table',
    'options' => [],
])

<table id="{{ $name }}" class="table table-striped">
    <thead>
        <tr>
            @foreach($options as $option)
                <th>{{ $option }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
