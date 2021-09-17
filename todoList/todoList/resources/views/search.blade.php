<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Result Searching') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">Tasks List Search</div>
                    
                    <div class="flex-auto text-right mt-2">
                        <a href="/task" style="margin-left: 30px" class="btn btn-primary btn-sm">Add new Task</a>
                    </div>

                </div>
            
                <table class="w-full text-md rounded mb-4">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Task</th>
                        <th class="text-left p-3 px-5">Actions</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        
                    @foreach($tasks as $task)
                    
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                {{$task->description}}

                                @if ($task->picture != "")
                                   <a href="{{'images/' . $task->picture}}" target="_blank" rel="noopener noreferrer"><img height="150px" width="150px" src="{{'images/' . $task->picture}}" alt="TaskPic"></a> 
                                @endif
                                   
                            </td>
                            <td class="p-3 px-5">
                                
                                <a href="/task/{{$task->id}}" name="edit" style="margin-bottom: 10px" class="btn btn-success">Edit</a>
                                
                                <form action="/task/{{$task->id}}" class="inline-block">
                                    <button type="submit" name="delete" formmethod="POST" class="btn btn-danger">Delete</button>
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
    </x-app-layout>
    
