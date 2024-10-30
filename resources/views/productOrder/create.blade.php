@extends('layouts.master')

@section('title','order page')

@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div
            class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Add Order
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="index.html">Dashboard /</a>
                    </li>
                    <li class="font-medium text-primary">Add Order</li>
                </ol>
            </nav>
        </div>
        <!-- Breadcrumb End -->

        <!-- ====== Forms Section Start -->
        <div
            class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex flex-wrap items-center">
                <div class="hidden w-full xl:block xl:w-1/2">
                    <div class="px-26 py-17.5 text-center">

                    </div>
                </div>
                <div
                    class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
                    <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                        <h2
                            class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                            Add Order
                        </h2>

                        @if (Session::has('success'))
                        <p class="mb-10 bg-green-100 text-green-500  px-10 py-5 dark:text-white">
                            {{Session::get('success')}}
                        </p>
                        @endif

                        <form action="{{route('orders.store')}}" method="post">
                            @csrf
                            <div
                                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                                <div
                                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                                    <h3 class="font-medium text-black dark:text-white">
                                        Add Order Fields
                                    </h3>
                                </div>
                                <div class="flex flex-col gap-5.5 p-6.5">
                                    <div>
                                        <label
                                            class="mb-3 block text-sm font-medium text-black dark:text-white">
                                            Order Name
                                        </label>
                                        <input
                                            type="text"
                                            placeholder="Write product name here"
                                            name="name"
                                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                                        @error('name')
                                        <div>
                                            <p class="text-danger">{{$message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label
                                            class="mb-3 block text-sm font-medium text-black dark:text-white">
                                            Order Address
                                        </label>
                                        <textarea
                                            rows="6"
                                            placeholder="Default textarea"
                                            name="address"
                                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"></textarea>
                                        @error('address')
                                        <div>
                                            <p class="text-danger">{{$message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-5 mt-5  text-right">
                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center bg-primary px-20 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====== Forms Section End -->
    </div>
</main>
<!-- ===== Main Content End ===== -->
@endsection
