@if($option == 'announcements')
@include('archives.partials.announcements', ['archives' => $archives])
@endif

@if($option == 'publications')
@include('archives.partials.publications', ['archives' => $archives])
@endif

@if($option == 'publish')
@include('archives.partials.publish', ['archives' => $archives])
@endif

@if($option == 'evaluations')
@include('archives.partials.evaluations', ['archives' => $archives])
@endif

@if($option == 'spectrums')
@include('archives.partials.spectrums', ['archives' => $archives])
@endif

@if($option == 'personnel')
@include('archives.partials.personnel', ['archives' => $archives])
@endif