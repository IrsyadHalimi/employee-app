@props([
    'modalId' => 'modalId',
    'modalTitle' => 'Modal Title',
    'formId' => 'formId',
    'inputs' => [],
    'submitButtonId' => 'submitForm',
    'submitButtonText' => 'Simpan',
])

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}">{{ $modalTitle }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="{{ $formId }}">
                    @csrf
                    @foreach($inputs as $input)
                        @if($input['type'] == 'hidden')
                            <input type="hidden" name="{{ $input['name'] }}" id="{{ $input['name'] }}" value="{{ $input['value'] ?? '' }}">
                        @else
                            <div class="mb-3">
                                <label for="{{ $input['name'] }}" class="form-label">{{ $input['label'] }}</label>

                                @if($input['type'] == 'select')
                                    <select id="{{ $input['name'] }}" name="{{ $input['name'] }}" class="form-select">
                                        <option value="">Pilih</option>
                                        @foreach($input['options'] as $option)
                                            <option value="{{ $option[$input['valueKey']] }}">{{ $option[$input['textKey']] }}</option>
                                        @endforeach
                                    </select>

                                @elseif($input['type'] == 'radio')
                                    @foreach ($input['options'] as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="{{ $input['name'] }}" id="{{ $option['id'] }}" value="{{ $option['value'] }}">
                                            <label class="form-check-label" for="{{ $option['id'] }}">{{ $option['text'] }}</label>
                                        </div>
                                    @endforeach

                                @elseif($input['type'] == 'checkbox')
                                    @foreach ($input['options'] as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="{{ $input['name'] }}[]" id="{{ $option['id'] }}" value="{{ $option['value'] }}">
                                            <label class="form-check-label" for="{{ $option['id'] }}">{{ $option['text'] }}</label>
                                        </div>
                                    @endforeach

                                @elseif($input['type'] == 'textarea')
                                    <textarea class="form-control" id="{{ $input['name'] }}" name="{{ $input['name'] }}" rows="3">{{ $input['value'] ?? '' }}</textarea>
                                    
                                @elseif($input['type'] == 'file')
                                    <input type="file" class="form-control" name="{{ $input['name'] }}" id="{{ $input['name'] }}" accept="{{ $input['accept'] ?? '*' }}">
                                @else
                                    <input type="{{ $input['type'] }}" class="form-control" id="{{ $input['name'] }}" name="{{ $input['name'] }}" value="{{ $input['value'] ?? '' }}">
                                @endif
                            </div>
                        @endif
                    @endforeach
                    <button type="submit" id="{{ $submitButtonId }}" class="btn btn-primary">{{ $submitButtonText }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
