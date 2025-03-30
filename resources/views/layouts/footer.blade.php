<!-- Footer opened -->
	<div class="main-footer ht-40">
		<div class="container-fluid pd-t-0-f ht-100p">
			<span>Powered By : Rubex Studios</span>
			<form action="{{ route('change-language') }}" method="post">
    @csrf
    <select name="locale" onchange="this.form.submit()">
        @foreach(config('app.locales') as $code => $label)
            <option value="{{ $code }}" {{ app()->getLocale() === $code ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    <input type="hidden" name="redirect_url" value="{{ url()->previous() }}">
</form>
		</div>
	</div>
<!-- Footer closed -->
