@extends('layouts.adminapp')
@section('contentadmin')

<div class="col-md-12">

    <h1>Create dishes <a href="#" data-bs-toggle="modal" data-bs-target="#createDish"> <i class="bi bi-plus-lg"></i> </a> </h1>
    @if(session()->has('success'))
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
                            <input type="text" name="dish_name" class="form-control @error('dish_name') is-invalid @enderror">
                        </div>

                        @error('dish_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label">Dish price</label>
                            <input type="text" name="dish_price" class="form-control @error('dish_price') is-invalid @enderror">
                        </div>

                        @error('dish_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        
                        <div class="mb-3">
                            <label class="form-label">Dish description</label>
                            <textarea name="dish_description" class="form-control @error('dish_description') is-invalid @enderror"></textarea>
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
            <div class="site-border col-md-9">
                <span>There are no dishes.</span>
            </div>
        @else
            @foreach ($dishes as $dish)
                <div class="col-md-9 mb-2">
                    {{-- <div class="site-border border">
                        <div class="modal-header border-0 p-2">
                            <h5 class="modal-title" id="createDishLabel">{{ $dish->dish_name }}</h5>
                            <a href=""> <i class="bi bi-trash text-danger"></i> </a>
                        </div>
                    </div> --}}


                    <div class="accordion" id="accordionExample{{ $dish->id }}">

                        <div class="accordion-item site-border">
                        <h2 class="accordion-header site-border" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                {{ $dish->dish_name }}
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample{{ $dish->id }}">
                            <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif

        

        <div class="col-md-3">
            <div class="site-border border">
                jckndfk
            </div>
        </div>

    </div>


</div>

@endsection