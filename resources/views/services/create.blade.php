@extends('layouts.app')

@section('content')
  <div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">
      <div class="rounded shadow">

        <div class="font-medium text-lg text-brand-darker bg-brand-lighter p-3 rounded-t">
          Add new service
        </div>

        <div class="bg-white p-3 rounded-b">
          <form method="POST" action="{{ route('services.store') }}" class="w-full">
            {{ csrf_field() }}

            <div class="flex flex-wrap -mx-3 mb-6">

              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
                {!! $errors->first('name', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
              </div>

              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label for="duration">Duration</label>
                <input type="text" name="duration" id="duration">
                {!! $errors->first('duration', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
              </div>

              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label for="price">Price</label>
                <input type="text" name="price" id="price">
                {!! $errors->first('price', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
              </div>

            </div>

            <button
              type="submit"
              class="btn btn-primary"
            >
              Add
            </button>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
