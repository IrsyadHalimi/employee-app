@props([
    'name' => 'filter',
    'options' => [],
    'label' => 'Pilih Opsi',
    'valueKey' => 'id',
    'textKey' => 'name'
])

<select id="{{ $name }}Filter" class="filter-select form-select">
    <option value="">{{ $label }}</option>
    @foreach ($options as $option)
        <option value="{{ $option[$valueKey] }}">{{ $option[$textKey] }}</option>
    @endforeach
</select>
