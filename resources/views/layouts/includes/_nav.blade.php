<nav class="bg-white h-12 shadow mb-8 px-6 md:px-0">
  <div class="container mx-auto h-full">
    <div class="flex items-center justify-center h-12">
      <div class="mr-6">
        <a href="{{ url('/') }}" class="hover:no-underline">
          {{ config('app.name', 'Laravel') }}
        </a>
      </div>
      <div>
        <a href="{{ route('schedules.index') }}">
          Schedules
        </a>
      </div>
      <div class="flex-1 text-right">
        <a href="{{ route('employees.index') }}">
          Employees
        </a>
      </div>
    </div>
  </div>
</nav>
