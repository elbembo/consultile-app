@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Top Selling Products</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product
                                    </th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Refunds</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($requests))
                                    @foreach ($requests as $request)
                                        @php
                                            $payload = $request->payload;
                                            $approved = $request->approved == 0 ? false : true;
                                        @endphp
                                        <tr>
                                            <td>
                                                <a class="d-flex px-3 py-1" data-bs-toggle="collapse"
                                                    href="#request{{ $request->id }}" role="button" aria-expanded="false"
                                                    aria-controls="request{{ $request->id }}">
                                                    <div>
                                                        <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/blue-shoe.jpg"
                                                            class="avatar me-3" alt="image">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $payload['emp_name'] }}</h6>
                                                        <p class="text-sm font-weight-bold text-secondary mb-0">
                                                            {{ $payload['added_time'] }}</p>
                                                    </div>
                                                    <div class="w-100">
                                                        <h6
                                                            class="d-flex mb-0 text-sm align-items-end  justify-content-end ">
                                                            {{ $payload['acoount_id'] }}</h6>


                                                    </div>
                                                </a>
                                                <div class="collapse " id="request{{ $request->id }}">
                                                    <div class="card card-body text-wrap">

                                                        <form method="POST" >
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6 d-flex flex-column">
                                                                    {!! Form::label('fname' . $request->id, 'First Name', []) !!}
                                                                    {!! Form::text('first_name', $payload['client_fname'], ['required','readonly'=>$approved,'class'=>'form-control', 'id' => 'fname' . $request->id]) !!}
                                                                    {!! Form::label('lname' . $request->id, 'First Name', []) !!}
                                                                    {!! Form::text('last_name', $payload['client_lname'], ['required','readonly'=>$approved,'class'=>'form-control', 'id' => 'lname' . $request->id]) !!}
                                                                    {!! Form::label('email' . $request->id, 'Email', []) !!}
                                                                    {!! Form::text('email', $payload['client_email'], ['required','readonly'=>$approved,'class'=>'form-control', 'id' => 'email' . $request->id]) !!}
                                                                    {!! Form::label('phone' . $request->id, 'Phone', []) !!}
                                                                    {!! Form::text('personal_phone', $payload['client_phone'], ['required','readonly'=>$approved,'class'=>'form-control', 'id' => 'phone' . $request->id]) !!}
                                                                    {!! Form::label('company' . $request->id, 'Company', []) !!}
                                                                    {!! Form::text('company', $payload['client_company'], ['required','readonly'=>$approved,'class'=>'form-control', 'id' => 'company' . $request->id]) !!}
                                                                    {!! Form::label('job' . $request->id, 'Job', []) !!}
                                                                    {!! Form::text('job_title', $payload['client_job_title'], ['required','readonly'=>$approved,'class'=>'form-control', 'id' => 'job' . $request->id]) !!}
                                                                    {!! Form::label('country' . $request->id, 'Country', []) !!}
                                                                    {!! Form::text('country', $payload['country'], ['required','readonly'=>$approved,'class'=>'form-control', 'id' => 'country' . $request->id]) !!}
                                                                    {!! Form::hidden('source', $payload['source']) !!}
                                                                    {!! Form::hidden('call_id', $request->id) !!}
                                                                    {{ $approved == 0 ? Form::submit('Approve', ["class"=>"btn bg-gradient-dark btn-sm float-end mt-6 mb-0"]) : "" }}
                                                                </div>
                                                                <div class="col-6">
                                                                    <div><strong>Account:
                                                                        </strong>{{ $payload['acoount_id'] }}</div>
                                                                    <div><strong>Emp: </strong>{{ $payload['emp_name'] }}
                                                                    </div>
                                                                    <div><strong>Date: </strong>{{ $payload['added_time'] }}
                                                                    </div>
                                                                    <div><strong>Source: </strong>{{ $payload['source'] }}
                                                                    </div>
                                                                    <div><strong>Client Linkedin: </strong><a
                                                                            target="_blank"
                                                                            href="{{ $payload['linkedin_profile'] }}">{{ $payload['linkedin_profile'] }}</a>
                                                                    </div>
                                                                    <div><strong>Client status: </strong>{{ $payload['status'] }}</div>
                                                                    <div><strong>Client message: </strong>
                                                                        <p>{{ $payload['client_message'] }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="align-middle text-end">
                                                <div class="d-flex px-3 py-1 justify-content-center align-items-center">

                                                    <button type="button"
                                                        class="btn btn-sm btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-3"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                                        data-bs-original-title="Refund rate is lower with 97% than other products">
                                                        <i class="fas fa-info" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="d-flex justify-content-center">{{ $requests->links() }}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
