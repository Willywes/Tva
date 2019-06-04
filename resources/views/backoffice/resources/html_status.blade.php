@if($active)
    <td>
        <input type="checkbox" class="toogle" id="chk_active_{{ encrypt($object->id) }}" {{ $object->active == 1 ? 'checked' :  '' }} data-toggle="toggle"
               data-size="small" data-on="Activado" data-off="Desactivado"
               data-onstyle="success" data-offstyle="danger"/>
    </td>
@endif