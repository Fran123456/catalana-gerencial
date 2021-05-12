<div  wire:ignore.self  class="modal fade" id="Modal-retrieve-permissions" tabindex="-1" aria-labelledby="Modal-retrieve-permissions" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            @if ($selected_role != null)
            <h5 class="modal-title" id="exampleModalLabel">{{ucfirst(__('Permissions for role :data',['data'=>$selected_role->name]))}}</h5>
            @endif
            </div>
            <div class="modal-body">                
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">{{__("Permissions' name")}}</th>
                            <th class="text-center">{{__('Assigned')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if ($selected_role != null)
                        @foreach ($permissions as $key => $permission)
                            <tr>
                                <td class="text-center">{{$permission->name}}</td>
                                <td class="text-center">
                                @if(auth()->user()->can('assign_permissions'))
                                    <input wire:model.defer="checkboxes.{{$key}}" type="checkbox" value="{{json_encode($permission)}}" id="{{$permission->id}}">
                                @else
                                    <input disabled wire:model.defer="checkboxes.{{$key}}" type="checkbox" value="{{json_encode($permission)}}" id="{{$permission->id}}">
                                @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif                
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
            <button  wire:click="updateCheckbox()" data-bs-dismiss="modal" class="btn btn-primary"><i class="fas fa-save"></i></button>
            </div>
        </div>
    </div>
</div>