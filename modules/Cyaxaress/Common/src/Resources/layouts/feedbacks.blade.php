@if(session()->has('feedbacks'))
    @foreach(session()->get('feedbacks') as $message)
        $.toast({
        heading: "{{ $message["title"] }}",
        text: "{{ $message["body"] }}",
        showHideTransition: 'slide',
        icon: "{{ $message['type'] }}"
        })
    @endforeach
@endif
