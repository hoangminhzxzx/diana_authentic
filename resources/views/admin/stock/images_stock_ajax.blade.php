@foreach(json_decode($stock->images, true) as $image)
    <img src="{{ url($image) }}" alt="" class="img-thumbnail" width="70">
@endforeach
