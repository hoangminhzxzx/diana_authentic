<tr>
{{--    <td>--}}
{{--        <span>--}}
{{--            <label class="checkbox checkbox-single">--}}
{{--                <input type="checkbox" value="1">&nbsp;--}}
{{--            </label>--}}
{{--        </span>--}}
{{--    </td>--}}
    <td><span>{{ ($item->color)?$item->color->value:"" }}</span></td>
    <td><span>{{ ($item->color)?$item->color->name:"" }}</span></td>
    <td><span>{{ ($item->size)?$item->size->value:"" }}</span></td>
    <td><span>{{ ($item->qty)?$item->qty:""}}</span></td>
    <td>
        <a href="{{ route('admin.product.variant.edit', ['id'=>$item->id]) }}"
           class="btn btn-icon btn-light btn-hover-primary btn-sm mr-1">
            <i class="fas fa-pen-alt"></i>
        </a>
        <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
           onclick="confirmDelete('#delete-variant-{{ $item->id }}');return false;">
            <i class="fas fa-trash-alt"></i>
        </a>
        <form method="POST" id="delete-variant-{{ $item->id }}"
              action="{{ route('admin.product.variant.delete', ['id'=>$item->id]) }}"
              style="display: none;">
            @csrf
        </form>
    </td>
</tr>
