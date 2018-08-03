@extends('layouts.app')

@section('content')
  <div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">
      <div class="rounded shadow">

        <div class="font-medium text-lg text-brand-darker bg-brand-lighter p-3 rounded-t">
          Schedules
        </div>

        <div class="bg-white p-3 rounded-b">
          {!! $schedules->calendar() !!}
        </div>
      </div>
    </div>
  </div>
@stop

@section('js')
  {!! $schedules->script() !!}
@stop
