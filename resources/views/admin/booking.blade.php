@extends('layouts.adminapp')
<title>Bookings - Delicious</title>

@section('contentadmin')
<h1>Booking</h1>

@if (session()->has('delete'))
<div class="alert alert-danger">
    {{ session()->get('delete') }}
</div>
@endif

@if (session()->has('satisfied'))
<div class="alert alert-success">
    {{ session()->get('satisfied') }}
</div>
@endif

@if (session()->has('unsatisfied'))
<div class="alert alert-warning">
    {{ session()->get('unsatisfied') }}
</div>
@endif
<table class="table table-hover mt-5 text-center">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Date & time</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($bookings as $booking)

        @if ($booking->satisfied == 0)
        <tr class="table-secondary" style="opacity: 0.4;">
            <td> {{ $booking->name }} </td>

            <td>
                <span class="badge bg-secondary"> {{ $booking->people_num }} people </span>
                <span class="badge bg-secondary"> {{ date('F d, Y', strtotime($booking->booking_date)) }}
                </span>
                <span class="badge bg-secondary"> {{ date('g:ia', strtotime($booking->booking_time)) }} </span>
            </td>

            <td>
                <a href="" data-bs-toggle="modal" data-bs-target="#Modal{{ $booking->booking_token }}">
                    <span class="badge bg-secondary">More...</span>
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $booking->booking_token }}">
                    <span class="badge bg-danger">Delete</span>
                </a>
                <a href="{{ route('admin.booking.attend', $booking->bid) }}">
                    <span class="badge bg-primary">Unsatisfy</span>
                </a>
            </td>
        </tr>
        @else
        <tr>
            <td> {{ $booking->name }} </td>

            <td>
                <span class="badge bg-primary"> {{ $booking->people_num }} people </span>
                <span class="badge bg-warning text-dark"> {{ date('F d, Y', strtotime($booking->booking_date)) }}
                </span>
                <span class="badge bg-info"> {{ date('g:ia', strtotime($booking->booking_time)) }} </span>
            </td>

            <td>
                <a href="" data-bs-toggle="modal" data-bs-target="#Modal{{ $booking->booking_token }}">
                    <span class="badge bg-success">More...</span>
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $booking->booking_token }}">
                    <span class="badge bg-danger">Delete</span>
                </a>
                <a href="{{ route('admin.booking.attend', $booking->bid) }}">
                    <span class="badge bg-primary">Satisfy</span>
                </a>
            </td>
        </tr>
        @endif


        <!-- More Modal -->
        <div class="modal fade" id="Modal{{ $booking->booking_token }}" tabindex="-1"
            aria-labelledby="Modal{{ $booking->booking_token }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Modal{{ $booking->booking_token }}Label">
                            More on <i> <b>{{ $booking->name }}'s</b> </i> booking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <span class="badge bg-primary"> {{ $booking->people_num }} people </span>
                            <span class="badge bg-warning text-dark"> {{ date('F d, Y',
                                strtotime($booking->booking_date)) }}
                            </span>
                            <span class="badge bg-info"> {{ date('g:ia', strtotime($booking->booking_time)) }} </span>
                        </div>
                        <br>
                        <span class="pt-1"> <b>Bookers message:</b>
                            {{ $booking->message }}
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="DeleteModal{{ $booking->booking_token }}" tabindex="-1"
            aria-labelledby="DeleteModal{{ $booking->booking_token }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5 class="text-center">Are you sure you want to delete <b><i>{{ $booking->name }}'s</i>
                            </b>
                            booking?</h5>
                        <form method="POST" action="{{ route('admin.booking.destroy', $booking->bid) }}" class="">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6 d-grid ps-0 pe-1">
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                </div>
                                <div class="col-md-6 d-grid ps-0 pe-1">
                                    <button type="button" data-bs-dismiss="modal" class="btn btn-success">No</button>
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