<table id='archiveTable' class='display cell-border'>
    <thead>
        <tr class="text-center">
            <th style="width: 5%;">#</th>
            <th style="width: 15%;">Owned by:</th>
            <th style="width: 10%;">Cover</th>
            <th style="width: 20%;">Title</th>
            <th style="width: 40%;">Description</th>
            <th style="width: 10%;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($archives as $i => $archive)
        <tr>
            <td class="text-center">{{ $i + 1 }}</td>
            <td>{{ $archive->publicationPage ? $archive->publicationPage->title : 'N/A' }}</td>
            <td class="text-center"><img src="{{ asset('upload/img/' . basename($archive->image)) }}" style="height: 10vh; object-fit: cover;" /></td>
            <td class="text-center">{{ \Illuminate\Support\Str::limit($archive->title, 50, '...') }}</td>
            <td class="text-center">
                @php
                $description = strip_tags($archive->descriptions);
                $shortDescription = mb_substr($description, 0, 150);
                $remainingCharacters = strlen($description) - strlen($shortDescription);
                $nextText = $remainingCharacters > 0 ? '...' : '';
                @endphp

                {!! nl2br(e($shortDescription)) !!}{{ $nextText }}
            </td>
            <td class="text-center">
                <button class="btn btn-sm btn-flash-border-primary bg-danger text-white" onclick="setPubID({{ $archive->id }})" data-mdb-toggle="modal" data-mdb-target="#publication_unarchive">
                    <i class='fas fa-archive'></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>