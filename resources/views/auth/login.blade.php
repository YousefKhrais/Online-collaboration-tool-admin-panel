<x-guest-layout>
    <div class="login-box" style="width: 35%">
        <div class="card card-outline card-primary">
            <div class="card-body w-auto">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-3" :errors="$errors"/>

                <div class="text-center">
                    <h2 class="fw-bold mb-5">Admin Login</h2>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">Email address</label>
                        <input type="email" name="email" id="email" class="form-control"/>
                        @error("email")
                        <small class="text-danger">{{ $message  }}</small>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control"/>
                        @error("password")
                        <small class="text-danger">
                            {{ $message  }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="text-center p-3">
                        @error("login")
                        <small class="text-danger">
                            {{ $message  }}
                        </small>
                        @enderror
                    </div>

                    <div class="text-center p-3">
                        <button type="submit" class="btn btn-dark mb-3 w-50 rounded-pill">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
