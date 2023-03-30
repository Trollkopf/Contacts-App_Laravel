@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="text-success">Contact Information:</h3>
          </div>

          <div class="card-body">
            <div class="d-flex justify-content-center mb-4">
              <img src="{{ Storage::url($contact->profile_picture) }}" style="width:10rem">
            </div>
            <table class="table table-hover">
              <tr>
                <td>Name:</td>
                <td>{{ $contact->name }}</td>
              </tr>
              <tr>
                <td>Email: </td>
                <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
              </tr>
              <tr>
                <td>Age: </td>
                <td>{{ $contact->age }}</td>

              </tr>
              <tr>
                <td>Phone Number: </td>
                <td><a href="tel:{{ $contact->phone_number }}"> {{ $contact->phone_number }}</a></td>

              </tr>
              <tr>
                <td>Created at: </td>
                <td>{{ $contact->created_at }}</td>
              </tr>
              <tr>
                <td>Last Update: </td>
                <td>{{ $contact->updated_at }}</td>
              </tr>
            </table>

            <div class="d-flex justify-content-end">
              <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-secondary mb-2  me-2"><x-icon icon="pencil"/></a>
              <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mb-2"><x-icon icon="trash"/></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
