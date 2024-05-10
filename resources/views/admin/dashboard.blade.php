<x-app-layout>
    <div>
        <div class="row">
            <div class="col-md-auto sidebar">
                @include('admin.sidebar')
            </div>
            <div class="col">
                <div class="content py-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        <h3>Total Users: {{ $totalUsers ?? 0 }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
