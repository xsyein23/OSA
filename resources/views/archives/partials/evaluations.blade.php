<table id='archiveTable' class='display cell-border'>
    <thead>
        <tr class="text-center">
            <th style="width: 5%;">#</th>
            <th style="width: 15%;">Year</th>
            <th style="width: 10%;">Semester</th>
            <th style="width: 60%;">Title</th>
            <th style="width: 10%;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($archives as $i => $archive)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center">{{ $archive->year }}</td>
                <td class="text-center">{{ ordinal_suffix($archive->semester) }}</td>
                <td class="text-center">{{ \Illuminate\Support\Str::limit($archive->title, 60, '...') }}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-flash-border-primary bg-danger text-white" onclick="setEvalID({{ $archive->id }})" data-mdb-toggle="modal" data-mdb-target="#evaluation_unarchive">
                        <i class='fas fa-archive'></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
