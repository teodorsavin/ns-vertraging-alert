@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="plan-journey">
                        <h2>Add stations</h2>
                        <form method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="from" class="col-2 col-form-label">Home station</label>
                                <div class="col-10">
                                    <input class="form-control" name="from" type="text" placeholder="Amsterdam Centraal" id="from" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="to" class="col-2 col-form-label">Home station</label>
                                <div class="col-10">
                                    <input class="form-control" name="to" type="text" placeholder="Zaandam" id="to" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="morning-time" class="col-2 col-form-label">Morning time</label>
                                <div class="col-10">
                                    <input class="form-control" type="time" value="08:20:00" name="morning-time" id="morning-time" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="evening-time" class="col-2 col-form-label">Evening time</label>
                                <div class="col-10">
                                    <input class="form-control" type="time" value="18:20:00" name="evening-time" id="evening-time" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 submit-container">
                                    <button type="submit" class="btn btn-ns submit-button">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $( document ).ready(function() {
        var stations = jQuery.parseJSON('{!! $stations !!}');
        $( "#from" ).autocomplete({
            source: stations
        });
    });
</script>

@endsection
