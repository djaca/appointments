@extends('layouts.app')

@section('content')
  <div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">
      <div class="rounded shadow">

        <div class="font-medium text-lg text-brand-darker bg-brand-lighter p-3 rounded-t">
          Add new employee
        </div>

        <div class="bg-white p-3 rounded-b">
          <form method="POST" action="{{ route('employees.store') }}" class="w-full">
            {{ csrf_field() }}

            <div class="flex flex-wrap -mx-3 mb-6">

              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label for="first_name">First name</label>
                <input type="text" name="first_name" id="first_name">
                {!! $errors->first('first_name', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
              </div>

              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label for="last_name">Last name</label>
                <input type="text" name="last_name" id="last_name">
                {!! $errors->first('last_name', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
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
