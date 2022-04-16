{{-- {{dd(public_path() . '/img/logo.png')}} --}}
<div style="text-align: start" dir="rtl">
@component('mail::message')
<img src="{{ $message->embed(public_path() . '/img/logo.png') }}" >
#@lang('email.confirm_welcom')
<br>
@lang('email.confirm_body')
<br>
@lang('email.your_code_is'){{$user_data["verification_code"]}}
@component('mail::button', ['url' => $user_data['url']])
@lang('email.confirm_button')
@endcomponent
<br>
@lang('email.confirm_ignore')
<br>
@lang('email.if_problem_buttom')<a href="{{$user_data['url']}}">{{$user_data['url']}}</a><br>
{{ config('app.name') }}
@endcomponent
</div>
