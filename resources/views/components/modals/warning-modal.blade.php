<div x-show="warningObject.isWarning" x-transition @click.self="cancelWarning"
    class="fixed inset-0 z-60 flex items-center justify-center bg-black bg-opacity-50">

    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-sm shadow-lg">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
            Konfirmasi
        </h3>

        <p class="text-gray-700 dark:text-gray-300 mb-6" x-text="warningObject.warningMessage">
        </p>

        <div class="flex justify-end gap-2">
            <button @click="cancelWarning"
                class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500">
                Batal
            </button>

            <button @click="confirmWarning()" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                Ya, tutup
            </button>
        </div>
    </div>
</div>
