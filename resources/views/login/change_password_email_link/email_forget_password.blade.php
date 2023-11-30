<h1> {{ trans('messages.forgot_password') }}</h1>
{{ trans('messages.form_password_reset_link') }}
<a href="{{ route('reset.password.get', ['token' => $token, 'email' => $email]) }}">{{ trans('messages.reset_password') }}</a>
