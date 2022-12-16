<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @role('owner')
                        {{ __("I'm Owner of this website") }}
                    @endrole

                    @role('sales')
                        {{ __("I'm Sales of this website") }}
                    @endrole

                    @role('developer')
                        {{ __("I'm Developer of this website") }}
                    @endrole

                    @role('admin')
                        {{ __("I'm Admin of this website") }}
                    @endrole
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
