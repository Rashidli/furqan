<tbody wire:sortable="updateCategoryOrder">

@foreach($categories as $key => $category)

    <tr  wire:sortable.item="{{ $category->id }}" wire:key="category-{{ $category->id }}">
        <td>{{$category->row}}</td>
        <td wire:sortable.handle style="cursor: pointer">{{$category->title}}</td>
        <td>{{ $category->parent ? $category->parent->title : 'N/A' }}</td>

        <td>
            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-primary" style="margin-right: 15px" >Edit</a>
            @if (!$category->children->isNotEmpty())
                <form action="{{route('categories.destroy', $category->id)}}" method="post" style="display: inline-block">
                    {{ method_field('DELETE') }}
                    @csrf
                    <button onclick="confirm('Məlumatın silinməyin təsdiqləyin')" type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endif
        </td>
    </tr>
@endforeach

</tbody>
