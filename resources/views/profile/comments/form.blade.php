<div class="form-group">
    <label for="message" class="required">Comentario </label>
    <textarea class="form-control" name="message" id="message" required
        value="{{ old('message', $comment->message) }}" rows="12">{{ $comment->message}}</textarea>
</div>
