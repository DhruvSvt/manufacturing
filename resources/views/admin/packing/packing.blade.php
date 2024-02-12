@extends('admin.layouts.app', ['title' => 'Packing-Page'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-center">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-center">
                Packing
            </h2>
        </div>

        <div class=" flex flex-col sm:flex-row sm:items-center sm:justify-start">
            <a href="{{ route('packing.create') }}">
                <button class="flex w-100 float-right rounded bg-primary p-3 font-medium text-gray m-3">
                    Add Details
                </button>
            </a>
        </div>
        <!-- Breadcrumb End -->
        <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10">

            <!-- ====== Data Table Two Start -->
            <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark-bg-boxdark dark:bg-meta-4">
                <div class="data-table-common data-table-two max-w-full overflow-x-auto">
                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                        @include('admin.inc.search')
                        <div class="datatable-container dark:bg-meta-4">
                            <table class="table w-full table-auto datatable-table" id="dataTableTwo">
                                <thead>
                                    <tr>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Product Name</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Size</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Rate</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Status</th>
                                        <th class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packings as $packing)
                                    <tr>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                                <p class="text-sm font-medium text-black dark:text-white">
                                                    {{ $packing->product->name }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $packing->size }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <p class="text-sm font-medium text-black dark:text-white">
                                                {{ $packing->rate }}
                                            </p>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" data-id="{{ $packing->id }}" name="status"
                                                    class="js-switch" {{ $packing->status == 1 ? 'checked' : '' }}
                                                value=""
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4
                                                peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer
                                                dark:bg-gray-700 peer-checked:after:translate-x-full
                                                peer-checked:after:border-white after:content-[''] after:absolute
                                                after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300
                                                after:border after:rounded-full after:h-5 after:w-5 after:transition-all
                                                dark:border-gray-600 peer-checked:bg-blue-600">
                                            </label>
                                        </td>
                                        <td class="lg:w-1/6 md:w-1/6 sm:w-1/6 xs:w-1/6">
                                            <div class="flex items-center space-x-3.5">
                                                <a href="{{ route('packing.edit',$packing->id) }}">
                                                    <i data-v-3d6d2adb="" title="Edit"
                                                        class="fa fa-edit text-blue-500 hover:text-blue-700 cursor-pointer"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="datatable-bottom">
                            <div class="datatable-info">
                                Showing {{ $packings->firstItem()}} to
                                {{ $packings->lastItem() }} of
                                {{ $packings->total() }} entries
                            </div>
                            {{ $packings->appends($_GET)->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- ====== Data Table Two End -->
        </div>
    </div>
</main>
<!-- ===== Main Content End ===== -->
<script>
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            let switchery = new Switchery(html, {
                size: 'small'
            });
        });

        // Ajax Request
        $(document).ready(function() {
            $('.js-switch').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let packingId = $(this).data('id');
                $.ajax({
                    type: "POST", // Change this to POST
                    dataType: "json",
                    url: '{{ route('packing.status') }}',
                    data: {
                        '_token': '{{ csrf_token() }}', // Add the CSRF token
                        'status': status,
                        'packing_id': packingId
                    },
                    success: function(data) {
                        console.log(data.message);
                    }
                });
            });
        });
</script>
@endsection
