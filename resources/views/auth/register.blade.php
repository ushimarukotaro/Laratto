<x-guest-layout>
    <x-auth-card>
        <!-- Validation Errors Laravel9.4以降変わったらしい -->
        {{-- <x-auth-validation-errors class="mb-4 text-center" :errors="$errors" /> --}}
        {{-- エラーメッセージを一覧で表示する場合はコチラ --}}
        {{-- <x-input-error class="mb-4" :messages="$errors->all()"/> --}}

        <a class="flex items-center justify-center text-gray-600 font-bold p-5 mb-4 md:mb-0" href="{{ route('top') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="1" class="w-10 h-10 text-white p-1 bg-emerald-500 rounded-full"
                viewBox="0 0 22 22">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
            </svg>
            <!-- title -->
            <span class="ml-3 text-2xl">Laratto会員登録</span>
        </a>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('ユーザー名')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('メールアドレス')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('パスワード')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('パスワード確認用')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('すでに登録済みの方はこちら') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('ユーザー登録') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
