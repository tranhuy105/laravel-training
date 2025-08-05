<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 flex justify-between items-center">
                        <h3 class="font-medium">{{ __('All Tasks') }}</h3>
                        <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Add Task') }}
                        </a>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm rounded-lg">
                        @if($tasks->count() > 0)
                            <ul class="divide-y divide-gray-200 dark:divide-gray-600">
                                @foreach($tasks as $task)
                                    <li class="p-4 flex items-center justify-between">
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-gray-100">{{ $task->title }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-300">
                                                {{ __('Assigned to') }}: {{ $task->user_name }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-300">
                                                {{ __('Status') }}: 
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($task->status == 'completed') bg-green-100 text-green-800 
                                                    @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>
                                            </div>
                                            @if($task->due_date)
                                                <div class="text-sm text-gray-500 dark:text-gray-300">
                                                    {{ __('Due') }}: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="inline-flex items-center px-3 py-1 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600 focus:bg-indigo-600 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                {{ __('Edit') }}
                                            </a>
                                            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                                onclick="return confirm('{{ __('Are you sure you want to delete this task?') }}')">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                                {{ __('No tasks found.') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>