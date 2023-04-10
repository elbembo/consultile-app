<div class="fixed-plugin">
    {{-- <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a> --}}
    <div class="card shadow-lg ">
        <div class="card-header pb-0 pt-3 ">
            <div class="{{ Request::is('rtl') ? 'float-end' : 'float-start' }}">
                <h5 class="mt-3 mb-0">Fillter</h5>
                <p>fillter the output data</p>
            </div>
            <div class="{{ Request::is('rtl') ? 'float-start mt-4' : 'float-end mt-4' }}">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <form  autocomplete="off">
                {{-- @csrf --}}
                <div class="row">
                    <div>
                        <h6 class="my-2">Employers</h6>
                    </div>
                    @if (!empty($empList))
                        @foreach ($empList as $item)
                            <div class="d-flex align-items-center">
                                <div class="form-check">
                                    <input  name="users[]" class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                        id="user{{ $item->id }}" {{ old('users[]') ==  $item->id  ? 'checked' : '' }}>
                                </div>
                                <label for="user{{ $item->id }}"
                                    class="mb-0 text-dark font-weight-bold text-sm">{{ $item->name }}</label>
                            </div>
                        @endforeach
                    @endif
                    <div>
                        <h6 class="my-2">Linkedin account</h6>
                    </div>
                    @if (!empty($accountsList))
                        @foreach ($accountsList as $item)
                            <div class="d-flex align-items-center">
                                <div class="form-check">
                                    <input  name="accounts[]" class="form-check-input" type="checkbox" value="{{ $item->value }}"
                                        id="{{ $item->value }}" {{ old('accounts[]') ==  $item->value  ? 'checked' : '' }}>
                                </div>
                                <label for="{{ $item->value }}"
                                    class="mb-0 text-dark font-weight-bold text-sm">{{ $item->name }}</label>
                            </div>
                        @endforeach
                    @endif
                    <div>
                        <h6 class="my-2">Action taken</h6>
                    </div>
                    @if (!empty($actionList))
                        @foreach ($actionList as $item)
                            <div class="d-flex align-items-center">
                                <div class="form-check">
                                    <input  name="actions[]" class="form-check-input" type="checkbox" value="{{ $item->value }}"
                                        id="{{ $item->value }}">
                                </div>
                                <label for="{{ $item->value }}"
                                    class="mb-0 text-dark font-weight-bold text-sm">{{ $item->name }}</label>
                            </div>
                        @endforeach
                    @endif
                    <div>
                        <h6 class="my-2">Message</h6>
                    </div>
                    @if (!empty($messageList))
                        @foreach ($messageList as $item)
                            <div class="d-flex align-items-center">
                                <div class="form-check">
                                    <input name="messages[]" class="form-check-input" type="checkbox" value="{{ $item->value }}"
                                        id="{{ $item->value }}">
                                </div>
                                <label for="{{ $item->value }}"
                                    class="mb-0 text-dark font-weight-bold text-sm">{{ $item->name }}</label>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="d-flex justify-content-around">
                    <button id="activity-submit" type="submit"
                        class="btn bg-gradient-dark btn-md mt-4 mb-4">Apply</button>
                </div>
            </form>

            <hr class="horizontal dark my-sm-4">

        </div>
    </div>
</div>
</div>
