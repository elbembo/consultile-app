@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">All Categories</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-new-category"
                                    class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Category</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">

                            <div class="dataTable-container">
                                <table class="table table-flush dataTable-table" id="category-list">
                                    <thead class="thead-light">
                                        <tr>
                                            <th data-sortable="" style="width: 7.828%;"><a href="#"
                                                    class="dataTable-sorter">ID</a></th>
                                            <th data-sortable="" style="width: 13.3407%;"><a href="#"
                                                    class="dataTable-sorter">NAME</a></th>
                                            <th data-sortable="" style="width: 40.5733%;"><a href="#"
                                                    class="dataTable-sorter">DESCRIPTION</a></th>
                                            <th data-sortable="" style="width: 24.2558%;"><a href="#"
                                                    class="dataTable-sorter">CREATION DATE</a></th>
                                            <th data-sortable="" style="width: 14.0022%;"><a href="#"
                                                    class="dataTable-sorter">ACTION</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-sm">1</td>
                                            <td class="text-sm">Food</td>
                                            <td class="text-sm">Find our recipies</td>
                                            <td class="text-sm">2023-04-03 00:00:13</td>
                                            <td class="text-sm">
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-edit-categories/1"
                                                    class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit category">
                                                    <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-delete-category/1"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete category">
                                                    <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">2</td>
                                            <td class="text-sm">Home</td>
                                            <td class="text-sm">Find the latest trends in interior desgin</td>
                                            <td class="text-sm">2023-04-03 00:00:13</td>
                                            <td class="text-sm">
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-edit-categories/2"
                                                    class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit category">
                                                    <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-delete-category/2"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete category">
                                                    <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">3</td>
                                            <td class="text-sm">Fashion</td>
                                            <td class="text-sm">Find the latest trends</td>
                                            <td class="text-sm">2023-04-03 00:00:13</td>
                                            <td class="text-sm">
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-edit-categories/3"
                                                    class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit category">
                                                    <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-delete-category/3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete category">
                                                    <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="dataTable-bottom">
                                <div class="dataTable-info">Showing 1 to 3 of 3 entries</div>
                                <nav class="dataTable-pagination">
                                    <ul class="dataTable-pagination-list"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">All Categories</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-new-category"
                                    class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Category</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">

                            <div class="dataTable-container">
                                <table class="table table-flush dataTable-table" id="category-list">
                                    <thead class="thead-light">
                                        <tr>
                                            <th data-sortable="" style="width: 7.828%;"><a href="#"
                                                    class="dataTable-sorter">ID</a></th>
                                            <th data-sortable="" style="width: 13.3407%;"><a href="#"
                                                    class="dataTable-sorter">NAME</a></th>
                                            <th data-sortable="" style="width: 40.5733%;"><a href="#"
                                                    class="dataTable-sorter">DESCRIPTION</a></th>
                                            <th data-sortable="" style="width: 24.2558%;"><a href="#"
                                                    class="dataTable-sorter">CREATION DATE</a></th>
                                            <th data-sortable="" style="width: 14.0022%;"><a href="#"
                                                    class="dataTable-sorter">ACTION</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-sm">1</td>
                                            <td class="text-sm">Food</td>
                                            <td class="text-sm">Find our recipies</td>
                                            <td class="text-sm">2023-04-03 00:00:13</td>
                                            <td class="text-sm">
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-edit-categories/1"
                                                    class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit category">
                                                    <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-delete-category/1"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete category">
                                                    <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">2</td>
                                            <td class="text-sm">Home</td>
                                            <td class="text-sm">Find the latest trends in interior desgin</td>
                                            <td class="text-sm">2023-04-03 00:00:13</td>
                                            <td class="text-sm">
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-edit-categories/2"
                                                    class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit category">
                                                    <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-delete-category/2"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete category">
                                                    <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">3</td>
                                            <td class="text-sm">Fashion</td>
                                            <td class="text-sm">Find the latest trends</td>
                                            <td class="text-sm">2023-04-03 00:00:13</td>
                                            <td class="text-sm">
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-edit-categories/3"
                                                    class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit category">
                                                    <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-delete-category/3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete category">
                                                    <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="dataTable-bottom">
                                <div class="dataTable-info">Showing 1 to 3 of 3 entries</div>
                                <nav class="dataTable-pagination">
                                    <ul class="dataTable-pagination-list"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">All Categories</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-new-category"
                                    class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Category</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">

                            <div class="dataTable-container">
                                <table class="table table-flush dataTable-table" id="category-list">
                                    <thead class="thead-light">
                                        <tr>
                                            <th data-sortable="" style="width: 7.828%;"><a href="#"
                                                    class="dataTable-sorter">ID</a></th>
                                            <th data-sortable="" style="width: 13.3407%;"><a href="#"
                                                    class="dataTable-sorter">NAME</a></th>
                                            <th data-sortable="" style="width: 40.5733%;"><a href="#"
                                                    class="dataTable-sorter">DESCRIPTION</a></th>
                                            <th data-sortable="" style="width: 24.2558%;"><a href="#"
                                                    class="dataTable-sorter">CREATION DATE</a></th>
                                            <th data-sortable="" style="width: 14.0022%;"><a href="#"
                                                    class="dataTable-sorter">ACTION</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-sm">1</td>
                                            <td class="text-sm">Food</td>
                                            <td class="text-sm">Find our recipies</td>
                                            <td class="text-sm">2023-04-03 00:00:13</td>
                                            <td class="text-sm">
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-edit-categories/1"
                                                    class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit category">
                                                    <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-delete-category/1"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete category">
                                                    <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">2</td>
                                            <td class="text-sm">Home</td>
                                            <td class="text-sm">Find the latest trends in interior desgin</td>
                                            <td class="text-sm">2023-04-03 00:00:13</td>
                                            <td class="text-sm">
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-edit-categories/2"
                                                    class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit category">
                                                    <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-delete-category/2"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete category">
                                                    <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">3</td>
                                            <td class="text-sm">Fashion</td>
                                            <td class="text-sm">Find the latest trends</td>
                                            <td class="text-sm">2023-04-03 00:00:13</td>
                                            <td class="text-sm">
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-edit-categories/3"
                                                    class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit category">
                                                    <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="https://soft-ui-dashboard-pro-laravel.creative-tim.com/laravel-delete-category/3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete category">
                                                    <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="dataTable-bottom">
                                <div class="dataTable-info">Showing 1 to 3 of 3 entries</div>
                                <nav class="dataTable-pagination">
                                    <ul class="dataTable-pagination-list"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
