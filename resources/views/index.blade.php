<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRIVIA GAME</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="text-center">TRIVIA GAME</h1>
        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="card my-3">
            <div class="card-body">
                <h2 class="card-title">Question 1</h2>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" id="answer1" value="Answer 1">
                    <label class="form-check-label" for="answer1">Answer 1</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" id="answer2" value="Answer 2">
                    <label class="form-check-label" for="answer2">Answer 2</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" id="answer3" value="Answer 3">
                    <label class="form-check-label" for="answer3">Answer 3</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" id="answer4" value="Answer 4">
                    <label class="form-check-label" for="answer4">Answer 4</label>
                </div>
            </div>
        </div>
        <div class="progress mb-3">
            <div class="progress-bar bg-info" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">30 s</div>
        </div>
    </div>
    
    <!-- Script to fetch questions and answers from API -->
<script>
  fetch('https://opentdb.com/api.php?amount=10&category=9&difficulty=easy&type=multiple&encode=url3986')
    .then(response => response.json())
    .then(data => {
      // Add code here to display questions and answers in your UI
    })
    .catch(error => {
      console.error('An error occurred while fetching questions:', error);
    });
</script>
    
  <script>
    let timeLeft = 30;
    const countdownEl = document.getElementById('countdown');
    const questionEl = document.getElementById('question');
    const labels = [document.getElementById('label1'), document.getElementById('label2'), document.getElementById('label3'), document.getElementById('label4')];
    const progressBar = document.querySelector('.progress-bar');
    let progress = 100;
    let currentQuestion = null;
    let questionIndex = 0;
    let score = 0;

    // Function to render a question and its answers on the page
    function renderQuestion() {
        questionEl.textContent = decodeURIComponent(currentQuestion.question);
        labels[0].textContent = decodeURIComponent(currentQuestion.answers[0]);
        labels[1].textContent = decodeURIComponent(currentQuestion.answers[1]);
        labels[2].textContent = decodeURIComponent(currentQuestion.answers[2]);
        labels[3].textContent = decodeURIComponent(currentQuestion.answers[3]);
    }

    // Function to fetch questions from API and render them on the page
    function fetchQuestions() {
        fetch('https://opentdb.com/api.php?amount=10&category=9&difficulty=easy&type=multiple&encode=url3986')
        .then(response => response.json())
        .then(data => {
            questions = data.results.map(result => ({
                question: result.question,
                correct_answer: result.correct_answer,
                answers: [...result.incorrect_answers, result.correct_answer].map(answer => encodeURIComponent(answer))
            }));
            currentQuestion = questions[questionIndex];
            renderQuestion(currentQuestion);
            updateProgressBar();
        })
        .catch(error => {
            console.error('An error occurred while fetching questions:', error);
        });
    }

    // Set the initial value of the progress bar
    progressBar.style.width = progress + '%';

    // Update the progress bar
    function updateProgressBar() {
        progress = progress - (100 / questions.length);
        progressBar.style.width = progress + '%';
    }

    // Update the countdown timer
    function updateCountdown() {
        countdownEl.innerHTML = timeLeft + ' seconds left';
        timeLeft--;
        if (timeLeft < 0) {
            clearInterval(countdownInterval);
            alert('Time is up!');
            location.reload();
        }
    }

    // Start the countdown timer
    const countdownInterval = setInterval(updateCountdown, 1000);

    // Handle the user's answer
    function handleAnswer(answer) {
        if (answer === decodeURIComponent(currentQuestion.correct_answer)) {
            alert('Correct!');
            score++;
        } else {
            alert('Incorrect!');
        }
        if (questionIndex === questions.length - 1) {
            clearInterval(countdownInterval);
            alert(`Quiz finished! Your score is ${score}/${questions.length}`);
            location.reload();
        } else {
            questionIndex++;
            currentQuestion = questions[questionIndex];
            renderQuestion(currentQuestion);
            updateProgressBar();
        }
    }

    // Fetch questions and start the game
    fetchQuestions();
</script>


</body>


</html>
