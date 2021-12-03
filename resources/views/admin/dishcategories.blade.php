@extends('layouts.adminapp')
@section('contentadmin')
<h1>Categories </h1>

<form method="POST" action="{{ route('admin.categories.store') }}" class="pt-3">
        @csrf
        <div class="row g-3 align-items-center">
                <div class="col-auto ps-1 pe-1">
                        <input type="text" name="category_name" class="form-control" placeholder="Name of category">
                </div>
                <div class="col-auto ps-0 pe-1">
                        <button type="submit" class="btn site-btn site-border">Add</button>
                </div>
        </div>
</form>

<table class="table table-hover mt-5">
        <thead>
                <tr>
                        <th scope="col">#</th>
                        <th scope="col">Categoty name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Token</th>
                        <th scope="col">Actions</th>
                </tr>
        </thead>

        <tbody>
                @php
                $num = 1;
                @endphp

                @foreach ($categories as $category)
                <tr>
                        <th scope="row">{{ $num++ }}</th>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->category_slug }}</td>
                        <td>{{ $category->category_token }}</td>
                        <td>
                                <a href="" data-bs-toggle="modal"
                                        data-bs-target="#Modal{{ $category->category_token }}">
                                        <span class="badge bg-success">Edit</span>
                                </a>
                                <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#DeleteModal{{ $category->category_token }}"> 
                                        <span class="badge bg-danger">Delete</span>
                                </a>
                        </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="Modal{{ $category->category_token }}" tabindex="-1"
                        aria-labelledby="Modal{{ $category->category_token }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="Modal{{ $category->category_token }}Label">
                                                        Edit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                                <form method="POST"
                                                        action="{{ route('admin.categories.update', $category->cid) }}"
                                                        class="">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="row">
                                                                <div class="col-md-8 ps-1 pe-1">
                                                                        <input type="text" name="category_name"
                                                                                value="{{ $category->category_name }}"
                                                                                class="form-control"
                                                                                placeholder="Name of category">
                                                                </div>
                                                                <div class="col-md-4 d-grid ps-0 pe-1">
                                                                        <button type="submit"
                                                                                class="btn site-btn site-border">Save</button>
                                                                </div>
                                                        </div>
                                                </form>
                                        </div>
                                </div>
                        </div>
                </div>


                <!-- Delete Modal -->
                <div class="modal fade" id="DeleteModal{{ $category->category_token }}" tabindex="-1"
                        aria-labelledby="DeleteModal{{ $category->category_token }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                        <!-- <div class="modal-header">
                                                <h5 class="modal-title" id="DeleteModal{{ $category->category_token }}Label">
                                                        Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                        </div> -->
                                        <div class="modal-body">
                                                <h5 class="text-center">Are you sure you want to delete <b><i>{{ $category->category_name }}</i> </b> category?</h5>
                                                <form method="POST"
                                                        action="{{ route('admin.categories.destroy', $category->cid) }}"
                                                        class="">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="row">
                                                                <div class="col-md-6 d-grid ps-0 pe-1">
                                                                        <button type="submit"
                                                                                class="btn btn-danger">Yes</button>
                                                                </div>
                                                                <div class="col-md-6 d-grid ps-0 pe-1">
                                                                        <button type="button" data-bs-dismiss="modal"
                                                                                class="btn btn-success">No</button>
                                                                </div>
                                                        </div>
                                                </form>
                                        </div>
                                </div>
                        </div>
                </div>


                <!-- Delete Modal -->
                <div class="modal fade" id="Modal{{ $category->category_token }}" tabindex="-1"
                        aria-labelledby="Modal{{ $category->category_token }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="Modal{{ $category->category_token }}Label">
                                                        Edit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                                <form method="POST"
                                                        action="{{ route('admin.categories.update', $category->cid) }}"
                                                        class="">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="row">
                                                                <div class="col-md-8 ps-1 pe-1">
                                                                        <input type="text" name="category_name"
                                                                                value="{{ $category->category_name }}"
                                                                                class="form-control"
                                                                                placeholder="Name of category">
                                                                </div>
                                                                <div class="col-md-4 d-grid ps-0 pe-1">
                                                                        <button type="submit"
                                                                                class="btn site-btn site-border">Save</button>
                                                                </div>
                                                        </div>
                                                </form>
                                        </div>
                                </div>
                        </div>
                </div>

                @endforeach



        </tbody>
</table>


@endsection