<div class="row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="name" class="required">Nome </label>
        <input type="text" name="name" id="name" autofocus class="form-control" required value="{{ old('name',$user->name) }}">
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="email" class="required">E-mail </label>
        <input type="email" name="email" id="email" class="form-control" required value="{{  old('email',$user->email) }}">
    </div>
    @can('is_admin', 'App\User')
        <div class="form-group col-sm-12 col-md-6">
            <label for="access" class="required">Tipo </label>
            <select name="access" id="access" class="form-control select2" value="{{ old('access', $user->access) }}">
                <option></option>
                <option value="Leitor">Leitor</option>
                <option value="Autor">Autor</option>
                <option value="Administrador">Administrador</option>
            </select>
        </div>
    @endcan
    <div class="form-group col-sm-6">  
        <label for="image">Imagem </label>
        <input type="file" accept="image/*" class="form-control-file" name="image">
    </div>
</div>
<hr>
<div class="row">
        <div class="form-group col-6">
            <label for="password" {{!isset($edit) ? 'required' : ''}}>Senha</label> 
            <div class="input-group">
                <div class="input-group-append" id='visible'>
                    <span class="input-group-text rounded-left border-right-0" id="span">
                        <i class="fa fa-eye-slash" id='icon'></i>
                    </span> 
                </div>    
                <input autocomplete="new-password" type="password" class="senhaID form-control" name="password" id="password" {{!isset($edit) ? 'required' : ''}}>
            </div>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label for="password">Confirme sua senha</label>
            <input  autocomplete="new-password" type="password" class="senhaID form-control" name="password_confirmation" id="password" {{!isset($edit) ? 'required' : ''}}>
        </div>
</div>


@push('scripts')
    <script>
        $(function() {
            $('.select2').select2();
        });
        
        $('select[value]').each(function () {
            $(this).val($(this).attr('value'));
        });
        var behavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 0 0000-0000' : '(00) 0000-00009';
        },
            options = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(behavior.apply({}, arguments), options);
                }
            };

        $('#phone').mask(behavior, options);
    </script>
    <script src="{{ asset('js/components/changeVisibilityPassword.js')  }}"></script>
@endpush
