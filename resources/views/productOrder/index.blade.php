@extends('layouts.master')

@section('title','index page')

@section('content')

<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <!-- order product -->
    <div x-data="{
                        inputs: [{ qty: '', price: '', disc: '', total: 0 }],
                        payment:0,
                        isOptionSelected: false,
                        calculateTotal(index) {
                            let item = this.inputs[index];
                            let discount = item.disc ? item.disc / 100 : 0; // ডিসকাউন্টকে শতকরা হিসেবে ধরে নিন
                            item.total = (item.qty && item.price) ? item.qty * item.price * (1 - discount) : 0;
                        },
                        calculateGrandTotal() {
                          return this.inputs.reduce((sum, input) => sum + Number(input.total), 0);
                        },
                        paymentCalculation(){

                            return this.payment - this.calculateGrandTotal();
                        }

                        }"

        class="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">

        <!-- order products start -->
        <div class="col-span-12 rounded-sm border border-stroke bg-white p-7.5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-8">
            <div
                class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
                <div class="max-w-full overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-2 text-left dark:bg-meta-4">
                                <!-- product start -->
                                <th
                                    class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11">
                                    Product
                                </th>
                                <!-- product end -->

                                <!-- quantity start  -->
                                <th
                                    class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                                    Qty
                                </th>
                                <!-- quantity end -->

                                <!-- price start -->
                                <th
                                    class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                                    Price
                                </th>
                                <!-- price end -->

                                <!-- discount start -->
                                <th
                                    class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                                    Disc(%)
                                </th>
                                <!-- discount end -->

                                <!-- total start -->
                                <th
                                    class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                                    Total
                                </th>
                                <!-- total end -->

                                <!-- button start-->
                                <th class="px-4 py-4 font-medium text-black dark:text-white">
                                    <div class="flex h-9 w-full max-w-9 items-center justify-center  dark:border-white cursor-pointer">
                                        <svg
                                            @click="inputs.push({ qty: '', price: '', disc: '', total: '' })"
                                            class="fill-primary dark:fill-white"
                                            width="14"
                                            height="14"
                                            viewBox="0 0 15 15"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.2969 6.51563H8.48438V1.70312C8.48438 1.15625 8.04688 0.773438 7.5 0.773438C6.95313 0.773438 6.57031 1.21094 6.57031 1.75781V6.57031H1.75781C1.21094 6.57031 0.828125 7.00781 0.828125 7.55469C0.828125 8.10156 1.26563 8.48438 1.8125 8.48438H6.625V13.2969C6.625 13.8438 7.0625 14.2266 7.60938 14.2266C8.15625 14.2266 8.53906 13.7891 8.53906 13.2422V8.42969H13.3516C13.8984 8.42969 14.2813 7.99219 14.2813 7.44531C14.2266 6.95312 13.7891 6.51563 13.2969 6.51563Z" fill=""></path>
                                        </svg>
                                    </div>
                                </th>
                                <!-- button end -->
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(input,index) in inputs" :key="index">
                                <tr>
                                    <!-- product start -->
                                    <td
                                        class="border-b border-[#eee] px-4 py-5  dark:border-strokedark">
                                        <select class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                                            :class="isOptionSelected && 'text-black dark:text-white'"
                                            @change="isOptionSelected = true"
                                            @change="fetchProductDetails()"
                                            name="product_id[]">
                                            <option disabled class="text-body">Select Product</option>
                                            @foreach ($products as $product)
                                            <option value="{{$product->id}}" class="text-body">{{$product->name}}</option>

                                            @endforeach
                                        </select>
                                    </td>
                                    <!-- product end -->

                                    <!-- quantity start -->
                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                        <input
                                            x-model="input.qty"
                                            @input="calculateTotal(index)"
                                            name="quantity[]"
                                            type="number"
                                            placeholder="Qty"
                                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                                            autocomplete="off">
                                    </td>
                                    <!-- quantity end -->

                                    <!-- price start  -->
                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                        <input
                                            x-model="input.price"
                                            @input="calculateTotal(index)"
                                            name=" price[]"
                                            type="number"
                                            placeholder="Price"
                                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                                            autocomplete="off">
                                    </td>
                                    <!-- price end -->

                                    <!-- discount start  -->
                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                        <input
                                            x-model="input.disc"
                                            @input="calculateTotal(index)"
                                            name="discount[]"
                                            type="number"
                                            placeholder="Disc"
                                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                                            autocomplete="off">
                                    </td>
                                    <!-- discount end -->

                                    <!-- total start  -->
                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                        <input
                                            x-model="input.total"
                                            x-bind:value="input.total"
                                            name="total" type="number"
                                            placeholder="Total"
                                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                                            autocomplete="off">
                                    </td>
                                    <!-- total end -->

                                    <!-- button start  -->
                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                        <div class="flex items-center space-x-3.5">
                                            <button @click="inputs.splice(index, 1)" class="hover:text-primary">
                                                <svg
                                                    class="fill-current"
                                                    width="18"
                                                    height="18"
                                                    viewBox="0 0 18 18"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 8L8 16M8.00001 8L16 16" stroke="rgb(211 64 83 / var(--tw-text-opacity))" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <!-- button end  -->
                                </tr>
                            </template>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- order product end  -->

        <!-- total amount display start  -->
        <div
            class="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:col-span-4">
            <!-- total start -->
            <div class="mb-6 text-xl bg-meta-3 px-10 py-4 text-white hover:bg-opacity-90 font-bold dark:text-white">Total: <span class="text-title-md" x-text="calculateGrandTotal().toFixed(2)"></span>
            </div>
            <!-- total end -->
            <!-- print / history / report buttons start -->
            <div class="flex items-center mb-4">
                <a href="#" class="inline-flex border border-primary bg-primary px-2 py-1 font-medium text-white hover:border-primary hover:bg-primary hover:text-white dark:hover:border-primary sm:px-6 sm:py-3">Print</a>
                <a href="#" class="inline-flex border-y border-stroke px-2 py-1 font-medium text-black hover:border-primary hover:bg-primary hover:text-white dark:border-strokedark dark:text-white dark:hover:border-primary sm:px-6 sm:py-3">History</a>
                <a href="#" class="inline-flex border border-stroke px-2 py-1 font-medium text-black hover:border-primary hover:bg-primary hover:text-white dark:border-strokedark dark:text-white dark:hover:border-primary sm:px-6 sm:py-3">Report</a>
            </div>
            <!-- print / history / report button end -->
            <!-- custer name and customer address start -->
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Customer name
                    </label>
                    <input type="text" placeholder="Enter customer name" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                </div>

                <div class="w-full xl:w-1/2">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Customer Phone
                    </label>
                    <input type="text" placeholder="Notes" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                </div>
            </div>
            <!--customer name and note end -->
            <!-- payment method start -->
            <div class="mb-4">
                <div class="mb-2">
                    <p class="font-medium text-black dark:text-white">Payment Method</p>
                </div>
                <div class="flex gap-6">
                    <!-- cash start -->
                    <div x-data="{ checkboxToggle: false }">
                        <label for="checkboxLabelTwo" class="flex cursor-pointer select-none items-center text-sm font-medium">
                            <div class="relative">
                                <input type="checkbox" id="checkboxLabelTwo" class="sr-only" @change="checkboxToggle = !checkboxToggle">
                                <div :class="checkboxToggle &amp;&amp; 'border-primary bg-gray dark:bg-transparent'" class="mr-4 flex h-5 w-5 items-center justify-center rounded border">
                                    <span :class="checkboxToggle &amp;&amp; '!opacity-100'" class="opacity-0">
                                        <svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972ZM4.2327 6.30081L4.2317 6.2998C4.23206 6.30015 4.23237 6.30049 4.23269 6.30082L4.2327 6.30081Z" fill="#3056D3" stroke="#3056D3" stroke-width="0.4"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            Cash
                        </label>
                    </div>
                    <!-- cash end -->
                    <!-- bank transfer start -->
                    <div x-data="{ checkboxToggle: false }">
                        <label for="checkboxLabelTwo" class="flex cursor-pointer select-none items-center text-sm font-medium">
                            <div class="relative">
                                <input type="checkbox" id="checkboxLabelTwo" class="sr-only" @change="checkboxToggle = !checkboxToggle">
                                <div :class="checkboxToggle &amp;&amp; 'border-primary bg-gray dark:bg-transparent'" class="mr-4 flex h-5 w-5 items-center justify-center rounded border">
                                    <span :class="checkboxToggle &amp;&amp; '!opacity-100'" class="opacity-0">
                                        <svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972ZM4.2327 6.30081L4.2317 6.2998C4.23206 6.30015 4.23237 6.30049 4.23269 6.30082L4.2327 6.30081Z" fill="#3056D3" stroke="#3056D3" stroke-width="0.4"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            Bank Transfer
                        </label>
                    </div>
                    <!-- bank transfer end -->
                    <!-- credit card start -->
                    <div x-data="{ checkboxToggle: false }">
                        <label for="checkboxLabelTwo" class="flex cursor-pointer select-none items-center text-sm font-medium">
                            <div class="relative">
                                <input type="checkbox" id="checkboxLabelTwo" class="sr-only" @change="checkboxToggle = !checkboxToggle">
                                <div :class="checkboxToggle &amp;&amp; 'border-primary bg-gray dark:bg-transparent'" class="mr-4 flex h-5 w-5 items-center justify-center rounded border">
                                    <span :class="checkboxToggle &amp;&amp; '!opacity-100'" class="opacity-0">
                                        <svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972ZM4.2327 6.30081L4.2317 6.2998C4.23206 6.30015 4.23237 6.30049 4.23269 6.30082L4.2327 6.30081Z" fill="#3056D3" stroke="#3056D3" stroke-width="0.4"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            Credit Card
                        </label>
                    </div>
                    <!-- Credit Card end -->
                </div>
            </div>
            <!-- payment method end -->

            <!-- payment and change start -->
            <div class="mb-8 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        payment
                    </label>
                    <!-- test -->
                    <input type="text" x-model="payment" placeholder="payment" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                </div>

                <div class="w-full xl:w-1/2">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Change
                    </label>
                    <input :value="paymentCalculation()" readonly type="text" placeholder="change" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
                </div>
            </div>
            <!--payment and notes end  -->

            <!-- save and calculate button -->
            <div class="mb-7.5 flex flex-wrap gap-5 xl:gap-7.5">
                <a href="#" class="inline-flex items-center justify-center gap-2.5 bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10">
                    <span>
                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.8125 16.6656H2.1875C1.69022 16.6656 1.21331 16.4681 0.861675 16.1164C0.510044 15.7648 0.3125 15.2879 0.3125 14.7906V5.20935C0.3125 4.71207 0.510044 4.23516 0.861675 3.88353C1.21331 3.53189 1.69022 3.33435 2.1875 3.33435H17.8125C18.3098 3.33435 18.7867 3.53189 19.1383 3.88353C19.49 4.23516 19.6875 4.71207 19.6875 5.20935V14.7906C19.6875 15.2879 19.49 15.7648 19.1383 16.1164C18.7867 16.4681 18.3098 16.6656 17.8125 16.6656ZM2.1875 4.58435C2.02174 4.58435 1.86277 4.6502 1.74556 4.76741C1.62835 4.88462 1.5625 5.04359 1.5625 5.20935V14.7906C1.5625 14.9564 1.62835 15.1153 1.74556 15.2325C1.86277 15.3498 2.02174 15.4156 2.1875 15.4156H17.8125C17.9783 15.4156 18.1372 15.3498 18.2544 15.2325C18.3717 15.1153 18.4375 14.9564 18.4375 14.7906V5.20935C18.4375 5.04359 18.3717 4.88462 18.2544 4.76741C18.1372 4.6502 17.9783 4.58435 17.8125 4.58435H2.1875Z" fill=""></path>
                            <path d="M9.9996 10.6438C9.63227 10.6437 9.2721 10.5421 8.95898 10.35L0.887102 5.45001C0.744548 5.36381 0.642073 5.22452 0.602222 5.06277C0.58249 4.98268 0.578725 4.89948 0.591144 4.81794C0.603563 4.73639 0.631922 4.65809 0.674602 4.58751C0.717281 4.51692 0.773446 4.45543 0.839888 4.40655C0.906331 4.35767 0.981751 4.32236 1.06184 4.30263C1.22359 4.26277 1.39455 4.28881 1.5371 4.37501L9.60898 9.28126C9.7271 9.35331 9.8628 9.39143 10.0012 9.39143C10.1395 9.39143 10.2752 9.35331 10.3934 9.28126L18.4621 4.37501C18.5323 4.33233 18.6102 4.30389 18.6913 4.29131C18.7725 4.27873 18.8554 4.28227 18.9352 4.30171C19.015 4.32115 19.0901 4.35612 19.1564 4.40462C19.2227 4.45312 19.2788 4.51421 19.3215 4.58438C19.3642 4.65456 19.3926 4.73245 19.4052 4.81362C19.4177 4.89478 19.4142 4.97763 19.3948 5.05743C19.3753 5.13723 19.3404 5.21242 19.2919 5.27871C19.2434 5.34499 19.1823 5.40108 19.1121 5.44376L11.0402 10.35C10.7271 10.5421 10.3669 10.6437 9.9996 10.6438Z" fill=""></path>
                        </svg>
                    </span>
                    Save
                </a>

                <a href="#" class="inline-flex items-center justify-center gap-2.5 bg-meta-3 px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10">
                    <span>
                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.8125 16.6656H2.1875C1.69022 16.6656 1.21331 16.4681 0.861675 16.1164C0.510044 15.7648 0.3125 15.2879 0.3125 14.7906V5.20935C0.3125 4.71207 0.510044 4.23516 0.861675 3.88353C1.21331 3.53189 1.69022 3.33435 2.1875 3.33435H17.8125C18.3098 3.33435 18.7867 3.53189 19.1383 3.88353C19.49 4.23516 19.6875 4.71207 19.6875 5.20935V14.7906C19.6875 15.2879 19.49 15.7648 19.1383 16.1164C18.7867 16.4681 18.3098 16.6656 17.8125 16.6656ZM2.1875 4.58435C2.02174 4.58435 1.86277 4.6502 1.74556 4.76741C1.62835 4.88462 1.5625 5.04359 1.5625 5.20935V14.7906C1.5625 14.9564 1.62835 15.1153 1.74556 15.2325C1.86277 15.3498 2.02174 15.4156 2.1875 15.4156H17.8125C17.9783 15.4156 18.1372 15.3498 18.2544 15.2325C18.3717 15.1153 18.4375 14.9564 18.4375 14.7906V5.20935C18.4375 5.04359 18.3717 4.88462 18.2544 4.76741C18.1372 4.6502 17.9783 4.58435 17.8125 4.58435H2.1875Z" fill=""></path>
                            <path d="M9.9996 10.6438C9.63227 10.6437 9.2721 10.5421 8.95898 10.35L0.887102 5.45001C0.744548 5.36381 0.642073 5.22452 0.602222 5.06277C0.58249 4.98268 0.578725 4.89948 0.591144 4.81794C0.603563 4.73639 0.631922 4.65809 0.674602 4.58751C0.717281 4.51692 0.773446 4.45543 0.839888 4.40655C0.906331 4.35767 0.981751 4.32236 1.06184 4.30263C1.22359 4.26277 1.39455 4.28881 1.5371 4.37501L9.60898 9.28126C9.7271 9.35331 9.8628 9.39143 10.0012 9.39143C10.1395 9.39143 10.2752 9.35331 10.3934 9.28126L18.4621 4.37501C18.5323 4.33233 18.6102 4.30389 18.6913 4.29131C18.7725 4.27873 18.8554 4.28227 18.9352 4.30171C19.015 4.32115 19.0901 4.35612 19.1564 4.40462C19.2227 4.45312 19.2788 4.51421 19.3215 4.58438C19.3642 4.65456 19.3926 4.73245 19.4052 4.81362C19.4177 4.89478 19.4142 4.97763 19.3948 5.05743C19.3753 5.13723 19.3404 5.21242 19.2919 5.27871C19.2434 5.34499 19.1823 5.40108 19.1121 5.44376L11.0402 10.35C10.7271 10.5421 10.3669 10.6437 9.9996 10.6438Z" fill=""></path>
                        </svg>
                    </span>
                    Calculate
                </a>
            </div>

            <!-- save and calculate button end -->

        </div>
        <!-- total amount display end -->

    </div>
    <!-- order product end  -->

    <div
        class="mt-4 md:mt-6 2xl:mt-7.5 grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
        <!-- Card Item Start -->
        <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
            <div
                class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                <svg
                    class="fill-primary dark:fill-white"
                    width="22"
                    height="16"
                    viewBox="0 0 22 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11 15.1156C4.19376 15.1156 0.825012 8.61876 0.687512 8.34376C0.584387 8.13751 0.584387 7.86251 0.687512 7.65626C0.825012 7.38126 4.19376 0.918762 11 0.918762C17.8063 0.918762 21.175 7.38126 21.3125 7.65626C21.4156 7.86251 21.4156 8.13751 21.3125 8.34376C21.175 8.61876 17.8063 15.1156 11 15.1156ZM2.26876 8.00001C3.02501 9.27189 5.98126 13.5688 11 13.5688C16.0188 13.5688 18.975 9.27189 19.7313 8.00001C18.975 6.72814 16.0188 2.43126 11 2.43126C5.98126 2.43126 3.02501 6.72814 2.26876 8.00001Z"
                        fill="" />
                    <path
                        d="M11 10.9219C9.38438 10.9219 8.07812 9.61562 8.07812 8C8.07812 6.38438 9.38438 5.07812 11 5.07812C12.6156 5.07812 13.9219 6.38438 13.9219 8C13.9219 9.61562 12.6156 10.9219 11 10.9219ZM11 6.625C10.2437 6.625 9.625 7.24375 9.625 8C9.625 8.75625 10.2437 9.375 11 9.375C11.7563 9.375 12.375 8.75625 12.375 8C12.375 7.24375 11.7563 6.625 11 6.625Z"
                        fill="" />
                </svg>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <h4
                        class="text-title-md font-bold text-black dark:text-white">
                        $3.456K
                    </h4>
                    <span class="text-sm font-medium">Total views</span>
                </div>

                <span
                    class="flex items-center gap-1 text-sm font-medium text-meta-3">
                    0.43%
                    <svg
                        class="fill-meta-3"
                        width="10"
                        height="11"
                        viewBox="0 0 10 11"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z"
                            fill="" />
                    </svg>
                </span>
            </div>
        </div>
        <!-- Card Item End -->

        <!-- Card Item Start -->
        <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
            <div
                class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                <svg
                    class="fill-primary dark:fill-white"
                    width="20"
                    height="22"
                    viewBox="0 0 20 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.7531 16.4312C10.3781 16.4312 9.27808 17.5312 9.27808 18.9062C9.27808 20.2812 10.3781 21.3812 11.7531 21.3812C13.1281 21.3812 14.2281 20.2812 14.2281 18.9062C14.2281 17.5656 13.0937 16.4312 11.7531 16.4312ZM11.7531 19.8687C11.2375 19.8687 10.825 19.4562 10.825 18.9406C10.825 18.425 11.2375 18.0125 11.7531 18.0125C12.2687 18.0125 12.6812 18.425 12.6812 18.9406C12.6812 19.4219 12.2343 19.8687 11.7531 19.8687Z"
                        fill="" />
                    <path
                        d="M5.22183 16.4312C3.84683 16.4312 2.74683 17.5312 2.74683 18.9062C2.74683 20.2812 3.84683 21.3812 5.22183 21.3812C6.59683 21.3812 7.69683 20.2812 7.69683 18.9062C7.69683 17.5656 6.56245 16.4312 5.22183 16.4312ZM5.22183 19.8687C4.7062 19.8687 4.2937 19.4562 4.2937 18.9406C4.2937 18.425 4.7062 18.0125 5.22183 18.0125C5.73745 18.0125 6.14995 18.425 6.14995 18.9406C6.14995 19.4219 5.73745 19.8687 5.22183 19.8687Z"
                        fill="" />
                    <path
                        d="M19.0062 0.618744H17.15C16.325 0.618744 15.6031 1.23749 15.5 2.06249L14.95 6.01562H1.37185C1.0281 6.01562 0.684353 6.18749 0.443728 6.46249C0.237478 6.73749 0.134353 7.11562 0.237478 7.45937C0.237478 7.49374 0.237478 7.49374 0.237478 7.52812L2.36873 13.9562C2.50623 14.4375 2.9531 14.7812 3.46873 14.7812H12.9562C14.2281 14.7812 15.3281 13.8187 15.5 12.5469L16.9437 2.26874C16.9437 2.19999 17.0125 2.16562 17.0812 2.16562H18.9375C19.35 2.16562 19.7281 1.82187 19.7281 1.37499C19.7281 0.928119 19.4187 0.618744 19.0062 0.618744ZM14.0219 12.3062C13.9531 12.8219 13.5062 13.2 12.9906 13.2H3.7781L1.92185 7.56249H14.7094L14.0219 12.3062Z"
                        fill="" />
                </svg>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <h4
                        class="text-title-md font-bold text-black dark:text-white">
                        $45,2K
                    </h4>
                    <span class="text-sm font-medium">Total Profit</span>
                </div>

                <span
                    class="flex items-center gap-1 text-sm font-medium text-meta-3">
                    4.35%
                    <svg
                        class="fill-meta-3"
                        width="10"
                        height="11"
                        viewBox="0 0 10 11"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z"
                            fill="" />
                    </svg>
                </span>
            </div>
        </div>
        <!-- Card Item End -->

        <!-- Card Item Start -->
        <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
            <div
                class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                <svg
                    class="fill-primary dark:fill-white"
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M21.1063 18.0469L19.3875 3.23126C19.2157 1.71876 17.9438 0.584381 16.3969 0.584381H5.56878C4.05628 0.584381 2.78441 1.71876 2.57816 3.23126L0.859406 18.0469C0.756281 18.9063 1.03128 19.7313 1.61566 20.3844C2.20003 21.0375 2.99066 21.3813 3.85003 21.3813H18.1157C18.975 21.3813 19.8 21.0031 20.35 20.3844C20.9 19.7656 21.2094 18.9063 21.1063 18.0469ZM19.2157 19.3531C18.9407 19.6625 18.5625 19.8344 18.15 19.8344H3.85003C3.43753 19.8344 3.05941 19.6625 2.78441 19.3531C2.50941 19.0438 2.37191 18.6313 2.44066 18.2188L4.12503 3.43751C4.19378 2.71563 4.81253 2.16563 5.56878 2.16563H16.4313C17.1532 2.16563 17.7719 2.71563 17.875 3.43751L19.5938 18.2531C19.6282 18.6656 19.4907 19.0438 19.2157 19.3531Z"
                        fill="" />
                    <path
                        d="M14.3345 5.29375C13.922 5.39688 13.647 5.80938 13.7501 6.22188C13.7845 6.42813 13.8189 6.63438 13.8189 6.80625C13.8189 8.35313 12.547 9.625 11.0001 9.625C9.45327 9.625 8.1814 8.35313 8.1814 6.80625C8.1814 6.6 8.21577 6.42813 8.25015 6.22188C8.35327 5.80938 8.07827 5.39688 7.66577 5.29375C7.25327 5.19063 6.84077 5.46563 6.73765 5.87813C6.6689 6.1875 6.63452 6.49688 6.63452 6.80625C6.63452 9.2125 8.5939 11.1719 11.0001 11.1719C13.4064 11.1719 15.3658 9.2125 15.3658 6.80625C15.3658 6.49688 15.3314 6.1875 15.2626 5.87813C15.1595 5.46563 14.747 5.225 14.3345 5.29375Z"
                        fill="" />
                </svg>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <h4
                        class="text-title-md font-bold text-black dark:text-white">
                        2.450
                    </h4>
                    <span class="text-sm font-medium">Total Product</span>
                </div>

                <span
                    class="flex items-center gap-1 text-sm font-medium text-meta-3">
                    2.59%
                    <svg
                        class="fill-meta-3"
                        width="10"
                        height="11"
                        viewBox="0 0 10 11"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z"
                            fill="" />
                    </svg>
                </span>
            </div>
        </div>
        <!-- Card Item End -->

        <!-- Card Item Start -->
        <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
            <div
                class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                <svg
                    class="fill-primary dark:fill-white"
                    width="22"
                    height="18"
                    viewBox="0 0 22 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7.18418 8.03751C9.31543 8.03751 11.0686 6.35313 11.0686 4.25626C11.0686 2.15938 9.31543 0.475006 7.18418 0.475006C5.05293 0.475006 3.2998 2.15938 3.2998 4.25626C3.2998 6.35313 5.05293 8.03751 7.18418 8.03751ZM7.18418 2.05626C8.45605 2.05626 9.52168 3.05313 9.52168 4.29063C9.52168 5.52813 8.49043 6.52501 7.18418 6.52501C5.87793 6.52501 4.84668 5.52813 4.84668 4.29063C4.84668 3.05313 5.9123 2.05626 7.18418 2.05626Z"
                        fill="" />
                    <path
                        d="M15.8124 9.6875C17.6687 9.6875 19.1468 8.24375 19.1468 6.42188C19.1468 4.6 17.6343 3.15625 15.8124 3.15625C13.9905 3.15625 12.478 4.6 12.478 6.42188C12.478 8.24375 13.9905 9.6875 15.8124 9.6875ZM15.8124 4.7375C16.8093 4.7375 17.5999 5.49375 17.5999 6.45625C17.5999 7.41875 16.8093 8.175 15.8124 8.175C14.8155 8.175 14.0249 7.41875 14.0249 6.45625C14.0249 5.49375 14.8155 4.7375 15.8124 4.7375Z"
                        fill="" />
                    <path
                        d="M15.9843 10.0313H15.6749C14.6437 10.0313 13.6468 10.3406 12.7874 10.8563C11.8593 9.61876 10.3812 8.79376 8.73115 8.79376H5.67178C2.85303 8.82814 0.618652 11.0625 0.618652 13.8469V16.3219C0.618652 16.975 1.13428 17.4906 1.7874 17.4906H20.2468C20.8999 17.4906 21.4499 16.9406 21.4499 16.2875V15.4625C21.4155 12.4719 18.9749 10.0313 15.9843 10.0313ZM2.16553 15.9438V13.8469C2.16553 11.9219 3.74678 10.3406 5.67178 10.3406H8.73115C10.6562 10.3406 12.2374 11.9219 12.2374 13.8469V15.9438H2.16553V15.9438ZM19.8687 15.9438H13.7499V13.8469C13.7499 13.2969 13.6468 12.7469 13.4749 12.2313C14.0937 11.7844 14.8499 11.5781 15.6405 11.5781H15.9499C18.0812 11.5781 19.8343 13.3313 19.8343 15.4625V15.9438H19.8687Z"
                        fill="" />
                </svg>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <h4
                        class="text-title-md font-bold text-black dark:text-white">
                        3.456
                    </h4>
                    <span class="text-sm font-medium">Total Users</span>
                </div>

                <span
                    class="flex items-center gap-1 text-sm font-medium text-meta-5">
                    0.95%
                    <svg
                        class="fill-meta-5"
                        width="10"
                        height="11"
                        viewBox="0 0 10 11"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.64284 7.69237L9.09102 4.33987L10 5.22362L5 10.0849L-8.98488e-07 5.22362L0.908973 4.33987L4.35716 7.69237L4.35716 0.0848701L5.64284 0.0848704L5.64284 7.69237Z"
                            fill="" />
                    </svg>
                </span>
            </div>
        </div>
        <!-- Card Item End -->
    </div>

    <div
        class="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">
        <!-- ====== Chart One Start -->
        @include('partials.chart-01')
        <!-- ====== Chart One End -->

        <!-- ====== Chart Two Start -->
        @include('partials.chart-02')
        <!-- ====== Chart Two End -->

        <!-- ====== Chart Three Start -->
        @include('partials.chart-03')
        <!-- ====== Chart Three End -->

        <!-- ====== Map One Start -->
        @include('partials.map-01')
        <!-- ====== Map One End -->

        <!-- ====== Table One Start -->
        <div class="col-span-12 xl:col-span-8">
            @include('partials.table-01')
        </div>
        <!-- ====== Table One End -->

        <!-- ====== Chat Card Start -->
        <div
            class="col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4">
            <h4
                class="mb-6 px-7.5 text-xl font-bold text-black dark:text-white">
                Chats
            </h4>

            <div>
                <a
                    href="messages.html"
                    class="flex items-center gap-5 px-7.5 py-3 hover:bg-gray-3 dark:hover:bg-meta-4">
                    <div class="relative h-14 w-14 rounded-full">
                        <img src="{{Vite::asset('resources/images/user/user-03.png')}}" alt="">
                        <span
                            class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-meta-3"></span>
                    </div>

                    <div class="flex flex-1 items-center justify-between">
                        <div>
                            <h5 class="font-medium text-black dark:text-white">
                                Devid Heilo
                            </h5>
                            <p>
                                <span
                                    class="text-sm font-medium text-black dark:text-white">Hello, how are you?</span>
                                <span class="text-xs"> . 12 min</span>
                            </p>
                        </div>
                        <div
                            class="flex h-6 w-6 items-center justify-center rounded-full bg-primary">
                            <span class="text-sm font-medium text-white">3</span>
                        </div>
                    </div>
                </a>
                <a
                    href="messages.html"
                    class="flex items-center gap-5 px-7.5 py-3 hover:bg-gray-3 dark:hover:bg-meta-4">
                    <div class="relative h-14 w-14 rounded-full">
                        <img src="{{Vite::asset('resources/images/user/user-04.png')}}" alt="">
                        <span
                            class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-meta-3"></span>
                    </div>

                    <div class="flex flex-1 items-center justify-between">
                        <div>
                            <h5 class="font-medium">Henry Fisher</h5>
                            <p>
                                <span class="text-sm font-medium">I am waiting for you</span>
                                <span class="text-xs"> . 5:54 PM</span>
                            </p>
                        </div>
                    </div>
                </a>
                <a
                    href="messages.html"
                    class="flex items-center gap-5 px-7.5 py-3 hover:bg-gray-3 dark:hover:bg-meta-4">
                    <div class="relative h-14 w-14 rounded-full">
                        <img src="{{Vite::asset('resources/images/user/user-05.png')}}" alt="">
                        <span
                            class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-meta-6"></span>
                    </div>

                    <div class="flex flex-1 items-center justify-between">
                        <div>
                            <h5 class="font-medium">Wilium Smith</h5>
                            <p>
                                <span class="text-sm font-medium">Where are you now?</span>
                                <span class="text-xs"> . 10:12 PM</span>
                            </p>
                        </div>
                    </div>
                </a>
                <a
                    href="messages.html"
                    class="flex items-center gap-5 px-7.5 py-3 hover:bg-gray-3 dark:hover:bg-meta-4">
                    <div class="relative h-14 w-14 rounded-full">
                        <img src="{{Vite::asset('resources/images/user/user-01.png')}}" alt="">
                        <span
                            class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-meta-3"></span>
                    </div>

                    <div class="flex flex-1 items-center justify-between">
                        <div>
                            <h5 class="font-medium text-black dark:text-white">
                                Henry Deco
                            </h5>
                            <p>
                                <span
                                    class="text-sm font-medium text-black dark:text-white">Thank you so much!</span>
                                <span class="text-xs"> . Sun</span>
                            </p>
                        </div>
                        <div
                            class="flex h-6 w-6 items-center justify-center rounded-full bg-primary">
                            <span class="text-sm font-medium text-white">2</span>
                        </div>
                    </div>
                </a>
                <a
                    href="messages.html"
                    class="flex items-center gap-5 px-7.5 py-3 hover:bg-gray-3 dark:hover:bg-meta-4">
                    <div class="relative h-14 w-14 rounded-full">
                        <img src="{{Vite::asset('resources/images/user/user-02.png')}}" alt="">
                        <span
                            class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-meta-7"></span>
                    </div>

                    <div class="flex flex-1 items-center justify-between">
                        <div>
                            <h5 class="font-medium">Jubin Jack</h5>
                            <p>
                                <span class="text-sm font-medium">I really love that!</span>
                                <span class="text-xs"> . Oct 23</span>
                            </p>
                        </div>
                    </div>
                </a>
                <a
                    href="messages.html"
                    class="flex items-center gap-5 px-7.5 py-3 hover:bg-gray-3 dark:hover:bg-meta-4">
                    <div class="relative h-14 w-14 rounded-full">
                        <img src="{{Vite::asset('resources/images/user/user-05.png')}}" alt="">
                        <span
                            class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-meta-6"></span>
                    </div>

                    <div class="flex flex-1 items-center justify-between">
                        <div>
                            <h5 class="font-medium">Wilium Smith</h5>
                            <p>
                                <span class="text-sm font-medium">Where are you now?</span>
                                <span class="text-xs"> . Sep 20</span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- ====== Chat Card End -->
    </div>
</div>

@endsection
