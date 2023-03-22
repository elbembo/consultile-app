@extends('layouts.user_type.auth')

@section('content')

<div>


    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Templates</h5>
                        </div>
                        <a href="{{url('email/templates/create')}}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Template</a>
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
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Type
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        role
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($emailTemplates))
                                @foreach($emailTemplates as $emailTemplate)
                                <tr>
                                    <td>
                                        <div>
                                            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center text-dark me-2 d-flex align-items-center justify-content-center">
                                                <i style="font-size: 1rem;" class="fas fa-lg fa-file-code top-0 text-center text-dark " aria-hidden="true"></i>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$emailTemplate->template_name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $emailTemplate->template_type }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $emailTemplate->template_type }}</p>
                                    </td>

                                    <td class="text-center">
                                        <a href="{{url('email/templates/'.$emailTemplate->id.'/edit')}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <form action="{{ url('email/templates/' . $emailTemplate->id) }}" method="post" style="display: inline;">
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
