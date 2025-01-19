<x-app-layout>
    <x-bar-layout>
        @section('content')
            <!-- Content Row -->
            <div class="col">
                <div class="py-12">
                    <div class="container contact-form">
                        <hr />
                        @if (session()->has('error'))
                            <div>
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('categories.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <span class="fs-5">Add Category</span>
                            <div class="form-group w-50">
                                <input type="text" name="name" class="form-control"
                                    placeholder="Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row d-flex">
                                <div class="col-lg-1 col-md-3" style="width: 100px">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-lg-1 col-md-3"
                            style="width: 100px; margin-top: -38px; margin-left: 80px;">
                            <button class="btn btn-danger">
                                <a class="text-decoration-none text-white"
                                    href="{{ route('admin.categories.index') }}">Cancel</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->
        @endsection
    </x-bar-layout>
</x-app-layout>                    
