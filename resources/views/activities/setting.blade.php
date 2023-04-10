@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card px-md-2 py-2">
                <div class="ms-auto my-auto">
                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addNewList"
                        class="btn bg-gradient-dark btn-sm mb-0 ">+&nbsp; New List</a>
                </div>
                <div class="modal fade" tabindex="-1" id="addNewList" aria-labelledby="addtolistLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="/settings/drop-list" method="post">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New List</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <div class="form-group col-md-6">
                                        <label for="alistItemName">Item Name</label>
                                        <input class="form-control" type="text" name="name" id="alistItemName"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="alistItemName">Section</label>
                                        <input class="form-control" type="text" name="section" id="alistItemName"
                                            required>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        @if (!empty($dropLists))
            @foreach ($dropLists as $key => $items)
                <div class="col-md-6">
                    <div class="card">

                        <div class="card-header pb-0">
                            <div class="d-lg-flex">

                                <div class="ms-auto my-auto mt-lg-0 mt-4">
                                    <div class="ms-auto my-auto">
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#{{ $key }}"
                                            class="btn bg-gradient-faded-light btn-sm mb-0 ">+&nbsp; {{ $key }}</a>
                                    </div>
                                    <div class="modal fade" tabindex="-1" id="{{ $key }}"
                                        aria-labelledby="addtolistLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="/settings/drop-list" method="post">
                                                    @csrf
                                                    <input type="hidden" name="section" value="{{ $key }}">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ $key }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body row">
                                                        <div class="form-group col-md-12">
                                                            <label for="listItemName">Item Name</label>
                                                            <input class="form-control" type="text" name="name"
                                                                id="listItemName" required>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <div
                                    class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                    <div class="dataTable-container">
                                        <table class="table table-flush dataTable-table" id="category-list">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th data-sortable="" style="width: 13.3407%;"><a href="#"
                                                            class="dataTable-sorter">NAME</a></th>
                                                    <th data-sortable="" style="width: 40.5733%;"><a href="#"
                                                            class="dataTable-sorter">VALUE</a></th>
                                                    <th data-sortable="" style="width: 14.0022%;"><a href="#"
                                                            class="dataTable-sorter">ACTION</a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items as $item)
                                                    <tr>
                                                        <td class="text-sm">{{ $item->name }}</td>
                                                        <td class="text-sm">{{ $item->value }}</td>
                                                        <td>
                                                            <div class="form-check form-switch ps-0">
                                                                <input data-id="{{ $item->id }}"
                                                                    data-section="{{ $key }}"
                                                                    class="form-check-input green ms-auto switchListItem"
                                                                    type="checkbox"
                                                                    {{ $item->show == 1 ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
@pushOnce('scripts')
    <script>
        $s('.switchListItem').click((e) => {
            const {
                id,
                section
            } = e.target.dataset
            post("/settings/drop-list/" + id, {
                show: e.target.checked == true ? 1 : 0
            }, 'PUT');
        })
    </script>
@endPushOnce
