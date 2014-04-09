
<a name="faq-{{ $faq->id }}"></a>

<div class="faq-header">
    @foreach($faq->questions as $question)
        <p><a href="#faq-answer-{{ $question->id }}">{{ $question->question }}</a></p>
    @endforeach
</div>

<hr />

@foreach($faq->questions as $question)
    <h2 class="faq-question"><a name="faq-answer-{{ $question->id }}"></a>&raquo; {{ $question->question }}</h2>
    <div class="faq-answer">{{ $question->answer }}</div>
    <p><a href="#faq-{{ $faq->id }}" class="top-link"><i class="icon-arrow-up"></i> Nach oben</a></p>
@endforeach
