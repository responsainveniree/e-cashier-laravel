<div x-show="errorObject.isError" x-transition @click.self="closeError"
    class="fixed inset-0 z-70 flex items-center justify-center bg-black bg-opacity-50">

    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-sm shadow-lg">
        <div class="flex items-center gap-3 mb-3">
            <!-- Icon Error -->
            <div class="shrink-0 w-10 h-10 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>

            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Error
                <span x-show="errorObject.errorStatus" x-text="'(' + errorObject.errorStatus + ')'"
                    class="text-sm text-gray-500">
                </span>
            </h3>
        </div>

        <p class="text-gray-700 dark:text-gray-300 mb-6" x-text="errorObject.errorMessage">
        </p>

        <div class="flex justify-end">
            <button @click="closeError" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                OK
            </button>
        </div>
    </div>
</div>
