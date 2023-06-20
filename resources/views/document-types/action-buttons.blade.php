<div class="btn-group btn-group-sm">
    @role('Admin')
    <button wire:click="openEditModal({{ $row->id }}, 'documentTypeFormModal')" class='btn text-primary text-lg' title="{{__('Edit') }}"><i class='fas fa-edit'></i></button>
    <button wire:click="delete({{ $row->id }})" class="btn text-danger text-lg" title="{{__('Delete') }}"><i class="fas fa-trash"></i></button>
    @endrole
</div>
