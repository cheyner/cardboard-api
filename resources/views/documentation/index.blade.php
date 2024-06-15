@extends('layouts.app')

@section('content')

<section class="flex">
    <aside class="bg-gray-100 w-1/6 p-8 hidden md:block">
        <h2 class="font-bold text-2xl">Reference</h2>
        <ul>
            <li>
                <x-documentation.reference-link href="#authentication">Misc.</x-documentation.reference-link>
                <ul class="ml-4">
                    <li>
                        <x-documentation.subreference-link href="#updates">Updates</x-documentation.subreference-link>
                    </li>
                    <li>
                        <x-documentation.subreference-link href="#rate-limiting">Rate Limits</x-documentation.subreference-link>
                    </li>
                </ul>
            </li>
            <li>
                <x-documentation.reference-link href="#authentication">Authentication</x-documentation.reference-link>
                <ul class="ml-4">
                    <li>
                        <x-documentation.subreference-link href="#register">Register</x-documentation.subreference-link>
                    </li>
                    <li>
                        <x-documentation.subreference-link href="#login">Login</x-documentation.subreference-link>
                    </li>
                </ul>
            </li>
            <li>
                 <x-documentation.reference-link href="#data">Data Points</x-documentation.reference-link>
                 <ul class="ml-4">
                     <li>
                         <x-documentation.subreference-link href="#products">Products</x-documentation.subreference-link>
                     </li>
                     <li>
                         <x-documentation.subreference-link href="#product">Product</x-documentation.subreference-link>
                     </li>
                 </ul>
             </li>
        </ul>
    </aside>
    <div class="w-5/6 p-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h1 class="text-4xl font-bold mb-8">Cardboard API Documentation</h1>
            <a target="_blank" href="https://www.patreon.com/DeathLotusLabs" class="bg-orange-400 w-max whitespace-nowrap text-white font-bold rounded shadow px-3 py-2">Support the Project</a>
        </div>

        <div class="flex flex-col space-y-8">
            <section class="space-y-4" id="authentication">
                <h2 class="text-2xl font-semibold">Misc.</h2>
                <x-documentation.sections.misc/>
            </section>
            <section class="space-y-4" id="authentication">
                <h2 class="text-2xl font-semibold">Authentication</h2>
                <x-documentation.sections.register />
                <x-documentation.sections.login/>
            </section>
            <section class="space-y-4" id="data">
                <h2 class="text-2xl font-semibold">Data Points</h2>
                <x-documentation.sections.products/>
                <x-documentation.sections.product/>
            </section>

        </div>
    </div>
</section>

@endsection
