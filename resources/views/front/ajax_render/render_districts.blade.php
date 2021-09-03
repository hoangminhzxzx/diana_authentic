<select name="district" id="district" class="select_checkout" onchange="selectDistrict(this)">
    <option value="" disabled="disabled" selected="" value="null">Quận/Huyện</option>
    @foreach($districts as $district)
        <option value="{{ $district->id }}">{{ $district->name }}</option>
    @endforeach
</select>
