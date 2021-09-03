<select name="ward" id="ward" class="select_checkout">
    <option value="" disabled="disabled" selected="" value="null">Phường/Xã</option>
    @foreach($wards as $ward)
        <option value="{{ $ward->id }}">{{ $ward->name }}</option>
    @endforeach
</select>
