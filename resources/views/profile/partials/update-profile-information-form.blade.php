

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" >
        @csrf
        @method('patch')														<div class="form-group">
    <label for="name">Nom Complet</label>
    <input
        id="name"
        name="name"
        class="form-control form-control-lg"
        type="text"
        value="{{ old('name', $user->name) }}"
        required
        autofocus
        autocomplete="name"
    >
</div>

						<div class="form-group">
							<label>Code</label>
						<input
                        id="code"
                        class="form-control form-control-lg"
                        type="text"
                        name="code"
                        value="{{ old('code', $user->code) }}"
                        required
                        autofocus
                        autocomplete="code">
					</div>
				<div class="form-group">
				<label>Email</label>
				<input
                 id="email"
                 name="email"
                class="form-control form-control-lg"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username" >

                                                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
															</div>

															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="Update Information">
															</div>

                                                            </form>





