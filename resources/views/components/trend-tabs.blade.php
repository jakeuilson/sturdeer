<div class="p-6 text-gray-900">
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 justify-center">
        <li class="me-2">
            <a href="{{ route('dashboard', ['sort' => 'recent']) }}"
               class="inline-block px-4 py-3 rounded-lg {{ (isset($sort) && $sort === 'recent') ? 'text-black bg-blue-600' : 'hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-black' }}"
               aria-current="page">Recent</a>
        </li>
        <li class="me-2">
            <a href="{{ route('dashboard', ['sort' => 'popular']) }}"
               class="inline-block px-4 py-3 rounded-lg {{ (isset($sort) && $sort === 'popular') ? 'text-black bg-blue-600' : 'hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-black' }}">
               Popular
            </a>
        </li>
        @forelse ($trends as $trend)
            <li class="me-2">
                <a href="#"
                    class="inline-block px-4 py-3 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-black">
                    {{ $trend->name }}
                </a>
            </li>
        @empty
            {{ $slot }}
        @endforelse
    </ul>
</div>