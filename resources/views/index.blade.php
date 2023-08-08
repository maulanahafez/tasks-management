<x-layout>
  <div class="container mx-auto py-10 px-4"
    x-data="{ show: @if ($errors->any()) true @else false @endif }">
    <p class="text-center text-4xl font-bold text-white">
      Simple Tasks Management
    </p>

    <div class="mt-8 rounded-md bg-white py-4 px-6">
      <div class="flex flex-wrap gap-x-4 gap-y-4 text-sm">
        <button class="bg-blue-500 px-4 py-1 text-white"
          x-on:click="show = !show">Add Task</button>
        <a href="{{ route('task.index') }}"
          class="bg-purple-500 px-4 py-1 text-white">Show All</a>
        <a href="{{ route('task.completed') }}"
          class="bg-green-500 px-4 py-1 text-white">Show Completed</a>
        <a href="{{ route('task.incomplete') }}"
          class="bg-yellow-500 px-4 py-1 text-white">Show Incomplete</a>
      </div>
    </div>

    <div class="relative mt-8 origin-top rounded-md bg-white py-4 px-6"
      x-show="show"
      x-transition:enter="transition-all ease-in-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100 "
      x-transition:leave="transition-all ease-in-out duration-300"
      x-transition:leave-start="opacity-100 "
      x-transition:leave-end="opacity-0">
      <button class="absolute text-sm text-gray-500"
        x-on:click="show = !show">
        <i class="fa-solid fa-eye-slash"></i>
      </button>
      <p class="text-center text-lg font-semibold">ADD NEW TASK</p>
      <form action="{{ route('task.store') }}"
        method="POST"
        class="mt-4">
        @csrf
        @if ($errors->any())
          <div class="mb-4 bg-red-500/20 px-4 py-2 text-xs text-red-700">
            @foreach ($errors->all() as $error)
              <p class="mb-1">{{ $error }}</p>
            @endforeach
          </div>
        @endif
        <div class="flex gap-x-4">
          <div class="flex-1 text-sm">
            <label for="judul">Judul</label>
            <input type="text"
              name="judul"
              id="judul"
              value="{{ old('judul') }}"
              class="mt-0.5 block w-full rounded-sm border border-gray-300 bg-gray-50 px-2.5 py-1.5 text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
          </div>
          <div class="flex-1 text-sm">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi"
              id="deskripsi"
              class="mt-0.5 block w-full resize-none rounded-sm border border-gray-300 bg-gray-50 px-2.5 py-1.5 text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
          </div>
        </div>
        <div class="mt-4 flex justify-center gap-x-2">
          <button type="reset"
            class="rounded-sm bg-gray-500 px-4 py-1 text-white transition-colors duration-200 ease-in-out hover:bg-opacity-90">Reset</button>
          <button type="submit"
            class="rounded-sm bg-blue-500 px-4 py-1 text-white transition-colors duration-200 ease-in-out hover:bg-opacity-90">Add</button>
        </div>
      </form>
    </div>

    <div class="mt-8 hidden rounded-md bg-white px-4 py-4">
      @if (session('successDestroy'))
        <div class="mb-4 bg-green-500/20 px-4 py-2 text-green-700">
          <p>{{ session('successDestroy') }}</p>
        </div>
      @endif
      @if (session('successStore'))
        <div class="mb-4 bg-green-500/20 px-4 py-2 text-green-700">
          <p>{{ session('successStore') }}</p>
        </div>
      @endif
      @if (session('successStatus'))
        <div class="mb-4 bg-green-500/20 px-4 py-2 text-green-700">
          <p>{{ session('successStatus') }}</p>
        </div>
      @endif
      @if (session('successUpdate'))
        <div class="mb-4 bg-green-500/20 px-4 py-2 text-green-700">
          <p>{{ session('successUpdate') }}</p>
        </div>
      @endif
      <table class="border-collapse divide-y divide-black"
        id="table">
        <thead class="">
          <tr class="rounded-lg text-sm font-semibold uppercase text-black/70">
            <td class="py-2 px-2">#</td>
            <td class="py-2 px-2">Judul</td>
            <td class="py-2 px-2">Deskripsi</td>
            <td class="py-2 px-2">Status</td>
            <td class="px-2 py-2">Change Status</td>
            <td class="py-2 px-2">Action</td>
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
              <td>
                <form action="{{ route('task.status', ['task' => $task->id]) }}"
                  method="POST">
                  @csrf
                  @method('put')
                  <button type="submit"
                    class="rounded-md bg-blue-500 px-3 py-1 text-sm text-white transition-colors duration-300 ease-in-out hover:bg-opacity-90">
                    Change
                  </button>
                </form>
              </td>
              <td class="w-[10%] items-center px-2 py-3 text-sm">
                <div class="flex items-center gap-x-2">
                  <a href="{{ route('task.edit', ['task' => $task->id]) }}">
                    <i
                      class="fa-solid fa-pen-clip text-gray-500 transition-transform duration-300 ease-in-out hover:scale-110"></i>
                  </a>
                  <form action="{{ route('task.destroy', ['task' => $task->id]) }}"
                    method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">
                      <i
                        class="fa-solid fa-trash text-red-500 transition-transform duration-300 ease-in-out hover:scale-110"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-8 rounded-md bg-white px-4 py-4"
      x-data="table"
      x-init="getTasks()">
      <input type="text"
        x-model="search"
        class="bg-red-200"
        x-on:input.debounce.1000ms="searchResult()">
      <table class="border-collapse divide-y divide-black">
        <thead class="">
          <tr class="rounded-lg text-sm font-semibold uppercase text-black/70">
            <td class="py-2 px-2">#</td>
            <td class="py-2 px-2"
              x-on:click="console.log(tasks)">Judul</td>
            <td class="py-2 px-2">Deskripsi</td>
            <td class="py-2 px-2">Status</td>
            <td class="px-2 py-2">Change Status</td>
            <td class="py-2 px-2">Action</td>
          </tr>
        </thead>
        <tbody>
          <template x-for="task in tasks.tasks">
            <tr :key="task.id">
              <td x-text="task.id"
                class="px-2 py-3 text-xs font-semibold"></td>
              <td x-text="task.judul"
                class="px-2 py-3"></td>
              <td x-text="task.deskripsi"
                class="w-1/2 px-2 py-3"></td>
              <td x-text="task.status"
                class="px-2 py-3 capitalize"></td>
              <td></td>
              <td></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>

    <script>
      function table() {
        return {
          tasks: [],
          search: '',
          searchResult() {
            console.log(this.tasks)
            this.tasks = this.tasks.filter(task => task.judul.toLowerCase().includes(this.search.toLowerCase()))
          },
          getTasks() {
            fetch('http://127.0.0.1:8000/api/test')
              .then((response) => response.json())
              .then((json) => this.tasks = json)
          }
        }
      }
      // document.addEventListener('alpine:init', () => {
      //   Alpine.data('table', () => ({
      //     init() {
      //       this.getTasks()
      //     },
      //     tasks: [],
      //     search: '',
      //     searchResult() {
      //       console.log(this.search)
      //       this.tasks = this.tasks.filter(task => task.judul.toLowerCase().includes(this.search.toLowerCase()))
      //     },
      //     getTasks() {
      //       fetch('http://127.0.0.1:8000/api/test')
      //         .then((response) => response.json())
      //         .then((json) => this.tasks = json)
      //     }
      //   }))
      // })
    </script>
  </div>
</x-layout>
