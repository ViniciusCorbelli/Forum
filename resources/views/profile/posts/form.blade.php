<label for="title" class="required">Título </label>
<input name="title" id="title" required value="{{ old('title', $post->title) }}" type="text" class="form-control">

<label for="subtitle" class="required">Sub Título </label>
<input name="subtitle" id="subtitle" required value="{{ old('subtitle', $post->subtitle) }}" type="text"
    class="form-control">
<div class="row">
    <div class="col-lg-6 col-md-12 form-group" id="send-select">
        <label for="category_id" class="required">Categoria</label>
        <select name="category_id" id="category_id" class="form-control select2"
            value="{{ old('category_id', $post->category_id) }}">
            <option value=""></option>
            @foreach ($categories as $category)
                <option @if ($post->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-sm-6">
        <label for="image">Imagem </label>
        <input type="file" accept="image/*" class="form-control-file" name="image">
    </div>
</div>
<div class="form-group">
    <label for="message" class="required">Postagem </label>
    <textarea name="message" class="form-control"
        value="{{ old('message', $post->message) }}"rows="12"> {{ $post->message }} </textarea>
</div>

<div class="form-group">
    <label for="abstract" class="required">Resumo da postagem </label>
    <textarea name="abstract" class="form-control"
        value="{{ old('abstract', $post->abstract) }}"rows="12"> {{ $post->abstract }} </textarea>
</div>