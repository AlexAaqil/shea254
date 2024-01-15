@foreach($orders as $value)
<tr class="searchable">
    <td>{{ $value->order_number }}</td>
    <td>{{ $value->first_name }} {{ $value->last_name }}</td>
    <td>{{ $value->phone_number }}</td>
    <td>{{ $value->address }}</td>
    <td>{{ $value->shipping_cost }}</td>
    <td>{{ $value->total_amount }}</td>
    <td class="{{ $value->status == 'pending' ? 'text-danger' : 'text-success'  }}">{{ $value->status }}</td>
    <td>{{ $value->paid == 0 ? 'No' : 'Yes' }}</td>
    <td class="actions">
            <div class="action">
            <a href="{{ route('get_update_order', ['id'=>$value->id]) }}">
                <i class="fas fa-pencil-alt update"></i>
            </a>
        </div>
        {{-- <div class="action">
            <form id="deleteForm_{{ $value->id }}" action="{{ route('delete_category', ['id' => $value->id]) }}" method="POST">
                @csrf
                @method('DELETE')

                <a href="javascript:void(0);" onclick="deleteItem({{ $value->id }}, 'category');">
                    <i class="fas fa-trash-alt delete"></i>
                </a>
            </form>
        </div> --}}
    </td>
</tr>
@endforeach
