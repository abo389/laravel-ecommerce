

<label class="form-label fw-bold">{{ $name }}</label>

<input 
type="{{ $type }}" 
name="{{ $name }}" 
value="{{ empty($value) ? old($name):$value }}" 
class="form-control 
@error($name) is-invalid  @enderror 
@if(old($name)) is-valid @endif">

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror


