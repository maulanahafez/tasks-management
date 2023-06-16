<x-layout>
  <div class="container mx-auto py-10 px-4">

    <p class="text-center text-4xl font-bold text-white">
      Simple Tasks Management
    </p>

    <div class="relative mt-8 rounded-md bg-white py-4 px-6">
      <a href="{{ route('task.index') }}"
        class="absolute text-sm text-gray-500">
        <i class="fa-solid fa-arrow-left-long"></i>
      </a>
      <p class="text-center text-lg font-semibold">Edit Task</p>
      <form action="{{ route('task.update', ['task' => $task->id]) }}"
        method="POST"
        class="mt-4">
        @csrf
        @method('put')
        @if ($errors->any())
          <div class="mb-4 bg-red-500/20 px-4 py-2 text-xs text-red-700">
            @foreach ($errors->all() as $error)
              <p class="mb-1">{{ $error }}</p>
            @endforeach
          </div>
        @endif
        <div class="flex gap-x-4 text-sm">
          <div class="flex-1">
            <div>
              <label for="judul">Judul</label>
              <input type="text"
                name="judul"
                id="judul"
                value="{{ old('judul', $task->judul) }}"
                class="mt-0.5 block w-full rounded-sm border border-gray-300 bg-gray-50 px-2.5 py-1.5 text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
            </div>
            <div class="mt-2">
              <p for="status">Status</p>
              <div class="flew mt-2 flex gap-4">
                <div class="flex items-center gap-x-1">
                  <input type="radio"
                    name="status"
                    id="completed"
                    value="completed"
                    @checked($task->status == 'completed')>
                  <label for="completed"
                    class="inline-block rounded-full bg-green-500 px-2 py-1 text-xs text-white">Completed</label>
                </div>
                <div class="flex items-center gap-x-1">
                  <input type="radio"
                    name="status"
                    id="incomplete"
                    value="incomplete"
                    @checked($task->status == 'incomplete')>
                  <label for="incomplete"
                    class="inline-block rounded-full bg-yellow-500 px-2 py-1 text-xs text-white">Incomplete</label>
                </div>
              </div>
            </div>
          </div>
          <div class="flex-1">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi"
              id="deskripsi"
              rows="4"
              class="mt-0.5 block w-full resize-none rounded-sm border border-gray-300 bg-gray-50 px-2.5 py-1.5 text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-blue-500">{{ old('deskripsi', $task->deskripsi) }}</textarea>
          </div>
        </div>
        <div class="mt-4 flex justify-center gap-x-2">
          <button type="reset"
            class="rounded-sm bg-gray-500 px-4 py-1 text-white transition-colors duration-200 ease-in-out hover:bg-opacity-90">Reset</button>
          <button type="submit"
            class="rounded-sm bg-blue-500 px-4 py-1 text-white transition-colors duration-200 ease-in-out hover:bg-opacity-90">Update</button>
        </div>
      </form>
    </div>
  </div>
</x-layout>
