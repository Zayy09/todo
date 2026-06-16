<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-900 shadow">
        <div class="max-w-4xl mx-auto px-4 py-3 flex justify-between items-center">

            <h1 class="text-white text-xl font-bold">
                Simple To Do List
            </h1>

            <div class="flex items-center gap-4">

                <span class="text-white">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button
                        type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </nav>

    <div class="max-w-4xl mx-auto mt-8 px-4">

        <h2 class="text-3xl font-bold text-center mb-8">
            To Do List
        </h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Tambah -->
        <div class="bg-white p-5 rounded shadow mb-6">

            <form action="{{ route('todo.post') }}" method="POST">

                @csrf

                <div class="flex gap-2">

                    <input
                        type="text"
                        name="task"
                        value="{{ old('task') }}"
                        placeholder="Tambah task baru"
                        class="flex-1 border rounded px-4 py-2">

                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

        <!-- Search -->
        <div class="bg-white p-5 rounded shadow mb-6">

            <form action="{{ route('todo') }}" method="GET">

                <div class="flex gap-2">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari task..."
                        class="flex-1 border rounded px-4 py-2">

                    <button
                        type="submit"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                        Cari

                    </button>

                </div>

            </form>

        </div>

        <!-- List Todo -->
        <div class="bg-white p-5 rounded shadow">

            <ul class="space-y-3">

                @forelse($todos as $todo)

                    <li class="border rounded p-3">

                        <div class="flex justify-between items-center">

                            <div>

                                @if($todo->is_done)

                                    <span class="line-through text-gray-500">
                                        {{ $todo->task }}
                                    </span>

                                @else

                                    <span>
                                        {{ $todo->task }}
                                    </span>

                                @endif

                            </div>

                            <div class="flex gap-2">

                                <!-- Delete -->
                                <form
                                    action="{{ route('todo.delete', $todo->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Hapus task ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">

                                        ✕

                                    </button>

                                </form>

                                <!-- Edit -->
                                <button
                                    type="button"
                                    onclick="toggleCollapse('edit-{{ $todo->id }}')"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">

                                    ✎

                                </button>

                            </div>

                        </div>

                    </li>

                    <!-- Form Edit -->
                    <li
                        id="edit-{{ $todo->id }}"
                        class="hidden border rounded p-4 bg-gray-50">

                        <form
                            action="{{ route('todo.update', $todo->id) }}"
                            method="POST">

                            @csrf
                            @method('PUT')

                            <div class="flex gap-2 mb-4">

                                <input
                                    type="text"
                                    name="task"
                                    value="{{ $todo->task }}"
                                    class="flex-1 border rounded px-4 py-2">

                                <button
                                    type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">

                                    Update

                                </button>

                            </div>

                            <div class="flex gap-6">

                                <label>
                                    <input
                                        type="radio"
                                        name="is_done"
                                        value="1"
                                        {{ $todo->is_done ? 'checked' : '' }}>

                                    Selesai
                                </label>

                                <label>
                                    <input
                                        type="radio"
                                        name="is_done"
                                        value="0"
                                        {{ !$todo->is_done ? 'checked' : '' }}>

                                    Belum
                                </label>

                            </div>

                        </form>

                    </li>

                @empty

                    <li class="text-center text-gray-500 py-5">
                        Belum ada task
                    </li>

                @endforelse

            </ul>

        </div>

    </div>

    <script>
        function toggleCollapse(id) {
            document
                .getElementById(id)
                .classList
                .toggle('hidden');
        }
    </script>

</body>
</html>