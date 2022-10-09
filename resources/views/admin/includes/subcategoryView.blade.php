
<ul id="tree1">
    @foreach($subcategories as $subcategory)
        <li><a href="#">{{ $subcategory->name ? $subcategory->name : 'N/A' }}</a> <span><a href="{{ route('subcategoryedit',$subcategory->id) }}" class="btn btn-sm btn-warning">Edit</a> </span>
            @if(count($subcategory->subcategory))
                    <li>@include('admin.includes.subcategoryView',['subcategories' => $subcategory->subcategory]) </li>
            @endif
        </li>
    @endforeach
</ul>

