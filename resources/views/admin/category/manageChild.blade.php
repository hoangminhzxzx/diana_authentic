<ul>

    @foreach($childs as $child)
        <li>
            {{ $child->title }}
            @if(count($child->childs))
                @include('admin.category.manageChild',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
