<div class="col-12">
    <h4>Exonérations</h4>
    @can('add-exoneration')
        <table class="mb-1 table table-sm table-striped table-hover">
                <thead>
                <tr>
                    <th class="text-center" style="width: 5%">#</th>
                    <th style="width: 20%;">Conteneur</th>
                    <th style="width: 15%;">Numéro</th>
                    <th style="width: 15%;">Date</th>
                    <th style="width: 20%;">Produits</th>
                    <th style="width: 15%;">Fichier</th>
                    <th class="text-center" style="width: 10%">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exonerationFormModal" title="Ajouter une exoneration">
                            <i class="fa fa-plus"></i>
                        </button>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($exonerations as $i => $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->container->number }}</td>
                        <td>{{ $item->number }}</td>
                        <td>{{ dateFormat($item->date) }}</td>
                        <td>{{ $item->products->pluck('designation')->implode(', ') }}</td>
                        <td>
                            @if($item->attach_file_path)
                                <button wire:click="downloadFile('exonerations', 'attach_file_path', {{$item->id}})" class="btn btn-sm btn-success">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button wire:click="deleteFile('exonerations', 'attach_file_path', {{$item->id}})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @else
                                <span class="text-danger">Il manque le fichier d'exoneration</span>
                            @endif
                        </td>
                        <td>
                            <button wire:click="editExoneration('{{ $item->id }}')" class="btn btn-sm btn-warning" title="Modifier l'exoneration">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button wire:click="deleteExoneration('{{ $item->id }}')" class="btn btn-sm btn-danger" title="Supprimer l'exoneration">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @can('add-ddi-opening')
            <button class="btn btn-secondary" wire:click="setStep(2)" type="button">Passer au suivant</button>
        @endcan
    @else
        <p>Désolé! Vous avez pas les permissions pour efféctuer ces actions.</p>
    @endcan

    <x-form-modal id="exonerationFormModal" size="lg" submit="saveExoneration" title="Ajouter une exoneration">
        <x-slot name="content">
            <div class="row" wire:ignore>
                <div class="col-md-6">
                    <x-form.select label="Conteneur" wire:model.defer="exoneration.container_id"
                                   :options="$containers" required :disabled="$isEditMode"></x-form.select>
                </div>
                <div class="col-md-6">
                    <x-form.input label="Numéro d'exonération" wire:model.defer="exoneration.number" required></x-form.input>
                </div>
                <div class="col-md-6">
                    <x-form.date label="Date d'exonération" wire:model.defer="exoneration.date" required></x-form.date>
                </div>
                <div class="col-md-6">
                    <x-form.input label="Chargé d'étude" wire:model.defer="exoneration.responsible" required></x-form.input>
                </div>
                <div class="col-md-6">
                    <x-form.select label="Produits exonérés" wire:model.defer="exonerationProducts" :options="$products"
                                   placeholder="Selectionner les produits" multiple required></x-form.select>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        @if($exoneration->attach_file_path)
                            <label>Copie de la declaration</label>
                            <div class="">
                                <button wire:click="downloadFile('exonerations', 'attach_file_path', {{$exoneration->id}})" class="btn btn-success">
                                    <i class="fas fa-download"></i> Telecharger
                                </button>
                                <button wire:click="deleteFile('exonerations', 'attach_file_path', {{$exoneration->id}})" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </div>
                        @else
                            <x-form.file-upload label="Fichier Exonération" wire:model.lazy="exonerationFile"></x-form.file-upload>
                            @error('exonerationFile') <span class="text-danger">{{ $message }}</span> @enderror
                        @endif
                    </div>
                </div>
            </div>
        </x-slot>
    </x-form-modal>
</div>