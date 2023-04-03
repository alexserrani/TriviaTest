@extends('layout.result')

@section('main')
{{-- YOU need to change {INSERT_USERNAME_HERE} with the authenticated username --}}

<body>
    <div class="container">
        <div class="wrapper">
            <div class="page-name">
                <h1>Trivia Game</h1>
            </div>
            <div class="result-container">
                <div class="top">
                    <h2>Congratulation {{ $username }} </h2>
                </div>

                <div class= "middle">
                    <p>You have passed the trivia game, you are among the very best as you just succeeded the 80% threshold</p>
                </div>

                <div class = "emote">
                    <h1>🎉 🎉 🎉</h1>
                </div>

                <div class="redirect">
                    <a class = "button-redirect" href = "/">
                        Do you want to try again?
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
