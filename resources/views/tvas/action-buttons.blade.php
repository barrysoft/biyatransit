<div class="btn-group btn-group-sm">
    @can('update-settings')
    <button wire:click="openEditModal({{ $row->id }}, 'tvaFormModal')" class='btn text-warning text-lg' title="{{__('Edit') }}"><i class='fas fa-edit'></i></button>
    <button wire:click="delete({{ $row->id }})" class="btn text-danger text-lg" title="{{__('Delete') }}"><i class="fas fa-trash"></i></button>
    @endcan
</div>
