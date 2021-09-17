<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            
                <form method="POST" action="/task/{{ $task->id }}" enctype="multipart/form-data">
    
                    <div class="form-group">
                        <textarea name="description" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">{{$task->description }}</textarea>	
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Select task picture</label>
                        <input type="file" name ="picture" class="form-control"  id="formFile">
                       
                      </div>
                      
    
                    <div class="form-group">
                        <button type="submit" name="update" class="btn btn-success">Update task</button>
                    </div>
                {{ csrf_field() }}
                </form>

                @if ($task->picture != "")
                <a href="{{'images/' . $task->picture}}" target="_blank" rel="noopener noreferrer"><img height="150px" width="150px" src="{{'../images/' . $task->picture}}" alt="TaskPic"></a> 
                <form action="/task/{{$task->id}}" class="inline-block">
                    <button type="submit" name="delete_pic" formmethod="POST" class="btn btn-danger">Delete Image</button>
                    {{ csrf_field() }}
                </form>
                @endif
                
            </div>
        </div>
    </div>
    </x-app-layout>
    
