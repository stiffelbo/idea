<x-layout.layout>
    <x-form
        title="Log in"
        description="Good to have you back"
    >
        <form method="POST" action="\login" class="space-y-5">
                @csrf

                {{-- Email --}}
                <x-form.input
                    label="Email"
                    name="email"
                    type="email"
                    placeholder="john@example.com"
                    autocomplete="email"
                    required
                />

                {{-- Password --}}
                <x-form.input
                    label="Password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    required
                />

                <button type="submit" class="btn w-full h-10" data-test="signin">
                    Sign in
                </button>
            </form>
     </x-form>
</x-layout.layout>
