<x-guest-layout>
    <x-slot name="header">
        {{ __('Register') }}
    </x-slot>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" />

        <!-- Surname -->
        <x-input-label for="surname" :value="__('Surname')" />
        <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autocomplete="surname" autofocus />
        <x-input-error :messages="$errors->get('surname')" />

        <!-- Email Address -->
        <x-input-label for="email" :value="__('Email address')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
        <x-input-error :messages="$errors->get('email')" />

        <!-- Gender -->
        <div class="row mb-3">
            <x-input-label class="col-md-4 col-form-label text-md-end" :value="'Gender'" />
            <div class="col-md-3 d-flex justify-center align-items-center">
                <input id="maleGender" type="radio" value="M" name="gender" checked />
                <label for="maleGender">&nbsp;&nbsp;&nbsp;Male</label>
            </div>
            <div class="col-md-3 d-flex justify-center align-items-center">
                <input id="femaleGender" type="radio" value="F" name="gender" />
                <label for="femaleGender">&nbsp;&nbsp;&nbsp;Female</label>
            </div>
            <x-input-error :messages="$errors->get('gender')" />
        </div>

        <!-- Birth Country -->
        <x-input-label for="birthCountry" :value="__('Birth country')" />
        <x-text-input id="birthCountry" class="block mt-1 w-full" type="text" name="birthCountry" :value="old('birthCountry')" required autocomplete="birthCountry" autofocus />
        <x-input-error :messages="$errors->get('birthCountry')" />

        <!-- Birth Place -->
        <x-input-label for="birthPlace" :value="__('Birth place')" />
        <x-text-input id="birthPlace" class="block mt-1 w-full" type="text" name="birthPlace" :value="old('birthPlace')" required autocomplete="birthPlace" autofocus />
        <x-input-error :messages="$errors->get('birthPlace')" />

        <!-- Birth Date -->
        <div class="row mb-3">
            <x-input-label class="col-md-4 col-form-label text-md-end" :value="'Birthdate'" />
            <div class="col-md-6">
                <x-text-input id="birthDate" class="block mt-1 w-full" type="date" name="birthDate" :value="old('birthDate')" required autocomplete="birthDate" autofocus />
                <x-input-error :messages="$errors->get('birthDate')" />
                <span class="invalid-feedback" role="alert" id="birthDateError"></span>
            </div>
        </div>

        <!-- JMBG -->
        <x-input-label for="jmbg" :value="__('Social security number')" />
        <x-text-input id="jmbg" type="text" class="block mt-1 w-full" name="jmbg" :value="old('jmbg')" required autocomplete="jmbg" autofocus />
        <x-input-error :messages="$errors->get('jmbg')" />

        <!-- Contact -->
        <x-input-label for="contact" :value="__('Contact phone number')" />
        <x-text-input id="contact" type="text" class="block mt-1 w-full" name="contact" :value="old('contact')" required autocomplete="contact" autofocus />
        <x-input-error :messages="$errors->get('contact')" />

        <!-- Picture -->
        <div class="row mb-3">
            <x-input-label class="col-md-4 col-form-label text-md-end" :value="'Photo'" />
            <div class="col-md-6">
                <x-text-input id="picture" type="file" name="picture" rows="10" accept="image/png, image/jpeg, image/jpg" />
                <x-input-error :messages="$errors->get('picture')" />
                <span class="invalid-feedback" role="alert" id="imageServerError"></span>
                <span class="invalid-feedback" role="alert" id="profilePictureError"></span>
            </div>
        </div>

        <!-- Role -->
        <div class="row mb-3">
            <x-input-label class="col-md-4 col-form-label text-md-end" :value="'I regiser as'" />
            <div class="col-md-3 d-flex justify-center align-items-center">
                <input id="student" type="radio" value="student" name="role" checked />
                <label for="student">&nbsp;&nbsp;&nbsp;Student</label>
            </div>
            <div class="col-md-3 d-flex justify-center align-items-center">
                <input id="teacher" type="radio" value="teacher" name="role" />
                <label for="teacher">&nbsp;&nbsp;&nbsp;Teacher</label>
            </div>
            <x-input-error :messages="$errors->get('role')" />
        </div>

        <!-- Password -->
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" />

        <!-- Confirm Password -->
        <x-input-label for="password-confirm" :value="__('Confirm Password')" />
        <x-text-input id="password-confirm" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

