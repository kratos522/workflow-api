@component('mail::message')
# Notificación

Hola <b> {{$user}} </b>, como miembro del rol <b>{{$rol}}</b>, <br>
le informamos que se ha registrado en la plataforma RII,
un cambio de la tarea <b>{{ $task->title }}</b> al estado <b>{{ $task->workflow_state }}</b>.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Saludos,<br>
Administrador Plataforma RII
@endcomponent
