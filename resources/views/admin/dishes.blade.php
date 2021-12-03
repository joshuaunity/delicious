@extends('layouts.adminapp')
@section('contentadmin')

    <div class="col-md-12">

        <h1>Create dishes <a href="#" data-bs-toggle="modal" data-bs-target="#createDish"> <i class="bi bi-plus-lg"></i> </a> </h1>
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
                        <h5 class="modal-title" id="createDishLabel">Modal title</h5>
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
                                <select name="dish_category" class="form-select @error('dish_category') is-invalid @enderror">
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

                            <button type="submit" class="btn btn-primary">Create</button>
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
                                        <span class="badge bg-success">Edit</span> <span
                                            class="badge bg-danger">Delete</span>
                                        <strong>Dish price:</strong> ${{ $dish->dish_price }} <br>
                                        <strong>Dish description:</strong> {{ $dish->dish_description }}
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
