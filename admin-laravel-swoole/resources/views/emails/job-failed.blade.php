<x-mail::message>
# Introduction

The body of your message.

{{--<x-mail::button :url="''">--}}
{{--Button Text--}}
{{--</x-mail::button>--}}

Job Class: {{ $event->job->resolveName() }}
Job Body: {{ $event->job->getRawBody() }}
Exception: {{ $event->exception->getTraceAsString() }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
