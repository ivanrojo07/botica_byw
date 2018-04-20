@component('mail::message')

{{-- Greeting --}}

@if (! empty($greeting))

# {{ $greeting }}

@else

@if ($level == 'error')

# Whoops!

@else

# ¡Hola!

@endif

@endif



{{-- Intro Lines --}}

@foreach ($introLines as $line)

{{ $line }}



@endforeach



{{-- Action Button --}}

@isset($actionText)

<?php

    switch ($level) {

        case 'success':

            $color = 'green';

            break;

        case 'error':

            $color = 'red';

            break;

        default:

            $color = 'blue';

    }

?>

@component('mail::button', ['url' => $actionUrl, 'color' => $color])

{{ $actionText }}

@endcomponent

@endisset



{{-- Outro Lines --}}

@foreach ($outroLines as $line)

{{ $line }}



@endforeach



{{-- Salutation --}}

@if (! empty($salutation))

{{ $salutation }}

@else

Saludos,<br>{{ config('app.name') }}

@endif



{{-- Subcopy --}}

@isset($actionText)

@component('mail::subcopy')

Si usted no puede dar doble click al boton "{{ $actionText }}", copie y pegue el siguiente enlace en su navegador web: [{{ $actionUrl }}]({{ $actionUrl }})

@endcomponent

@endisset

@endcomponent

