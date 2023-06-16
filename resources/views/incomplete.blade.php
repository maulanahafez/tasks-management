<x-layout>
  <div class="container mx-auto py-10 px-4">
    <p class="text-center text-4xl font-bold text-white">
      Simple Tasks Management
    </p>

    <div class="mt-8 rounded-md bg-white py-4 px-6">
      <div class="flex flex-wrap gap-x-4 gap-y-4 text-sm">
        <a href="{{ route('task.index') }}"
          class="bg-purple-500 px-4 py-1 text-white">Show All</a>
        <a href="{{ route('task.completed') }}"
          class="bg-green-500 px-4 py-1 text-white">Show Completed</a>
        <a href="{{ route('task.incomplete') }}"
          class="bg-yellow-500 px-4 py-1 text-white">Show Incomplete</a>
      </div>
    </div>

    <div class="mt-8 rounded-md bg-white px-4 py-4">
      <table class="border-collapse divide-y divide-black"
        id="table">
        <thead class="">
          <tr class="rounded-lg text-sm font-semibold uppercase text-black/70">
            <td class="py-2 px-2">#</td>
            <td class="py-2 px-2">Judul</td>
            <td class="py-2 px-2">Deskripsi</td>
            <td class="py-2 px-2">Status</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($tasks as $task)
            <tr class="transition-colors duration-200 ease-in-out hover:bg-black/5">
              <td class="px-2 py-3 text-xs font-semibold">{{ $loop->iteration }}</td>
              <td class="px-2 py-3">{{ $task->judul }}</td>
              <td class="w-1/2 px-2 py-3">{{ $task->deskripsi }}</td>
              <td class="px-2 py-3 capitalize">
                @if ($task->status == 'completed')
                  <span class="rounded-full bg-green-500 px-2 py-1 text-xs text-white">
                    {{ $task->status }}
                  </span>
                @else
                  <span class="rounded-full bg-yellow-500 px-2 py-1 text-xs text-white">
                    {{ $task->status }}
                  </span>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-layout>
