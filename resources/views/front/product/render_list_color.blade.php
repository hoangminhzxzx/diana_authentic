<div class="form-group" style="margin-top: .5rem;" id="group_color">
    @if($colors)
    <label for="">Chọn Màu</label>
    <div style="display: flex;">
        <input type="hidden" id="valueColor" name="color" value="">
        @foreach($colors as $color)
            <div onclick="chooseColor(this)" data-color="{{ $color->id }}" style="background: {{ $color->value }}; width: 30px; height: 30px; border-radius: 50%; margin-top: .5rem; cursor: pointer; margin-right: .5rem;"></div>
        @endforeach
    </div>
    @error('color')
    <small style="color: indianred;">{{$message}}</small>
    @enderror

    @else
        <span style="margin-top: 1rem;">Hết hàng</span> <br>
    @endif
</div>
