<x-user-layout>
    <x-slot name="page_title">
        {{ __('Login') }}
    </x-slot>

    <section>
        <x-panel icon="cube" header="{{ __('Login') }}">
            @if (session('status'))
                <div
                    class="mb-4 font-medium text-sm text-white flex flex-row items-center justify-center p-4 rounded-lg bg-[#219654]">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 font-medium text-sm text-white flex flex-col p-4 rounded-lg bg-red-600">
                    <strong>{{ __('Whoops! Something went wrong.') }}</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf

                <div class="flex flex-col">
                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Email') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600">
                            <x-text-input name="email" value="{{ old('email') }}"
                                          placeholder="{{ __('Please input this field') }}" />
                        </div>
                    </div>

                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Password') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600">
                            <x-text-input type="password" name="password" value="{{ old('password') }}"
                                          placeholder="{{ __('Please input this field') }}" />
                        </div>
                    </div>
                </div>

                <div class="flex flex-row justify-end mt-10">
                    <x-button href="{{ route('password.request') }}" target="_self"
                              class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
                        {{ __('Forget password') }}
                    </x-button>

                    <button type="submit" class="flex bg-primary-600 hover:bg-primary-400 text-on-primary-50 hover:text-on-primary active:translate-y-1 rounded-lg lg:rounded-2xl px-6 py-2 flex-shrink-0 w-auto items-center justify-center text-base font-normal">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </x-panel>
    </section>
</x-user-layout>

