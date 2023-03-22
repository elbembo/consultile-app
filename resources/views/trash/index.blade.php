@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Trashed Contacts</h5>
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
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="result">
                                @if (isset($contacts))
                                    @foreach ($contacts as $contact)
                                        <tr class="{{ $contact->subscribe == 0 ? 'bg-gradient-danger text-white' : '' }}">

                                            <td class="text-center ">
                                                <a class="" href="{{ url('contacts/' . $contact->id) }}">
                                                    <p class="text-xs font-weight-bold mb-0 ">{{ $contact->first_name }}
                                                        {{ $contact->last_name }}</p>
                                                </a>
                                            </td>
                                            <td class="text-center">

                                                <a class="" href="{{ url('contacts/' . $contact->id) }}">
                                                    <p class="text-xs font-weight-bold mb-0">{{ secret($contact->email) }}
                                                    </p>
                                                </a>
                                            </td>
                                            <td class="text-center ">
                                                <a class="" href="{{ url('contacts/' . $contact->id) }}">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ secret($contact->personal_phone) }}</p>
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

                                                <form action="{{ url('contacts/' . $contact->id) }}" method="post"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="restore" value="restore">
                                                    <button type="submit" class="btn-clear">
                                                        <i class="cursor-pointer fas fa-undo  text-secondary"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ url('contacts/' . $contact->id) }}" method="post"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="delete" value="delete">
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
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Trashed Campaigns</h5>
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
                                        Name
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Subject
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Details
                                    </th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="result">
                                @if (isset($campaigns))
                                    @foreach ($campaigns as $campaign)
                                        <tr
                                            class="{{ $campaign->subscribe == 0 ? 'bg-gradient-danger text-white' : '' }}">

                                            <td class="text-center ">
                                                <a class="" href="{{ url('campaigns/' . $campaign->id) }}">
                                                    <p class="text-xs font-weight-bold mb-0 ">{{ $campaign->name }}</p>
                                                </a>
                                            </td>
                                            <td class="text-center">

                                                <a class="" href="{{ url('campaigns/' . $campaign->id) }}">
                                                    <p class="text-xs font-weight-bold mb-0">{{ secret($campaign->subject) }}
                                                    </p>
                                                </a>
                                            </td>
                                            <td class="text-center ">
                                                <a class="" href="{{ url('campaigns/' . $campaign->id) }}">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ secret($campaign->status) }}</p>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a class="" href="{{ url('campaigns/' . $campaign->id) }}">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $campaign->details }}</p>
                                                </a>
                                            </td>


                                            <td class="text-center">

                                                <form action="{{ url('campaigns/' . $campaign->id) }}" method="post"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="restore" value="restore">
                                                    <button type="submit" class="btn-clear">
                                                        <i class="cursor-pointer fas fa-undo  text-secondary"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ url('campaigns/' . $campaign->id) }}" method="post"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="delete" value="delete">
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
                        <div class="d-flex justify-content-center">{{ $campaigns->links() ?? '' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Trashed Email Templates</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Type
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        role
                                    </th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($emailTemplates))
                                    @foreach ($emailTemplates as $emailTemplate)
                                        <tr>
                                            <td>
                                                <div>
                                                    <div
                                                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center text-dark me-2 d-flex align-items-center justify-content-center">
                                                        <i style="font-size: 1rem;"
                                                            class="fas fa-lg fa-file-code top-0 text-center text-dark "
                                                            aria-hidden="true"></i>
                                                    </div>

                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $emailTemplate->template_name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $emailTemplate->template_type }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $emailTemplate->template_type }}</p>
                                            </td>

                                            <td class="text-center">
                                                <form action="{{ url('email/templates/' . $emailTemplate->id) }}"
                                                    method="post" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="restore" value="restore">
                                                    <button type="submit" class="btn-clear">
                                                        <i class="cursor-pointer fas fa-undo  text-secondary"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ url('email/templates/' . $emailTemplate->id) }}"
                                                    method="post" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="delete" value="delete">
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
                </div>
            </div>
        </div>
    </div>
@endsection
