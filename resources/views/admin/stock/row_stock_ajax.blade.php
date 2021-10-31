<tr class="row-stock-{{ $stock->id }}">
    <td id="div_images_{{ $stock->id }}">
        @if($stock->images)
        @foreach(json_decode($stock->images, true) as $image)
            <img src="{{ url($image) }}" alt="" class="img-thumbnail" width="70">
        @endforeach
        @endif
    </td>
    <td>{{ number_format($stock->input, 0, '.', '.') }}</td>
    <td>{{ number_format($stock->total_price, 0, '.', '.') }} VNĐ</td>
    <td>{{ $stock->note }}</td>
    <td>{{ substr($stock->created_at, 0, 10) }}</td>
    <td>
        <a href="{{route('admin.stock.edit', $stock->id)}}" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
            <i class="fas fa-pen-alt"></i>
        </a>
{{--        <a class="btn btn-icon btn-light btn-hover-danger btn-sm" onclick="deleteStock(this,{{ $stock->id }})">--}}
{{--            <i class="fas fa-trash-alt"></i>--}}
{{--        </a>--}}
        <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
           onclick="confirmDelete('#delete-stock-{{$stock->id}}');return false;">
            <i class="fas fa-trash-alt"></i>
        </a>
        <form method="POST" id="delete-stock-{{$stock->id}}"
              action="{{route('admin.stock.delete', $stock->id)}}"
              style="display: none;">
            @csrf
        </form>
    </td>
</tr>
