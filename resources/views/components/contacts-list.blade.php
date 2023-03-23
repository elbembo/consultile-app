    @if (isset($contacts))
        @foreach ($contacts as $contact)
            <tr class="{{ ($contact->subscribe == 0) ? 'bg-gradient-danger text-white' : '' }}">
                <td class="text-center ">
                    <i class="fa fa-solid fa-star text-xs {{ (isset($views[$contact->id]) &&  $views[$contact->id] > 0  ) ? ' text-warning':' text-lighter' }}"></i>
                </td>
                <td class="text-center ">
                    <a class="" href="{{ url('contacts/' . $contact->id) }}">
                        <p class="text-xs font-weight-bold mb-0 ">{{ $contact->first_name }} {{ $contact->last_name }}</p>
                    </a>
                </td>
                <td class="text-center">

                    <a  class="" href="{{ url('contacts/' . $contact->id) }}">
                        <p class="text-xs font-weight-bold mb-0">{{ secret($contact->email) }}</p>
                    </a>
                </td>
                <td class="text-center ">
                    <a class=""  href="{{ url('contacts/' . $contact->id) }}">
                        <p class="text-xs font-weight-bold mb-0">{{ secret($contact->personal_phone) }}</p>
                    </a>
                </td>
                <td class="text-center">
                    <a  class="" href="{{ url('contacts/' . $contact->id) }}">
                        <p class="text-xs font-weight-bold mb-0">{{ $contact->job_title }}</p>
                    </a>
                </td>
                <td class="text-center">
                    <a  class="" href="{{ url('contacts/' . $contact->id) }}">
                        <p class="text-xs font-weight-bold mb-0">{{ $contact->company }}</p>
                    </a>
                </td>


                <td class="text-center">

                    <a href="{{ url('contacts/' . $contact->id . '/edit') }}" class="mx-3" data-bs-toggle="tooltip"
                        data-bs-original-title="Edit user">
                        <i class="fas fa-user-edit text-secondary"></i>
                    </a>
                    <form action="{{ url('contacts/' . $contact->id) }}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-clear">
                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                        </button>
                    </form>


                </td>
            </tr>
        @endforeach
    @endif
