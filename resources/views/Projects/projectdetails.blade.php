@extends('layouts.sidebar')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                {{-- <div class="card-header d-block">
                    <h3>{{ __('User Type') }}</h3>
                    <div class="select">
                        <select class="form-control" id="locale">
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                </div> --}}



                <div class="card-body">

                    {{-- Show status about data in firebase --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    {{-- <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('myproductsDeleteAll') }}">Delete All Selected</button> --}}
                    <div id="toolbar">
                        <button id="remove" class="btn btn-primary" disabled>
                            <i class="fa fa-trash"></i> Delete selected
                        </button>

                        <a id="add" href="/add-project" class="btn btn-primary">

                            <i class="fa fa-trash"></i> Add Project
                        </a>
                    </div>
                    <table id="table" data-toggle="table" data-toolbar="#toolbar"
                        data-classes="table table-striped table-condensed" data-sort-name="Manager" data-search="true"
                        data-sort-order="asc" data-pagination="true" data-show-export="true" data-click-to-select="true"
                        data-row-style="rowNos" data-page-list="[10, 25, 50, 100, all]" data-show-export="true"
                        data-id-field="id" data-response-handler="responseHandler" data-filter-control="true"
                        data-hide-unused-select-options="true" data-detail-view-icon="false" data-show-columns="true">
                        {{-- <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" unchecked></th>
                                <th data-sortable="true">Number</th>
                                <th data-field="Manager" data-filter-control="select" data-sortable="true">Manager Name</th>
                                <th data-sortable="true">Manager Details</th>
                                <th style="width:2rem;">Action</th>
                            </tr>
                        </thead> --}}





                        <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" unchecked></th>
                                <th>S No.</th>
                                <th>Project Id</th>
                                <th>Id</th>
                                <th>Project Name</th>
                                <th>Client Name</th>
                                <th>Location</th>
                                <th>Gewerk</th>
                                <th>Date of Start</th>
                                <th>Date of End</th>

                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($x = 0)
                            @if (is_array($projects) || is_object($projects))
                            @forelse ($projects as $key => $item)
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" name="" id=""></td>
                                    <td>{{ ++$x }}</td>
                                    <td>{{ $item['projectID'] }}</td>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['projectName'] }}</td>
                                    <td>{{ $item['clientName'] }}</td>
                                    <td>{{ $item['location'] }}</td>
                                    <td>{{ $item['gewerk'] }}</td>
                                    <td>{{ $item['dateOfStart'] }}</td>
                                    <td>{{ $item['dateOfEnd'] }}</td>



                                    <td><a href="{{ url('edit-project/' . $key) }}" class="btn btn-sm btn-success"> EDIT
                                        </a></td>

                                    <td>
                                        <form action="{{ url('delete-project/' . $key) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No Record Found</td>
                                </tr>
                            @endforelse
                            @endif
                        </tbody>


                    </table>


                </div>
            </div>
        </div>
    </div>

    <script>
        // function detailFormatter(index, row) {
        //     var html = []
        //     $.each(row, function(key, value) {
        //         html.push('<p><b>' + key + ':</b> ' + value + '</p>')
        //     })
        //     return html.join('')
        // }
    </script>

    <script>
        var $table = $('#table')
        $(function() {
            $('label input').blur(function() {
                var icons = {}
                $('label').each(function() {
                    icons[$(this).find('span').text()] = $(this).find('input').val()
                })
                $table.bootstrapTable('destroy').bootstrapTable({
                    icons: icons
                })
            })
        })
    </script>
@endsection {{-- @endsection --}}
