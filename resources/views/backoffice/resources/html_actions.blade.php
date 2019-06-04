@if($actions)

    <td id="actions">
        <div style="width: max-content; float: left;">
            @if($visible)
                <div style="width: max-content; float: left;">
                    <a href="{{ route($route . 'show',['id' => encrypt($object->id)] ) }}"
                       class="btn btn-info btn-sm" title="Ver Más">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            @endif

            @if($editable)

                <div style="width: max-content; float: left; margin-left: 5px">
                    <a href="{{ route($route . 'edit',['id' => encrypt($object->id)] ) }}"
                       class="btn btn-warning btn-sm" title="Editar">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>

            @endif

            @if($removable)
                <div style="width: max-content; float: left; margin-left: 5px">
                    <form class="delete-form"
                          action="{{ route($route . 'destroy',['id' => encrypt($object->id)] ) }}"
                          method="post">
                        <input type="hidden" name="_method" value="delete"/>
                        {!! csrf_field() !!}
                        <button type="button" onclick="confirmDelete(this)"
                                class="btn btn-danger btn-sm" title="Eliminar"
                                style="float: left;">
                            <i class="fa fa-remove"></i>
                        </button>
                    </form>
                </div>
            @endif
        </div>

    </td>

@endif