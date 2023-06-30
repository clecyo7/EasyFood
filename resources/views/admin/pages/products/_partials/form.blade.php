@include('admin.incluides.alerts')

<div class="form-group">
    <label for="">* Título:</label>
    <input type="text" name="title" class="form-control" placeholder="Título:" value="{{ $product->title ?? old('title') }}">
</div>

<div class="form-group">
    <label for="">* Preço:</label>
    <input type="text" name="price" class="form-control" placeholder="Preço:" value="{{ $product->price ?? old('price') }}">
</div>

<div class="form-group">
    <label for="">* Imagem:</label>
    <input type="file" name="image" class="form-control">
</div>

<div class="form-group">
    <label for="">* Descrição:</label>
    <input type="text" name="description" class="form-control" placeholder="Descrição:" value="{{ $product->description ?? old('description') }}">
</div>



<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
