@extends('layout.result')

@section('main')
{{-- YOU need to change {INSERT_USER_SCORE_HERE} with the authenticated users' score --}}

<body>
    <div class="container">
        <div class="wrapper">
            <div class="page-name">
                <h1>Trivia Game</h1>
            </div>
            <div class="result-container">

                <div class= "middle">
                    <p>You have answered correctly {{ $userScore }} % of the trivia questions </p>
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
