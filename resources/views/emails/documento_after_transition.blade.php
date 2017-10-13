@component('mail::message')
# Notificación

Hola <b> {{$user}} </b>, <br>
en su rol <b>{{$friendly_rol}}</b>, <br>
le informamos que se ha registrado en la plataforma RII,
un cambio de la Denuncia interpuesta ante la Secretaría de Seguridad, <br>
con el No. <b>{{ $documento->titulo }}</b> al estado <b>{{ $friendly_workflow_state }}</b>.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Saludos,<br>
Administrador Plataforma RII
@endcomponent
