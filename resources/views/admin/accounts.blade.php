@extends('layouts.sidebar')

@section('content')
    <div class="row mt-5">
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
                            <i class="fa fa-trash"></i>
                            {{ __('admAcc.Delete Selected') }}
                        </button>
                        <a id="projectview" href="/projectdetails" class="btn btn-secondary">

                            <i class="fa fa-book"></i> {{ __('admAcc.Projects') }}
                        </a>

                        <a id="add" href="/add-user" class="btn btn-primary">

                            <i class="fa fa-plus"></i> {{ __('admAcc.Add User') }}
                        </a>

                        <a id="empphotos" href="/img" class="btn btn-secondary">

                            <i class="fa fa-image"></i> {{ __('admAcc.Employee Photos') }}
                        </a>
                    </div>
                    <table id="table" class="mt-4 pt-4" data-toggle="table" data-toolbar="#toolbar"
                        data-classes="table table-striped table-condensed" data-sort-name="Manager" data-search="true"
                        data-sort-order="asc" data-pagination="true" data-show-export="true" data-click-to-select="true"
                        data-row-style="rowNos" data-page-list="[10, 25, 50, 100, all]" data-show-export="true"
                        data-id-field="id" data-response-handler="responseHandler" data-filter-control="true"
                        data-hide-unused-select-options="true" data-detail-view-icon="false" data-show-columns="true"
                        data-export-types="['csv','excel','zip']">





                        <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" unchecked></th>
                                <th>S No.</th>
                                <th>{{ __('admAcc.Id') }}</th>
                                <th>{{ __('admAcc.First Name') }}</th>
                                <th data-field="lastName" data-filter-control="select" data-sortable="true">
                                    {{ __('admAcc.Last Name') }}</th>
                                <th>{{ __('admAcc.Email') }}</th>
                                <th>{{ __('admAcc.Username') }}</th>
                                <th>{{ __('admAcc.Password') }}</th>
                                <th>{{ __('admAcc.Date of Employment') }}</th>
                                <th>{{ __('admAcc.End of Employment') }}</th>
                                <th>{{ __('admAcc.Health Insurance') }}</th>
                                <th>{{ __('admAcc.License Number') }}</th>
                                <th>{{ __('admAcc.National Id') }}</th>
                                <th>{{ __('admAcc.Phone Number') }}</th>
                                <th>{{ __('admAcc.Project') }}</th>
                                <th>{{ __('admAcc.Role') }}</th>
                                <th>{{ __('admAcc.Social Insurance') }}</th>

                                <th>{{ __('admAcc.EDIT') }}</th>
                                <th>{{ __('admAcc.DLT') }}</th>
                            </tr>
                        </thead>


                        <tbody>
                            @php($x = 0)
                            @if (is_array($users) || is_object($users))
                                @forelse ($users as $key => $item)
                                    <tr>
                                        <td><input type="checkbox" class="sub_chk" name="" id=""></td>
                                        <td>{{ ++$x }}</td>
                                        <td>{{ $item['id'] }}</td>
                                        <td>{{ $item['firstName'] }}</td>
                                        <td>{{ $item['lastName'] }}</td>
                                        <td>{{ $item['email'] }}</td>
                                        <td>{{ $item['username'] }}</td>
                                        <td>{{ $item['password'] }}</td>
                                        <td>{{ $item['dateOfEmployment'] }}</td>
                                        <td>{{ $item['endOfEmployment'] }}</td>
                                        <td>{{ $item['healthInsurance'] }}</td>
                                        <td>{{ $item['licenseNumber'] }}</td>
                                        <td>{{ $item['nationalID'] }}</td>
                                        <td>{{ $item['phoneNumber'] }}</td>
                                        <td>{{ $item['project'] }}</td>
                                        <td>{{ $item['role'] }}</td>
                                        <td>{{ $item['socialInsurance'] }}</td>



                                        <td><a href="{{ url('edit-user/' . $key) }}" class="btn btn-sm btn-success">
                                                {{ __('admAcc.EDIT') }}
                                            </a>
                                        </td>

                                        <td>
                                            <form action="{{ url('delete-user/' . $key) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger">{{ __('admAcc.DLT') }}</button>
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
        //      return html.join('')
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
@endsection
{{-- @endsection --}}
