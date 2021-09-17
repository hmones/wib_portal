@component('mail::message')
    <h2>Hi, {{$application->user->name}}</h2>
    <br>
    @if($application->status === \App\Models\B2bApplication::SUBMITTED)
        <p>
            Thank you for applying to WiB B2B program. Our team will process your application and will inform
            you by email about the status of your application.
        </p>
    @elseif ($application->status === \App\Models\B2bApplication::ACCEPTED)
        <p>
            We thank you for your interest in WiB B2B program and for your application. We are happy to
            announce that you have been selected to be part of the program and present your company and
            products to potential clients. We will revert back to you by email to share your meetings ‘schedule of
            the day.
        </p>
    @elseif ($application->status === \App\Models\B2bApplication::DECLINED)
        <p>
            We thank you for your interest in WiB B2B program and for your application. Unfortunately, due to a
            high number of applications, your application has not been selected to the next stage. We have
            upcoming rounds of B2B and hope to see you with us next time.
        </p>
    @endif
    <br>
    <hr style="border-color:#e9e9e9;">
    Best,<br>
    {{ config('app.name') }}
    <br><br>
@endcomponent
