@extends('layouts.adminapp')
<title>Bookings - Delicious</title>

@section('contentadmin')
<h1>Booking</h1>

@if (session()->has('delete'))
<div class="alert alert-danger">
    {{ session()->get('delete') }}
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
            </td>
        </tr>

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