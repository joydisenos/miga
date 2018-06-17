<script>
$(document).ready(function () {
   $('#filtro').keyup(function () {
      var rex = new RegExp($(this).val(), 'i');
        $('#registros tr').hide();
        $('#registros tr').filter(function () {
            return rex.test($(this).text());
        }).show();

        })

});
</script>