    @if (isset($contacts))
        @foreach ($contacts as $contact)
            <tr class="{{ $contact->subscribe == 0 ? 'bg-gradient-danger text-white' : '' }}">
                <td class="text-center ">
                    <i
                        class="fa fa-solid  text-xs {{ isset($views[$contact->id]) && $views[$contact->id] > 0 ? ' fa-eye  text-success' : '  text-black-50' }}"></i>
                </td>
                <td class=" ">
                    <a class="" href="{{ url('contacts/' . $contact->id) }}">
                        <p class="text-xs font-weight-bold mb-0 ">{{ $contact->first_name }} {{ $contact->last_name }}
                        </p>
                    </a>
                </td>
                <td class="text-center">

                    <a class="" href="{{ url('contacts/' . $contact->id) }}">
                        <p class="text-xs font-weight-bold mb-0">{{ secret($contact->email) }}</p>
                    </a>
                </td>
                <td class="text-center ">
                    <a class="" href="{{ url('contacts/' . $contact->id) }}">
                        <p class="text-xs font-weight-bold mb-0">{{ secret($contact->personal_phone) }}</p>
                    </a>
                </td>
                <td class="text-center">
                    <a class="" href="{{ url('contacts/' . $contact->id) }}">
                        <p class="text-xs font-weight-bold mb-0">{{ $contact->job_title }}</p>
                    </a>
                </td>
                <td class="text-center">
                    <a class="" href="{{ url('contacts/' . $contact->id) }}">
                        <p class="text-xs font-weight-bold mb-0">{{ $contact->company }}</p>
                    </a>
                </td>
                <td class="text-center">
                    <a class="" href="{{ url('contacts/' . $contact->id) }}">
                        <p class="text-xs font-weight-bold mb-0">{{ $contact->country }}</p>
                    </a>
                </td>


                <td class="text-center">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addtag{{ $contact->id }}"
                        class="mx-2" data-bs-toggle="modal" title="Add note">
                        <i
                            class="fas fa-plus {{ count($contact->notes) > 0 ? 'text-warning' : 'text-secondary' }}"></i>
                    </a>
                    <!-- Modal -->
                    <div class="modal fade " id="addtag{{ $contact->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Tags</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form data-action="/contacts/{{ $contact->id }}/tag" method="post" class="ajaxForm">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <input type="text" value="{{ $contact->tags }}" name="tags" data-role="tagsinput"  />
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addnote{{ $contact->id }}"
                        class="mx-2" data-bs-toggle="modal" title="Add note">
                        <i
                            class="fas fa-sticky-note {{ count($contact->notes) > 0 ? 'text-warning' : 'text-secondary' }}"></i>
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="addnote{{ $contact->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add note
                                        on</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/contacts/{{ $contact->id }}/note" method="post">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="note" id="addNote" rows="5"></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
    
