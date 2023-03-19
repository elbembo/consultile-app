    @if (isset($contacts))
        @foreach ($contacts as $contact)
            <tr class="{{ $contact->subscribe == 0 ? 'text-danger' : '' }}">
                <td class="text-center ">
                    <p class="text-xs font-weight-bold mb-0">{{ $contact->first_name }} {{ $contact->last_name }}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{ secret($contact->email) }}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{ secret($contact->personal_phone) }}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{ $contact->job_title }}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{ $contact->company }}</p>
                </td>

                <td class="text-center">
                    <a href="{{ url('contacts/' . $contact->id . '/edit') }}" class="mx-3" data-bs-toggle="tooltip"
                        data-bs-original-title="Edit user">
                        <i class="fas fa-user-edit text-secondary"></i>
                    </a>
                    <span>
                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
                    </span>
                </td>
            </tr>
        @endforeach
    @endif
