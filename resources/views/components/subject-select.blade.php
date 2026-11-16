<div class="mb-3">
    <label for="subject_id" class="form-label">
        Matéria
        <small class="text-secondary">(somente uma)</small>
    </label>
    <div class="input-group">
        <span class="input-group-text text-danger">
            <i class="fa-solid fa-book"></i>
        </span>
        <select name="subject_id" id="subject_id" class="form-select">
            <option value="">Nenhuma</option>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}"
                    {{ (string) old('subject_id', $selected) === (string) $subject->id ? 'selected' : '' }}>
                    {{ $subject->name }}
                </option>
            @endforeach
        </select>
    </div>
    @error('subject_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
