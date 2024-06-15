<div class="flex flex-col space-y-2 gap-4" id="register">
    <div class="flex gap-4">
        <x-documentation.section-header>Product</x-documentation.section-header>
        <div class="flex gap-4 items-center">
            <x-pill theme="success">GET</x-pill>
            <x-documentation.endpoint>{{route('v1:show',['uuid' => 'abc-123'])}}</x-documentation.endpoint>
        </div>
    </div>
    <x-documentation.section-description>Get the pricing details for an individual product</x-documentation.section-description>

    <div class="flex flex-col gap-2 justify-center">
        <div class="flex gap-2 items-center">
            <x-pill>Header</x-pill>
            <x-documentation.parameter-type>string</x-documentation.parameter-type>
        </div>
        <x-documentation.parameter-description>You must pass your Bearer token as an Authorization Header</x-documentation.parameter-description>
        <x-documentation.code-sample>
            "Authorization" => "Bearer token-here"
        </x-documentation.code-sample>
        <hr />
    </div>

    <x-documentation.section-subheader>Required Fields</x-documentation.section-subheader>

    <!-- Email -->
    <div class="flex flex-col gap-2 justify-center">
        <div class="flex gap-2 items-center">
            <x-pill>uuid</x-pill>
            <x-documentation.parameter-type>string</x-documentation.parameter-type>
        </div>
        <x-documentation.parameter-description>The uuid of the product you are requesting</x-documentation.parameter-description>
        <hr />
    </div>

    <!-- Example -->
    <x-documentation.code-sample>
        Http::get('{{config('app.url')}}/api/v1/product?uuid=abc123')->json()
    </x-documentation.code-sample>
</div>
