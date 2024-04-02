<div>
    <x-danger-button wire:click="confirmUserDeletion" type="button" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </x-danger-button>

    <x-confirmation-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">
            Delete User
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this user?
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" class="mr-4" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                Delete User
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
