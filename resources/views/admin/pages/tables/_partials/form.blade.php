@include('admin.incluides.alerts')

<div class="form-group">
    <label for="">Idenficado da Mesa:</label>
    <input type="text" name="identify" class="form-control" placeholder="Nome:" value="{{ $table->identify ?? old('identify') }}">
</div>

<div class="form-group">
    <label for="">Descrição:</label>
    <textarea name="description"  cols="30" rows="5" class="form-control"></textarea>
</div>


<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
