<div class="border-t border-gray-200 pt-4">
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('dashboard', ['sort' => 'recent']) }}"
           class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ (isset($sort) && $sort === 'recent') ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-700 bg-gray-100 hover:bg-gray-200 hover:text-gray-900' }}"
           aria-current="{{ (isset($sort) && $sort === 'recent') ? 'page' : 'false' }}">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Recent
        </a>
        <a href="{{ route('dashboard', ['sort' => 'popular']) }}"
           class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ (isset($sort) && $sort === 'popular') ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-700 bg-gray-100 hover:bg-gray-200 hover:text-gray-900' }}"
           aria-current="{{ (isset($sort) && $sort === 'popular') ? 'page' : 'false' }}">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
            Popular
        </a>
    </div>
</div>