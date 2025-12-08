<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Merci pour votre inscription ! Avant de commencer, pourriez-vous vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer ? Si vous n\'avez pas reçu l\'email, nous vous en enverrons un autre avec plaisir.') }}
    </div>

    {{-- Message de succès --}}
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse email fournie lors de l\'inscription.') }}
        </div>
    @endif

    {{-- Message d'information --}}
    @if (session('info'))
        <div class="mb-4 font-medium text-sm text-blue-600">
            {{ session('info') }}
        </div>
    @endif

    {{-- Messages d'erreur --}}
    @if ($errors->any())
        <div class="mb-4">
            <div class="font-medium text-sm text-red-600">
                {{ __('Oups ! Quelque chose s\'est mal passé.') }}
            </div>
            <ul class="mt-2 text-sm text-red-600 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Renvoyer l\'email de vérification') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Se déconnecter') }}
            </button>
        </form>
    </div>
</x-guest-layout>
