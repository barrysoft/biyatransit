@section('title', 'Details du role')
<x-show-section title="Details du role" >
    <div class="row">
        <div class="col-md-6">
            <x-form.input label="Role" wire:model.defer="role" disabled></x-form.input>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label>Permissions</label>
            <div class="table-responsive-sm">
                <table class="table table-sm table-striped">
                    {{--<thead>
                    <tr>
                        <th>#</th>
                        <th>Voir</th>
                        <th>Ajouter</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                    </thead>--}}
                    <tbody>
                    @foreach($tables as $key => $table)
                        <tr>
                            <th>{{ $groupPermissions[$table] }}</th>
                            <td>
                                @if(array_key_exists('view-'.$table, $permissions))
                                    <x-form.checkbox label="Voir" wire:model.defer="rolePermissions" :value="$permissions['view-'.$table]" disabled></x-form.checkbox>
                                @endif
                            </td>
                            <td>
                                @if(array_key_exists('create-'.$table, $permissions))
                                    <x-form.checkbox label="Ajouter" wire:model.defer="rolePermissions" :value="$permissions['create-'.$table]" disabled></x-form.checkbox>
                                @endif
                            </td>
                            <td>
                                @if(array_key_exists('update-'.$table, $permissions))
                                    <x-form.checkbox label="Modifier" wire:model.defer="rolePermissions" :value="$permissions['update-'.$table]" disabled></x-form.checkbox>
                                @endif
                                @if(array_key_exists('edit-'.$table, $permissions))
                                    <x-form.checkbox label="Modifier" wire:model.defer="rolePermissions" :value="$permissions['edit-'.$table]" disabled></x-form.checkbox>
                                @endif
                            </td>
                            <td>
                                @if(array_key_exists('delete-'.$table, $permissions))
                                    <x-form.checkbox label="Supprimer" wire:model.defer="rolePermissions" :value="$permissions['delete-'.$table]" disabled></x-form.checkbox>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-show-section>