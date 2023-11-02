@push('style')
    <style>
        .border-outer {
            margin-top:2em;
            border-style: dotted;
            border-color:#B2ACFA;
            margin-bottom:2em;
        }

        .title {
            background-color:#B2ACFA;
            padding:8px 0;
        }

        .title p {
            text-align:center;
            color:#293845;
            font-weight:bold;
            font-family: 'STIX Two Text', serif;
            font-size:1.3rem;
            margin:auto;
        }
    </style>
@endpush

<div class="border-outer">
    <div class="title">
        <p>{{ $title }}</p>
    </div>
</div>
