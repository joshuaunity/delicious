@extends('layouts.adminapp')
<title>Sales - Delicious</title>

@section('contentadmin')
<h1> Sales </h1>

<table class="table table-hover mt-5 text-center    ">
        <thead>
                <tr>
                        <th scope="col">#</th>
                        <th scope="col">Dish name</th>
                        <th scope="col">Dish category</th>
                        <th scope="col">Dish price</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Date&Time</th>
                        <th scope="col">Actions</th>
                </tr>
        </thead>

        <tbody>
                @php
                $num = 1;
                @endphp

                @foreach ($sales as $sale)
                <tr>
                        <th scope="row">{{ $num++ }}</th>

                        <td>{{ $dishes->where('did', $sale->did)->pluck('dish_name')[0];      }}</td>
                        <td>{{ $dish_categories->where('cid', $sale->cid)->pluck('category_name')[0]; }}</td>
                        <td>${{ $dishes->where('did', $sale->did)->pluck('dish_price')[0]; }}</td>
                        <td>{{ $sale->gender }}</td>
                        <td>{{ date('F d, Y', strtotime($sale->created_at)) }} {{ date('g:ia', strtotime($sale->created_at)) }}</td>
                        <td>
                                <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#DeleteModal{{ $sale->sale_token }}"> 
                                        <span class="badge bg-danger">Revoke</span>
                                </a>
                        </td>
                </tr>

                <!-- Delete Modal -->
                <div class="modal fade" id="DeleteModal{{ $sale->sale_token }}" tabindex="-1"
                        aria-labelledby="DeleteModal{{ $sale->sale_token }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                        <div class="modal-body">
                                                <h5 class="text-center">Are you sure you want to revoke this sale?</h5>
                                                <form method="POST"
                                                        action="{{ route('admin.sales.destroy', $sale->sid) }}"
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

                @endforeach



        </tbody>
</table>
@endsection