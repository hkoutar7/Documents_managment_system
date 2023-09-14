<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900"> Informations du profil </h2>
        <p class="mt-1 text-sm text-gray-600">
            Mettez à jour les informations de votre profil et votre adresse e-mail.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <input type="hidden" name="id" name="id" value="{{ userID() }}">


        <div>
            <x-input-label for="name" :value="__('nom complet')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __("Votre adresse e-mail n'est pas vérifiée.") }}

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __("Cliquez ici pour renvoyer l'e-mail de vérification.") }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __("Un nouveau lien de vérification a été envoyé à votre adresse e-mail.") }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div >
            <label for="phone_number">phone_number <span class="text-secondary" style="font-size: 11px">(optianel)</span> </label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}"  style="border-radius: 7px; border-color: #d1d5db; box-shadow: 1px 3px 5px 0 #75757533;">
        </div>

        <div >
            <label for="description" class="ltr-elem">biographie <span class="text-secondary" style="font-size: 11px">(optianel)</span></label>
            <textarea id="description" name="description" class="form-control ltr " placeholder="Veuillez saisir une petite bio " rows="3" style="border-radius: 7px; border-color: #d1d5db; box-shadow: 1px 3px 5px 0 #75757533;">{{old('description', $user->description)}}</textarea>

        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary" style="background-color: #0162e8">Enregistrer</button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>

</section>
