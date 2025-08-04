<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Back to Tasks') }}
                        </a>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4">{{ $task->title }}</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <span class="font-medium">{{ __('Status') }}:</span>
                                <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($task->status == 'completed') bg-green-100 text-green-800 
                                    @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </div>
                            
                            <div>
                                <span class="font-medium">{{ __('Assigned To') }}:</span>
                                <span class="ml-2">{{ $task->user_name }}</span>
                            </div>
                            
                            @if($task->due_date)
                                <div>
                                    <span class="font-medium">{{ __('Due Date') }}:</span>
                                    <span class="ml-2">{{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</span>
                                </div>
                            @endif
                            
                            <div>
                                <span class="font-medium">{{ __('Created') }}:</span>
                                <span class="ml-2">{{ \Carbon\Carbon::parse($task->created_at)->format('M d, Y H:i') }}</span>
                            </div>
                            
                            <div>
                                <span class="font-medium">{{ __('Updated') }}:</span>
                                <span class="ml-2">{{ \Carbon\Carbon::parse($task->updated_at)->format('M d, Y H:i') }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <h4 class="font-medium mb-2">{{ __('Description') }}:</h4>
                            <div class="bg-gray-50 dark:bg-gray-600 p-4 rounded-md whitespace-pre-line">
                                {{ $task->description }}
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end gap-4 mt-6">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600 focus:bg-indigo-600 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Edit Task') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>