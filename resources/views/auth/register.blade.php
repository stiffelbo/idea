<x-layout.layout>
    <x-form
        title="Register account"
        description="Start tracking your ideas"
    >
        <form method="POST" action="\register" class="space-y-5">
                @csrf

                {{-- Name --}}
                <x-form.input
                    label="Name"
                    name="name"
                    placeholder="John Doe"
                    autocomplete="name"
                    required
                />

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

                <button type="submit" id="submit" class="btn w-full h-10" data-test="submit">
                    Create account
                </button>
            </form>
     </x-form>
</x-layout.layout>
