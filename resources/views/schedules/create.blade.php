@extends('layouts.app')

@section('content')
  <div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">
      <div class="rounded shadow">

        <div class="font-medium text-lg text-brand-darker bg-brand-lighter p-3 rounded-t">
          Create a schedule
        </div>

        <div class="bg-white p-3 rounded-b">
          @if($employees->isNotEmpty())
            <form method="POST" action="{{ route('schedules.store') }}" class="w-full">
              {{ csrf_field() }}

              <div class="flex flex-wrap -mx-3 mb-6">

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label for="employee_id">Employee</label>

                  <div class="relative">
                    <select name="employee_id">
                      <option value="{{ null }}">Please select</option>
                      @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                      @endforeach
                    </select>
                    <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                      </svg>
                    </div>
                    {!! $errors->first('employee_id', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                  </div>
                </div>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label for="time_from">Start time</label>
                  <input type="text" name="time_from" id="time_from">
                  {!! $errors->first('time_from', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                </div>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label for="time_to">End time</label>
                  <input type="text" name="time_to" id="time_to">
                  {!! $errors->first('time_to', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                </div>

              </div>

              <button
                type="submit"
                class="btn btn-primary"
              >
                Add
              </button>

            </form>
          @else
            Add some employees first!
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    flatpickr('#time_from', {
      enableTime: true,
      dateFormat: 'Y-m-d H:i',
      minDate: 'today',
      minTime: '09:00',
      maxTime: '20:00',
    })

    flatpickr('#time_to', {
      enableTime: true,
      dateFormat: 'Y-m-d H:i',
      minDate: 'today',
      minTime: '09:00',
      maxTime: '20:00',
    })
  </script>
@stop
