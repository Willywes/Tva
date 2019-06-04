@if($active)
    <script>
        // toogle status

        $(function () {
            preparedChangeStatus();
        });

        function preparedChangeStatus() {
            $('*[id^="chk_active_"]').change(function () {

                let id = $(this).prop('id').replace('chk_active_', '');
                let active = $(this).prop('checked');

                changeStatus(id, active);

            })
        }

        function changeStatus(id, active) {

            $.ajax({
                url: '{{ route($route . 'change-status') }}',
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    active: active
                },
                success: function (result) {
                    if (result.status == 'success') {
                        showToastSuccess(result.message);
                    } else {
                        showToastError(result.message);

                        // $("#chk_status_" + id).prop('checked', true).change()
                        // return false;
                    }
                }
            });
        }

    </script>
@endif