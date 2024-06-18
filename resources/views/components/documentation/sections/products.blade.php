<div class="flex flex-col space-y-2 gap-4" id="register">
    <div class="flex gap-4">
        <x-documentation.section-header>Products</x-documentation.section-header>
        <div class="flex gap-4 items-center">
            <x-pill theme="success">Get</x-pill>
            <x-documentation.endpoint>{{route('v1:index')}}</x-documentation.endpoint>
        </div>
    </div>
    <x-documentation.section-description>Get a list of products, their UUIDs, and their most recent prices for each finish</x-documentation.section-description>
    <x-documentation.section-description>Inpect the payload to see the pagination links to allow you to get the rest of the products.</x-documentation.section-description>
    <x-documentation.section-description>Alternatively, pass a 'page' property.</x-documentation.section-description>
    <x-documentation.section-subheader>Headers</x-documentation.section-subheader>

    <!-- -->
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

    <x-documentation.section-subheader>Optional Fields</x-documentation.section-subheader>

    <div class="flex flex-col gap-2 justify-center">
        <div class="flex gap-2 items-center">
            <x-pill>page</x-pill>
            <x-documentation.parameter-type>string</x-documentation.parameter-type>
        </div>
        <x-documentation.parameter-description>The page of products to fetch</x-documentation.parameter-description>
        <hr />
    </div>

    <div class="flex flex-col gap-2 justify-center">
        <div class="flex gap-2 items-center">
            <x-pill>uuids</x-pill>
            <x-documentation.parameter-type>string</x-documentation.parameter-type>
        </div>
        <x-documentation.parameter-description>A comma-separated string of uuids to fetch</x-documentation.parameter-description>
        <hr />
    </div>

    <div class="flex flex-col gap-2 justify-center">
        <div class="flex gap-2 items-center">
            <x-pill>provider</x-pill>
            <x-documentation.parameter-type>string</x-documentation.parameter-type>
        </div>
        <x-documentation.parameter-description>Provide this parameter when you want products from a certain provider. Current options are: {{
                collect(App\Enums\Providers::cases())->map(fn (App\Enums\Providers $provider) => $provider->value)->join(',');
            }}</x-documentation.parameter-description>
        <hr />
    </div>

    <div class="flex flex-col gap-2 justify-center">
        <div class="flex gap-2 items-center">
            <x-pill>external_ids</x-pill>
            <x-documentation.parameter-type>string</x-documentation.parameter-type>
        </div>
        <x-documentation.parameter-description>A comma-separated string of external provider ids to fetch from</x-documentation.parameter-description>
        <hr />
    </div>

    <!-- Example -->
    <x-documentation.code-sample>
        Http::get('{{route('v1:index')}}')->json()
    </x-documentation.code-sample>
</div>
