<select name="parent_id" id="parent_id" style="width: 100%;">
    <option value="0">Bình luận chính</option>
    @foreach ($comments as $comment)
        <option value="{{ $comment->id }}" {{ $comment->id == $reply_id ? 'selected' : '' }}>{{ $comment->comments_content }}</option>
    @endforeach
</select>
<script>
    $('#parent_id').select2();
</script>