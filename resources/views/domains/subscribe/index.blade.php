@extends('layouts.user_type.auth')

@section('content')

    <div>


        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Subscriber</h5>
                            </div>
                            <div class="d-flex flex-row justify-content-end">


                                <a href="{{ url('subscribes/export') }}"
                                    class="btn bg-gray-50 btn-sm m-1">{{ __('Export') }}</a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">

                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Phone
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            job title
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Company
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Signup date
                                        </th>

                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="result">
                                    @if (isset($contacts))
                                        @foreach ($contacts as $contact)
                                            <tr
                                                class="{{ $contact->subscribe == 0 ? 'bg-gradient-danger text-white' : '' }}">
                                                <td class="text-center ">
                                                    <i
                                                        class="fa fa-solid  text-xs {{ isset($views[$contact->id]) && $views[$contact->id] > 0 ? ' fa-eye  text-success' : '  text-black-50' }}"></i>
                                                </td>
                                                <td class=" ">
                                                    <a class="" href="{{ url('contacts/' . $contact->id) }}">
                                                        <p class="text-xs font-weight-bold mb-0 ">{{ $contact->first_name }}
                                                            {{ $contact->last_name }}</p>
                                                    </a>
                                                </td>
                                                <td class="text-center">

                                                    <a class="" href="mailto:{{ $contact->email }}">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $contact->email }}</p>
                                                    </a>
                                                </td>
                                                <td class="text-center ">
                                                    <a class="" href="tel:{{ $contact->personal_phone }}">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $contact->personal_phone }}</p>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a class="" href="{{ url('contacts/' . $contact->id) }}">
                                                        <p class="text-xs font-weight-bold mb-0">{{ $contact->job_title }}
                                                        </p>
                                                    </a>
                                                </td>

                                                <td class="text-center">
                                                    <a class="" href="{{ url('contacts/' . $contact->id) }}">
                                                        <p class="text-xs font-weight-bold mb-0">{{ $contact->company }}
                                                        </p>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a class="" href="{{ url('contacts/' . $contact->id) }}">
                                                        <p class="text-xs font-weight-bold mb-0">{{ $contact->created_at }}
                                                        </p>
                                                    </a>
                                                </td>

                                                <td class="text-center">

                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#snote{{ $contact->id }}" class="mx-2"
                                                        data-bs-toggle="modal" title="Add note">
                                                        <i
                                                            class="fas fa-sticky-note  {{ count($contact->notes) > 0 ? 'text-warning' : 'text-secondary' }}"></i>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="snote{{ $contact->id }}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">

                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Add note
                                                                        on</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="/contacts/{{ $contact->id }}/note"
                                                                    method="post">
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
                                                    <a href="{{ url('contacts/' . $contact->id . '/edit') }}"
                                                        class="mx-2" data-bs-toggle="tooltip" title="Edit user">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                    </a>
                                                    <form action="{{ url('contacts/' . $contact->id) }}" method="post"
                                                        style="display: inline;">
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

                                </tbody>
                            </table>

                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center">{{ $contacts->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
