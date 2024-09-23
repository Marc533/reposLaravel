<div>
    <div class="row">
        <div class="form col-5">
            <form>
               
                <div class="mb-3">
                    <label for="marque" class="form-label">username</label>
                    <input type="text" class="form-control" wire:model="state.user" id="user" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Email</label>
                    <input type="email" class="form-control" wire:model="state.email" id="email" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Tél</label>
                    <input type="text" class="form-control" wire:model="state.tel" id="tel" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Sexe</label>
                    <input type="text" class="form-control" wire:model="state.sexe" id="sexe" placeholder="">
                </div>
                <div class="mb-3">
                    <button type="reset" wire:click.prevent="cancel" class="btn btn-secondary">Annuler</button>
                    @if ($updateBtn)
                        <button type="submit" wire:click.prevent="Update" class="btn btn-primary">Mettre à jour</button>
                    @else
                        <button type="submit" wire:click.prevent="create" class="btn btn-primary">Enregistrer</button>
                    @endif
                </div>
            </form>
        </div>
        <div class=" col-7">
            <h3>List des utilisateurs</h3>
            <table class="table table-responsive table-bordered">
                <thead>
                  <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Sexe</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($user as $data)
                        <tr>
                            <th scope="row"> {{$data->id}}</th>
                            <td>{{$data->user}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->tel}}</td>
                            <td>{{$data->sexe}}</td>
                            <td>
                                <button type="button" wire:click.prevent="Edite({{ $data->id }})" class="btn btn-warning btn-sm">Modifier</button>
                                <button type="button" wire:click.prevent="Supprimer({{$data->id}})" class="btn btn-danger btn-sm">Supprimer</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>