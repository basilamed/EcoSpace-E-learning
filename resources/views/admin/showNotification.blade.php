<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <style>
        .notification-container {
        margin: 20px auto;
        width: 40%;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        background-color: #f8f8f8;
    }
    .notification-container .card-header {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .btn{
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: #fff;
    }

    .profileActions {
        width: 80%;   
        margin: 0 auto; 
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        padding: 10px;
    }
    #update{
        background-color: #1dc41d;
    }
    #brisi{
        background-color: #dc3545;
    }
    </style>
    <div class="container">
    <div>
      <div>
        <div class="notification-container">
            <div class="card-header">Edit notifiaction</div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            <form id="regForm" method="POST" action="/admin-notification/{{$notification->id}}/update" novalidate  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</x-input-label>
    
                    <div>
                    <x-text-input id="title" type="text" class="form-control @error('title') is-invalid @enderror block mt-1 w-full" name="title"
                        value="{{ $notification->title }}" autocomplete="name" autofocus></x-text-input>
    
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span class="invalid-feedback" role="alert" id="titleError"></span>
                    </div>
    
                </div>
    
                <div class="">
                    <x-input-label for="description" class="col-md-4 col-form-label text-md-end">Description</x-input-label>
    
                    <div class="col-md-6">
                    <x-textarea-input id="description" type="text" class="form-control @error('description') is-invalid @enderror block mt-1 w-full"
                        name="description" value="{{ $notification->description }}"  autofocus rows="6">{{ $notification->description }}
                        </x-textarea-input>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span class="invalid-feedback" role="alert" id="descriptionError"></span>
                    </div>
                </div>
    
                <div class="">
                    <div class="profileActions">
                        <button type="submit" class="btn" id='update'>
                        Update notification
                        </button>
                </form>
                    <form action="/admin-notification/{{$notification->id}}/delete" method="POST" id="delete-post-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn" id="brisi" onclick="confirmDelete()">Delete</button>
                    </form>
                    </div>
                </div>
        </div>
        </div>
    </div>
    </div>
    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
</x-app-layout>

<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this notification?')) {
        document.getElementById('delete-post-form').submit();
    } else {
        return false;
    }
}
</script>