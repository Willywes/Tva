@if($removable)
    <script>

        function confirmDelete(val) {
            var form = $(val).parents('form:first');

            swal({
                title: '¿Estas Seguro?',
                text: "Si eliminas este elemento, la información será irrecuperable",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#43a047',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'No, cancelar!'
            }).then(function (result) {
                if (result.value) {
                    form.submit();
                }
            })

        }

    </script>

@endif