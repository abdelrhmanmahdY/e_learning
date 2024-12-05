        <button class="btn btn-warning me-3">Edit</button>
        <button class="btn btn-danger" x-data=''
            x-on:click.prevent="$dispatch('open-modal',
        'confirm-user-deletion')">Delete</button>
        <x-modal name='confirm-user-deletion'>
            <form method="post" class="p-6">
                @csrf


                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete This User?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once This User is deleted, all of its resources and data will be permanently deleted.') }}
                </p>



                <div class="mt-6 flex justify-center">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
            </form>

        </x-modal>
