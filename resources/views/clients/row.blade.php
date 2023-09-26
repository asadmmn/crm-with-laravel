

@foreach ($data as $index => $item)


    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->business_name }} <br> <span>{{ $item->name }}</span> <br> <a href="mailto:{{ $item->email }}">{{ $item->email }}</a></td>
        <td>{{ $item->website }}</td>
        <td>{{ $item->service_pkj }}</td>
        <td>20 / 6</td>
        <td>26</td>
        <td>{{ $item->notes }}</td>
        <td style="display: flex; justify-content: center; position: relative;">

            <div class="btn-group btn-group-rounded">
                <button type="button" class="btn btn-default btn-xs row_drop_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius:3px; background: none; border: none; outline: none; text-align:center;">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a style="color: green; font-size: 15px; margin: 7px 10px 10px 0; cursor: pointer;" class="edit" data-action_type="edit" data-id="{{ $item->id }}">
                            <i class="fa-solid fa-pen"></i> Edit
                        </a>
                    </li>

                    <li>
                        <a style="color: red; font-size: 15px; margin: 7px 10px 7px 0; cursor: pointer; " class="delete" data-action_type="delete" data-id="{{ $item->id }}">
                            <i class="fa-solid fa-trash"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>
@endforeach

