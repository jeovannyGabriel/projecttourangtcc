<section class="page-section">
    <div class="container">
    <div class="w-100 justify-content-between d-flex">
        <h4><b>Actualização dos detalhes de conta</b></h4>
        <a href="./?page=my_account" class="btn btn btn-primary btn-flat"><div class="fa fa-angle-left"></div>Voltar pra Reservas</a>
    </div>
        <hr class="border-warning">
        <div class="col-md-6">
            <form action="" id="update_account" class="text-primary">
            <input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
                <div class="form-group">
                    <label for="firstname" class="control-label">NOME</label>
                    <input type="text" name="firstname" class="form-control form" value="<?php echo $_settings->userdata('firstname') ?>" required>
                </div>
                <div class="form-group">
                    <label for="lastname" class="control-label">SOBRENOME</label>
                    <input type="text" name="lastname" class="form-control form" value="<?php echo $_settings->userdata('lastname') ?>" required>
                </div>
                <div class="form-group">
                    <label for="username" class="control-label">NOME DE USUÁRIO</label>
                    <input type="text" name="username" class="form-control form" value="<?php echo $_settings->userdata('username') ?>" required>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">PASSWORD NOVA</label>
                    <input type="password" name="password" class="form-control form" value="" placeholder="">
                </div>
                <div class="form-group">
                    <label for="cpassword" class="control-label">PASSWORD ACTUAL</label>
                    <input type="password" name="cpassword" class="form-control form" value="" placeholder="">
                </div>
                <div class="form-group d-flex justify-content-end">
                    <button class="btn btn-primary btn-flat">ACTUALIZAR</button>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
$(function(){
        $('#update_account [name="password"],#update_account [name="cpassword"]').on('input',function(){
            if($('#update_account [name="password"]').val() != '' || $('#update_account [name="cpassword"]').val() != '')
            $('#update_account [name="password"],#update_account [name="cpassword"]').attr('required',true);
            else
            $('#update_account [name="password"],#update_account [name="cpassword"]').attr('required',false);
        })
        $('#update_account').submit(function(e){
            e.preventDefault();
            start_loader()
            if($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=update_account",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("Erro inesperado")
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        alert_toast("Account succesfully updated",'success');
                        $('#update_account [name="password"],#update_account [name="cpassword"]').attr('required',false);
                        $('#update_account [name="password"],#update_account [name="cpassword"]').val('');
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                        $('#update_account').prepend(_err_el)
                        end_loader()
                        
                    }else{
                        console.log(resp)
                        alert_toast("Erro inesperado")
                    }
                    end_loader()
                }
            })
        })
    })
</script>