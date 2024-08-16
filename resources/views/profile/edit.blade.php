@extends('layouts.master')
@section('title', 'ユーザー管理')
@section('content')
    <main class="h-svh flex-1 overflow-y-scroll">
        <div class="mx-auto max-w-5xl p-6">

            {{-- title --}}
            <div class="mb-8">
                <h4 class="text-lg font-bold text-neutral-600">ユーザー管理</h4>
                {{-- <p class="text-neutral-500 text-sm">プロジェクトの一覧がここに表示されます</p> --}}
            </div>

            <div class="mx-auto max-w-7xl">
                <div class="mb-6 rounded-md border-0 border-neutral-300 bg-white p-8 shadow-lg shadow-neutral-200">
                    <div class="w-full">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-neutral-900">
                                    {{ __('Profile Information') }}
                                </h2>

                                <p class="mt-1 text-sm text-neutral-600">
                                    {{ __("Update your account's profile information and email address.") }}
                                </p>
                            </header>

                            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                @csrf
                            </form>

                            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('patch')

                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                        <div>
                                            <p class="mt-2 text-sm text-neutral-800">
                                                {{ __('Your email address is unverified.') }}

                                                <button form="send-verification" class="rounded-md text-sm text-neutral-600 underline hover:text-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-500 focus:ring-offset-2">
                                                    {{ __('Click here to re-send the verification email.') }}
                                                </button>
                                            </p>

                                            @if (session('status') === 'verification-link-sent')
                                                <p class="mt-2 text-sm font-medium text-green-600">
                                                    {{ __('A new verification link has been sent to your email address.') }}
                                                </p>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                                    @if (session('status') === 'profile-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-neutral-600">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <div class="mb-6 rounded-md border-0 border-neutral-300 bg-white p-8 shadow-lg shadow-neutral-200">
                    <div class="w-full">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-neutral-900">
                                    {{ __('Update Password') }}
                                </h2>

                                <p class="mt-1 text-sm text-neutral-600">
                                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                                </p>
                            </header>

                            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('put')

                                <div>
                                    <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                                    <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="update_password_password" :value="__('New Password')" />
                                    <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                                    @if (session('status') === 'password-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-neutral-600">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <div class="mb-6 rounded-md border-0 border-neutral-300 bg-white p-8 shadow-lg shadow-neutral-200">
                    <div class="w-full">
                        <section class="space-y-6">
                            <header>
                                <h2 class="text-lg font-medium text-neutral-900">
                                    {{ __('Delete Account') }}
                                </h2>

                                <p class="mt-1 text-sm text-neutral-600">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                                </p>
                            </header>

                            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</x-danger-button>

                            <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-neutral-900">
                                        {{ __('Are you sure you want to delete your account?') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-neutral-600">
                                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                    </p>

                                    <div class="mt-6">
                                        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

                                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                    </div>

                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </x-secondary-button>

                                        <x-danger-button class="ms-3">
                                            {{ __('Delete Account') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
