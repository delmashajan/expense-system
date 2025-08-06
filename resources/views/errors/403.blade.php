<x-app-layout>
        <div class=" items-center justify-center bg-gray-100">
            <div class="bg-white shadow-md rounded text-center">
                <h1 class="text-4xl font-bold text-red-600 mb-4">403</h1>
                <h2 class="text-xl font-semibold mb-2">Unauthorized</h2>
                <p class="text-gray-600 mb-6">You don't have permission to access this page.</p>
                <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Go to Dashboard
                </a>
            </div>
        </div>
</x-app-layout>
