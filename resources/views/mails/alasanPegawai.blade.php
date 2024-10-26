<form action="{{ route('kedatangan.submit-penolakan', ['id_kedatangan' => $id_kedatangan, 'token' => $token]) }}" method="POST">
    @csrf
    <label for="alasan">Alasan Penolakan</label>
    <textarea id="alasan" name="alasan" required></textarea>
    <button type="submit">Kirim Alasan</button>
</form>
