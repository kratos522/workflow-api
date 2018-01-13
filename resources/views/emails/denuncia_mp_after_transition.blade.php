@component('mail::message')
# Notificación

Hola <b> {{$user}} </b>, en su rol <b>{{$friendly_rol}}</b>, <br>
le informamos que se ha registrado en la plataforma RII,
un cambio de la Denuncia interpuesta ante el Ministerio Público, <br>
con el No. <b>{{ $denuncia_mp->numero_denuncia }}</b> al estado <b>{{ $friendly_workflow_state }}</b>.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Saludos,<br>
Administrador Plataforma RII
@endcomponent
