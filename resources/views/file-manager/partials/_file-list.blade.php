<div>
    <h4 class="my-3">{{ 'Files' }}</h4>
</div>

<div class="files">
    <div class="table-responsive">
        <table class="table table-centered table-nowrap mb-0">
            <thead class="table-light">
            <tr>
                <th class="border-0">{{ ('SL') }}</th>
                <th class="border-0 text-center">{{ ('Icon') }}</th>
                <th class="border-0">{{ ('Name') }}</th>
                <th class="border-0">{{ ('File Item') }}</th>
                <th class="border-0">{{ ('File Size') }}</th>
                <th class="border-0">{{ ('Last Modified') }}</th>
                <th class="border-0" style="width: 80px;">Action</th>
            </tr>
            </thead>
            <tbody>

            @if(request('targetFolder'))
                <tr>
                    <td colspan="7">
                        <div onclick="openFolderByAjax('{{ $lastFolder }}')" class="cursor-pointer">
                                <span class="text-danger pe-2">
                                    <i class="fa-solid fa-reply"></i>
                                </span>
                            {{ $lastFolder != '' ? ('Back to').' '. $lastFolder : ('Back to Root Directory') }}
                        </div>
                    </td>
                </tr>
            @endif

            @foreach ($folderArray as $key => $folder)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>
                        <div onclick="openFolderByAjax('{{ $folder['path'] }}')"
                           class="d-flex justify-content-center cursor-pointer {{ ($folder['name'] == "public" ? "text-success":'text-secondary') }}">
                            @include("master-file-manager::file-manager.icons._folder")
                        </div>
                    </td>
                    <td>
                        <div onclick="openFolderByAjax('{{ $folder['path'] }}')" class="text-reset fw-semi-bold cursor-pointer">
                            {{ ucwords(str_replace('_', ' ', $folder['name'])) }}
                        </div>
                    </td>
                    <td>
                        {{ ('Folder') }}
                    </td>
                    <td>{{ $folder['size'] }}</td>
                    <td>{{ $folder['last_modified'] }}</td>
                    <td class="">
                        <div class="btn-group dropdown">
                            <a href="#"
                               class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs"
                               data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="mdi mdi-dots-horizontal"></i></a>
                            <div class="dropdown-menu dropdown-menu-end">

{{--                                <div class="dropdown-item cursor-pointer" target="_blank" onclick="openFolderByAjax('{{ $folder['path'] }}')"--}}
{{--                                   href="{{ route('admin.dashboard.file-manager.index', ['targetFolder'=> $folder['path']]) }}">--}}
{{--                                    <i class="mdi mdi-pencil me-2 text-muted vertical-middle"></i>--}}
{{--                                    {{ ('Open') }}--}}
{{--                                </div>--}}

                                <a class="dropdown-item" href="javascript:">
                                    <i class="mdi mdi-delete me-2 text-muted vertical-middle"></i>
                                    Remove
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

            @foreach ($AllFilesInCurrentFolder['files'] as $key => $File)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            @if ($File['type'] == 'image')
                                <div class="rounded">
                                    <img class="img-fluid" width="25"
                                         src="{{ masterFileManagerAsset('storage/app/public/'.$File['path']) }}" alt="">
                                </div>
                            @elseif($File['type'] == 'video')
                                @include("master-file-manager::file-manager.icons._video")
                            @else
                                @include("master-file-manager::file-manager.icons._document")
                            @endif
                        </div>
                    </td>
                    <td>
                        <span class="fw-semibold">
                            <a href="javascript: void(0);" class="text-reset">
                                {{ $File['short_name'] }}
                            </a>
                        </span>
                    </td>
                    <td>
                        {{ ucwords($File['type'] ?? 'Others') }}
                    </td>
                    <td>{{ $File['size'] }}</td>
                    <td>{{ $File['last_modified'] }}</td>
                    <td class="">
                        <div class="btn-group dropdown">
                            <a href="#"
                               class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs"
                               data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="mdi mdi-dots-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ masterFileManagerAsset('storage/app/public/'.$File['path']) }}" download>
                                    <i class="mdi mdi-download me-2 text-muted vertical-middle"></i>
                                    Download
                                </a>

                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-delete me-2 text-muted vertical-middle"></i>Remove
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>