@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="text-center"> Contacts shared with me </h1>
    @forelse ($contactsSharedWithUser as $contact)
      <div class="d-flex justify-content-between bg-primary mb-3 rounded px-4 py-2">
        <div>
          <a href="{{ route('contacts.show', $contact->id) }}">
            <img src="{{ Storage::url($contact->profile_picture) }}" class="profile-picture">
          </a>
        </div>

        <div class="d-flex align-items-center">
          <p class="me-2 mb-0">{{ $contact->name }}</p>
          <p class="me-2 mb-0 d-none d-md-block">
            <a class="text-success" href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
          </p>
          <p class="me-2 mb-0 d-none d-md-block">
            <a class="text-info" href="tel:{{ $contact->phone_number }}">{{ $contact->phone_number }}</a>
          </p>

          <p class="me-2 mb-0 d-none d-md-block"> Shared by <span class="text-info">{{ $contact->user->email }}</span></p>
        </div>
      </div>
    @empty
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center">
          <span class="align-middle">No contacts where shared with you yet</span>
        </div>
      </div>
    @endforelse

    {{-- SHARED BY ME --}}
    <h1 class="text-center"> Contacts shared by me </h1>
    @forelse ($contactsSharedByUser as $contact)
      @foreach ($contact->sharedWithUsers as $user)
        <div class="d-flex justify-content-between bg-primary mb-3 rounded px-4 py-2">
          <div>
            <a href="{{ route('contacts.show', $contact->id) }}">
              <img src="{{ Storage::url($contact->profile_picture) }}" class="profile-picture">
            </a>
          </div>

          <div class="d-flex align-items-center">
            <p class="me-2 mb-0">{{ $contact->name }}</p>
            <p class="me-2 mb-0 d-none d-md-block">
              <a class="text-success" href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
            </p>
            <p class="me-2 mb-0 d-none d-md-block">
              <a class="text-info" href="tel:{{ $contact->phone_number }}">{{ $contact->phone_number }}</a>
            </p>

            <p class="me-2 mb-0 d-none d-md-block"> Shared with <span class="text-info">{{ $user->email }}</span></p>
            <form action="{{ route('contact-shares.destroy', $user->pivot->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn mb-0 btn-danger p-1 px-2">
                Unshare
              </button>
            </form>

          </div>
        </div>
      @endforeach
    @empty
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center">
          <p>You didn't share any contact yet</p>
          <p>Share contacts <a href="{{ route('contact-shares.create') }}">here</a>.</p>
        </div>
      </div>
    @endforelse
  </div>
@endsection
