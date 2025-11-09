@extends('layouts.app')

@section('content')
<div class="min-h-screen w-full flex items-center justify-center bg-gray-100 p-6">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-12">
        
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Create Account</h2>

        <div data-signals="{showPassword: false, showConfirmPassword: false}">
            
            <form class="space-y-6" data-on:submit__prevent="@postx('{{ route('auth.store') }}')">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Full Name
                    </label>
                    <input 
                        type="text" 
                        id="name"
                        name="name"
                        data-bind="name"
                        placeholder="Enter your full name" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                    <div data-error="name" class="text-red-500 text-xs mt-1"></div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        id="email"
                        name="email"
                        data-bind="email"
                        placeholder="Enter your email" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                    <div data-error="email" class="text-red-500 text-xs mt-1"></div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input 
                            data-attr:type="$showPassword ? 'text' : 'password'"
                            id="password"
                            name="password"
                            data-bind="password"
                            placeholder="Enter your password" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent pr-12">
                        
                        <button 
                            type="button"
                            data-on:click="$showPassword = !$showPassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-sky-500 hover:text-sky-600 focus:outline-none"
                            data-show="!$showPassword">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </button>

                        <button 
                            type="button"
                            data-on:click="$showPassword = !$showPassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-sky-500 hover:text-sky-600 focus:outline-none"
                            data-show="$showPassword">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </button>
                    </div>
                    <div data-error="password" class="text-red-500 text-xs mt-1"></div>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <input 
                            data-attr:type="$showConfirmPassword ? 'text' : 'password'"
                            id="confirm-password"
                            name="confirmPassword"
                            data-bind="confirmPassword"
                            placeholder="Confirm your password" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent pr-12">
                        
                        <button 
                            type="button"
                            data-on:click="$showConfirmPassword = !$showConfirmPassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-sky-500 hover:text-sky-600 focus:outline-none"
                            data-show="!$showConfirmPassword">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </button>

                        <button 
                            type="button"
                            data-on:click="$showConfirmPassword = !$showConfirmPassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-sky-500 hover:text-sky-600 focus:outline-none"
                            data-show="$showConfirmPassword">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </button>
                    </div>
                    <div data-error="confirmPassword" class="text-red-500 text-xs mt-1"></div>
                </div>

                <div class="flex justify-between items-center pt-4">
                    <a href="{{ route('auth.login-view') }}" 
                       data-navigate="true" 
                       class="text-sm font-medium text-sky-500 hover:text-sky-600 transition">
                        Back to Sign In
                    </a>
                    <button 
                        type="submit" 
                        class="btn btn-primary">
                        Register
                    </button>
                </div>
            </form>
            <pre class="mt-4 text-xs" data-json-signals></pre>
        </div>

    </div>
</div>
@endsection