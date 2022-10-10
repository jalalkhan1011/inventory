
<ul id="tree1">
    @foreach($subcategories as $subcategory)
        <li><a href="#">{{ $subcategory->name ? $subcategory->name : 'N/A' }}</a> <span><a href="{{ route('subcategoryedit',$subcategory->id) }}" class="btn btn-sm btn-warning">Edit</a> </span>
            @if(count($subcategory->subcategory))
                    <ul>@include('admin.includes.subcategoryView',['subcategories' => $subcategory->subcategory]) </ul>
            @endif
        </li>
    @endforeach
</ul>

