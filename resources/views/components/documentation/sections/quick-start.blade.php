<div class="flex flex-col space-y-2 gap-4" id="register">
    <div class="flex gap-4">
        <x-documentation.section-header>Quick Start</x-documentation.section-header>
    </div>
    <x-documentation.section-description>Send a POST request to the register endpoint to get your token. Use that token in requests to the product(s) endpoints</x-documentation.section-description>
    <x-documentation.section-subheader>Headers</x-documentation.section-subheader>

    <div class="flex flex-col gap-2 justify-center">
        <x-documentation.code-sample>
            $response = Http::post('{{route("register")}}',['email' => 'john@example.com','password' => 'password'])->json();
        </x-documentation.code-sample>
        <x-documentation.code-sample>
            $token = $response["token"]
        </x-documentation.code-sample>
    </div>
</div>
