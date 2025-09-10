<x-guest-layout>
         <form method="POST" action="{{ route('login') }}">
             @csrf
             <div>
                 <x-input-label for="nik" :value="__('NIK')" />
                 <x-text-input id="nik" name="nik" type="text" required autofocus />
                 <x-input-error :messages="$errors->get('nik')" />
             </div>
             <div>
                 <x-input-label for="password" :value="__('Password')" />
                 <x-text-input id="password" name="password" type="password" required />
                 <x-input-error :messages="$errors->get('password')" />
             </div>
             <div>
                 <label for="remember">
                     <input id="remember" type="checkbox" name="remember">
                     <span>{{ __('Remember me') }}</span>
                 </label>
             </div>
             <x-primary-button>{{ __('Log in') }}</x-primary-button>
         </form>
     </x-guest-layout>