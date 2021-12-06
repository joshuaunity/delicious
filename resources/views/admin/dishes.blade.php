@extends('layouts.adminapp')
@section('contentadmin')

<div class="col-md-12">

    <h1>Create dishes <a href="#" data-bs-toggle="modal" data-bs-target="#createDish"> <i class="bi bi-plus-lg"></i>
        </a> </h1>
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="createDish" tabindex="-1" aria-labelledby="createDishLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDishLabel">Add dish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.dishes.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Dish name</label>
                            <input type="text" name="dish_name"
                                class="form-control @error('dish_name') is-invalid @enderror">
                        </div>

                        @error('dish_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label">Dish price</label>
                            <input type="text" name="dish_price"
                                class="form-control @error('dish_price') is-invalid @enderror">
                        </div>

                        @error('dish_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="disabledSelect" class="form-label">Dish category</label>
                            <select name="dish_category"
                                class="form-select @error('dish_category') is-invalid @enderror">
                                @foreach ($dishcategories as $category)
                                <option> {{ $category->category_name }} </option>
                                @endforeach
                            </select>
                        </div>

                        @error('dish_category')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label">Dish description</label>
                            <textarea name="dish_description"
                                class="form-control @error('dish_description') is-invalid @enderror"></textarea>
                        </div>

                        @error('dish_description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn site-btn site-border">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-4">

        @if (count($dishes) == 0)
        <div class="col-md-9 text-center">
            <div class="alert site-border" role="alert" style="background-color: #ffd18e;">
                There are no dishes!
            </div>
        </div>
        @else

        @if (session()->has('delete'))
        <div class="alert alert-danger">
            {{ session()->get('delete') }}
        </div>
        @endif

        @if (session()->has('editsuccess'))
        <div class="alert alert-success">
            {{ session()->get('editsuccess') }}
        </div>
        @endif

        <div class="col-md-9 mb-2">
            <div class="accordion" id="accordionExample">
                @foreach ($dishes as $dish)
                <div class="accordion-item site-border">

                    <h2 class="accordion-header site-border" id="heading{{ $dish->dish_token }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $dish->dish_token }}" aria-expanded="false"
                            aria-controls="collapse{{ $dish->dish_token }}">
                            {{ $dish->dish_name }}
                        </button>
                    </h2>

                    <div id="collapse{{ $dish->dish_token }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $dish->dish_token }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            {{-- Edit url --}}
                            <a href="" data-bs-toggle="modal" data-bs-target="#Modal{{ $dish->dish_token }}">
                                <span class="badge bg-success">Edit</span>
                            </a>

                            {{-- Delete url --}}
                            <a href="#" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $dish->dish_token }}">
                                <span class="badge bg-danger">Delete</span>
                            </a>

                            <br>

                            <strong>Dish price:</strong> ${{ $dish->dish_price }} <br>
                            <strong>Dish description:</strong> {{ $dish->dish_description }}
                        </div>
                    </div>
                </div>


                <!-- Edit Modal -->
                <div class="modal fade" id="Modal{{ $dish->dish_token }}" tabindex="-1"
                    aria-labelledby="Modal{{ $dish->dish_token }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="Modal{{ $dish->dish_token }}Label">
                                    Edit <b> {{ $dish->dish_name }} </b> dish</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('admin.dishes.update', $dish->did) }}" class="">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Dish name</label>
                                        <input type="text" name="dish_name" value="{{ $dish->dish_name }}"
                                            class="form-control @error('dish_name') is-invalid @enderror">
                                    </div>

                                    @error('dish_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-3">
                                        <label class="form-label">Dish price</label>
                                        <input type="text" name="dish_price" value="{{ $dish->dish_price }}"
                                            class="form-control @error('dish_price') is-invalid @enderror">
                                    </div>

                                    @error('dish_price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-3">
                                        <label for="disabledSelect" class="form-label">Dish category</label>
                                        <select name="dish_category"
                                            class="form-select @error('dish_category') is-invalid @enderror">
                                            <option> {{ $dish->dish_category }} </option>
                                            @foreach ($dishcategories as $category)
                                            <option> {{ $category->category_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error('dish_category')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-3">
                                        <label class="form-label">Dish description</label>
                                        <textarea name="dish_description"
                                            class="form-control @error('dish_description') is-invalid @enderror">
                                            {{ $dish->dish_description }}
                                        </textarea>
                                    </div>

                                    @error('dish_description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <button type="submit" class="btn site-btn site-border">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Delete Modal -->
                <div class="modal fade" id="DeleteModal{{ $dish->dish_token }}" tabindex="-1"
                    aria-labelledby="DeleteModal{{ $dish->dish_token }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content">

                            <div class="modal-body">
                                <h5 class="text-center">Are you sure you want to delete <b><i>{{
                                            $dish->dish_name }}</i> </b>
                                    dish?</h5>
                                <form method="POST" action="{{ route('admin.dishes.destroy', $dish->did) }}" class="">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 d-grid ps-0 pe-1">
                                            <button type="submit" class="btn btn-danger">Yes</button>
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
            </div>
        </div>
        @endif



        <div class="col-md-3">
            <div class="site-border border">
                jckndfk
            </div>
        </div>

    </div>


</div>

@endsection