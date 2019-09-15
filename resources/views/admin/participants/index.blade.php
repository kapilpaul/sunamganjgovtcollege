@extends('layouts.default')

@section('main_content')

    @include('admin.participants.filter-form')

    <div class="block">
        <div class="block-title">
            @if(isset($request))
            <h2><strong>Showing</strong> Student Type: {{ $request->student_type }} Register Type: {{ $request->register_type }} Payment Status: {{ $request->payment_status }}</h2>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter table-striped">
                <thead>
                <tr>
                    <th style="width: 20px;" class="text-center">#</th>
                    <th>Name</th>
                    <th>Mobile No</th>
                    <th>Country</th>
                    <th>Paid</th>
                    <th style="width: 150px;" class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($participants)
                @foreach($participants as $participant)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a target="_blank" href="{{ route('admin.participant.show', $participant->uid) }}">
                            {{ $participant->name }}
                        </a>
                    </td>
                    <td>{{ $participant->mobile_no }}</td>
                    <td>{{ $participant->country }}</td>
                    <td>
                        @if($participant->paid == 0)
                        <p class="label label-warning">Not Paid</p>
                        @else
                        <p class="label label-success">Paid</p>
                        @endif
                    </td>

                    <td class="text-center">
                        <div class="btn-group btn-group-xs">
                            <a target="_blank" href="{{ route('admin.participant.show', $participant->uid) }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Show"><i class="fa fa-eye"></i></a>

                            <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Edit"><i class="fa fa-pencil"></i></a>

                            {{--<a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-times"></i></a>--}}
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

    {{ $participants->links('partials.pagination') }}
@stop
