<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Expense') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 max-w-7xl mx-auto">
        <div class="bg-white shadow-md rounded p-4 ">
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul class="list-disc pl-6">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input name="title" type="text" id="title" value="{{ old('title') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>

                <!-- Amount -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">
                        Amount
                    </label>
                    <input name="amount" type="number" step="0.01" min="0" max="99999999.99" id="amount"
                        value="{{ old('amount') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description (Optional)
                    </label>
                    <textarea name="description" id="description"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="4">{{ old('description') }}</textarea>
                </div>

                <!-- Receipt -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="receipt">
                        Upload Receipt (jpg, png, pdf, max 2MB)
                    </label>
                    <input name="receipt" type="file" id="receipt" class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700
                                  hover:file:bg-blue-100" />
                </div>

                <div class="flex items-center">
                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">
                        Submit Expense
                    </button>

                    <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 px-2">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>